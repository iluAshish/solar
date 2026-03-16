<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProjectProducts extends CI_Controller {

    public $table_name = TBL_PROJECT_PRODUCT;
    public $controllers = 'projectproducts';
    public $view_name = 'projectproducts';
    public $title = 'Project Product';
    public $PrimaryKey = 'id';
    public $role_id = '';
    
    function __construct() {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login/');
        }
        $this->role_id = $this->session->userdata('role_id');
    }

    function index() {
        $data['role_id'] = $this->role_id;
        $data['page_title'] = "Manage " . $this->title;
        $data['main_content'] = $this->view_name . '/list';
        $data['breadcrumb'] = '<!--begin::Item-->
					<li class="breadcrumb-item text-grey-900">Project Product</li>
					<!--end::Item-->';        
        
        $this->load->view('main_content', $data);
    }

    function add() {
        $data['page_title'] = "Add " . $this->title;
        $data['projects'] = $this->Common->get_list(TBL_PROJECTS,'id', 'project_name');
        $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id', 'product_name');
        $data['projectsizes'] = $this->Common->get_list(TBL_PROJECT_SIZE, 'id', 'size_name', '');

        $this->load->view($this->view_name . '/form', $data);

    }

    function edit($id) {

        // Support composite key: "<project_id>::<size_id>" to edit all rows for that project+size
        if (is_string($id) && strpos($id, '::') !== false) {
            list($project_id, $size_id) = explode('::', $id);
            $project_id = (int)$project_id;
            $size_id = (int)$size_id;

            if ($project_id > 0) {
                $this->db->where('project_id', $project_id);
                $this->db->where('size_id', $size_id);
                $rows = $this->db->get($this->table_name)->result();

                if (!empty($rows)) {
                    // normalize DB field names so the view expects 'product_id'
                    foreach ($rows as &$r) {
                        if (isset($r->pro_product_id)) {
                            $r->product_id = $r->pro_product_id;
                        }
                    }

                    $data['projects'] = $this->Common->get_list(TBL_PROJECTS,'id', 'project_name');
                    $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id', 'product_name');
                    $data['projectsizes'] = $this->Common->get_list(TBL_PROJECT_SIZE, 'id', 'size_name');
                    $data['price_data'] = $rows; // used by the view to render multiple rows
                    $data['data_info'] = (object)[ 'project_id' => $project_id, 'size_id' => $size_id ];
                    $data_found = 1;
                }
            }

        } else {
            // existing single-row edit: fetch by primary key then load ALL rows for that project's size
            $id_int = (int)$id;
            if ($id_int > 0) {
                $data_obj = $this->Common->get_info($id_int, $this->table_name, $this->PrimaryKey);
                if (is_object($data_obj) && count((array)$data_obj) > 0) {
                    $project_id = isset($data_obj->project_id) ? (int)$data_obj->project_id : 0;
                    $size_id = isset($data_obj->size_id) ? (int)$data_obj->size_id : 0;

                    if ($project_id > 0) {
                        // load all product rows for this project + size so the edit form shows all products
                        $this->db->where('project_id', $project_id);
                        $this->db->where('size_id', $size_id);
                        $rows = $this->db->get($this->table_name)->result();

                        if (!empty($rows)) {
                            foreach ($rows as &$r) {
                                if (isset($r->pro_product_id)) {
                                    $r->product_id = $r->pro_product_id;
                                }
                            }

                            $data['projects'] = $this->Common->get_list(TBL_PROJECTS,'id', 'project_name');
                            $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id', 'product_name');
                            $data['projectsizes'] = $this->Common->get_list(TBL_PROJECT_SIZE, 'id', 'size_name');
                            $data['price_data'] = $rows;
                            $data['data_info'] = (object)['project_id' => $project_id, 'size_id' => $size_id];
                            $data_found = 1;
                        } else {
                            // fallback to single-row behavior
                            if (isset($data_obj->pro_product_id)) {
                                $data_obj->product_id = $data_obj->pro_product_id;
                            }

                            $data['projects'] = $this->Common->get_list(TBL_PROJECTS,'id', 'project_name');
                            $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id', 'product_name');
                            $data['projectsizes'] = $this->Common->get_list(TBL_PROJECT_SIZE, 'id', 'size_name');
                            $data["data_info"] = $data_obj;
                            $data['price_data'] = [$data_obj];
                            $data_found = 1;
                        }
                    }
                }
            }
        }

        if ($data_found == 0) {
            redirect('/');
        }

        $data['page_title'] = "Edit " . $this->title;
        $this->load->view($this->view_name . '/form', $data);
    }

    public function submit_form()
    {
        if (!$this->input->post()) {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid request"
            ]);
            return;
        }

        $error_element = error_elements();
        $this->form_validation->set_rules("project_id", "Project", "required");
        $this->form_validation->set_rules("size_id", "Project Size", "required");
        $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);

        if (!$this->form_validation->run()) {
            echo json_encode([
                "status"  => "error",
                "heading" => "Validation Error",
                "error"   => $this->form_validation->error_array()
            ]);
            return;
        }

        $project_id = (int)$this->input->post("project_id");
        $size_id    = (int)$this->input->post("size_id");

        // Arrays of rows posted
        $row_ids     = $this->input->post("row_id");        // hidden IDs
        $product_ids = $this->input->post("product_id");
        $warranty    = $this->input->post("warranty");
        $quantity    = $this->input->post("quantity");
        $watt_volt   = $this->input->post("watt_volt");

        $used_ids = []; // rows that will NOT be deleted

        $this->db->trans_begin();

        // Loop all rows from form
        for ($i = 0; $i < count($product_ids); $i++) {

            $row_id     = trim($row_ids[$i]     ?? "");
            $product_id = trim($product_ids[$i] ?? "");

            if ($product_id === "") continue; // skip empty row

            $data = [
                "project_id"     => $project_id,
                "size_id"        => $size_id,
                "pro_product_id" => $product_id,
                "warranty"       => $warranty[$i] ?? "",
                "quantity"       => $quantity[$i] ?? "",
                "watt_volt"      => $watt_volt[$i] ?? "",
                "updated_at"     => date("Y-m-d H:i:s")
            ];

            // UPDATE existing row
            if ($row_id !== "") {
                $this->db->where("id", $row_id);
                $this->db->update($this->table_name, $data);
                $used_ids[] = $row_id;
            }

            // INSERT new row
            else {
                $data["created_at"] = date("Y-m-d H:i:s");
                $this->db->insert($this->table_name, $data);
                $used_ids[] = $this->db->insert_id();
            }
        }

        // DELETE rows not used anymore
        $this->db->where("project_id", $project_id);
        $this->db->where("size_id", $size_id);

        if (!empty($used_ids)) {
            $this->db->where_not_in("id", $used_ids);
        }

        $this->db->delete($this->table_name);

        // Commit or rollback
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo json_encode([
                "status"  => "error",
                "heading" => "DB Error",
                "message" => "Failed to save. Please try again."
            ]);
            return;
        }

        $this->db->trans_commit();

        echo json_encode([
            "status"   => "ok",
            "heading"  => "Success",
            "message"  => "{$this->title} saved successfully!",
            "redirect" => base_url($this->controllers)
        ]);
    }


    function get_size_ranges() {
        $project_id = $this->input->post('id');
        $GetCat = $this->Common->get_list(TBL_PROJECT_PRICE, "price_id", "size_range", "project_id = $project_id");
        if (!empty($GetCat)) {
            $response = array("status" => "ok", "data" => $GetCat);
        } else {
            $response = array("status" => "error");
        }
        echo json_encode($response);
        die;
    }

    // old method 
    function get_size_price() {
        $size_id = $this->input->post('id');
        $GetPrice = $this->Common->get_info($size_id, TBL_PROJECT_PRICE, 'price_id');
        $sizes = explode('-',$GetPrice->size_range);
        $from_size = $sizes[0];
        $to_size = isset($sizes[1]) ? $sizes[1] : $sizes[0];
        if (!empty($GetPrice)) {
            $response = array("status" => "ok", "price" => $GetPrice->price,"from_size"=>$from_size,"to_size"=>$to_size);
        } else {
            $response = array("status" => "error");
        }
        echo json_encode($response);
        die;
    }
    function get_size_price_qutation() 
    {
        $project_id = $this->input->post('project_id');
        $size_id    = $this->input->post('size_id');
 
        if (!$project_id || !$size_id) {
            echo json_encode(["status" => "error", "message" => "Invalid parameters"]);
            return;
        }

        // GET TOTAL PRICE BASED ON PRODUCT PRICE * QUANTITY
        $query = $this->db->query("
            SELECT SUM(prod.price * spp.quantity) AS total
            FROM ".TBL_PROJECT_PRODUCT." spp
            JOIN ".TBL_PRODUCT." prod ON prod.id = spp.pro_product_id
            WHERE spp.project_id = ?
            AND spp.size_id = ?
        ", [$project_id, $size_id]);

        $row = $query->row();
        $final_price = 0;

        if ($row && $row->total > 0) {
            $final_price = $row->total * 1.25; // add 10%
        }

        // ⚠️ CORRECT TABLE → TBL_PROJECT_PRICE
        $sizeInfo = $this->Common->get_info($size_id, TBL_PROJECT_SIZE);

        $from_size = 1;
        $to_size = 1;

        if ($sizeInfo && !empty($sizeInfo->size_range)) {
            $sizes = explode('-', $sizeInfo->size_range);
            $from_size = $sizes[0];
            $to_size   = isset($sizes[1]) ? $sizes[1] : $sizes[0];
        }

        echo json_encode([
            "status"    => "ok",
            "price"     => round(($final_price/$sizeInfo->size_value), 2),
            "total" => round($final_price, 2),
            "from_size" => $from_size,
            "to_size"   => $to_size
        ]);
    }

    function get_project_sizes_by_project() {
        $project_id = $this->input->post('project_id');

        // TBL_PROJECT_PRODUCT
        $GetSizes = $this->Common->get_list(TBL_PROJECT_SIZE, "id", "size_name", "id IN (SELECT DISTINCT size_id FROM " . TBL_PROJECT_PRODUCT . " WHERE project_id = $project_id)");
       
        if (!empty($GetSizes)) {
            $response = array("status" => "ok", "data" => $GetSizes);
        } else {
            $response = array("status" => "error");
        }
        echo json_encode($response);
        die;
    }


    function get_cities() {
        $state_id = $this->input->post('state_id');
        $GetCat = $this->Common->get_list(TBL_CITIES, "id", "name", "state_id = $state_id");
        if (!empty($GetCat)) {
            $response = array("status" => "ok", "data" => $GetCat);
        } else {
            $response = array("status" => "error");
        }
        echo json_encode($response);
        die;
    }
    
    function activated($id) {
        if ($id > 0) {
            $IsFeatured = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey, FALSE, 'isActive');
            if ($IsFeatured->isActive == 0) {
                $activated = 1;
                $status = "ok";
                $heading = "Success";
                $message = "Project activated successfully.";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Project deactivated successfully.";
            }
            $data = array(
                "isActive" => $activated,
            );

            if ($this->Common->update_info($id, $this->table_name, $data, $this->PrimaryKey)) {  
                $response = array("status" => $status, "heading" => $heading, "message" => $message);
                echo json_encode($response);
                die;
            }

        }
    }

    public function manage()
    {
        // ----------------------------------------------
        // BASE QUERY (Safe for MySQL 5.x, 8.x, MariaDB)
        // ----------------------------------------------

        $this->datatables->select("
            p.".$this->PrimaryKey." AS id,
            pr.project_name AS project_name,
            ps.size_name AS project_size,
            COUNT(DISTINCT p.pro_product_id) AS number_of_products,

            (
                SELECT SUM(prod.price * spp.quantity) * 1.25
                FROM ".TBL_PRODUCT." prod
                JOIN ".TBL_PROJECT_PRODUCT." spp ON spp.pro_product_id = prod.id
                WHERE spp.project_id = pr.id 
                AND spp.size_id = p.size_id
            ) AS project_price
        ");


        $this->datatables->from($this->table_name . " p");

        // JOIN: Projects
        $this->datatables->join(TBL_PROJECTS . " pr", "pr.id = p.project_id", "left");

        // JOIN: Project Size
        $this->datatables->join(TBL_PROJECT_SIZE . " ps", "ps.id = p.size_id", "left");

        // GROUP BY project + size
        $this->datatables->group_by("pr.id, p.size_id");

        // Action
        $this->datatables->add_column('action', $this->action_row('$1'), 'id');

        // Hide id
        $this->datatables->unset_column('id');


        // ----------------------------------------------
        // ATTEMPT TO GENERATE JSON
        // ----------------------------------------------
        $dt_json = $this->datatables->generate();

        if ($dt_json === false) {

            // Capture database error
            $dberr  = $this->db->error();
            $lastq  = method_exists($this->db, 'last_query') ? $this->db->last_query() : 'N/A';

            log_message('error', "ProjectProducts: SQL error " . print_r($dberr, true));
            log_message('error', "ProjectProducts: Last Query => " . $lastq);

            // ----------------------------------------------
            // FALLBACK: Handle ANY_VALUE/GROUP error cases
            // ----------------------------------------------
            $errMsg = strtolower($dberr['message'] ?? "");

            if (strpos($errMsg, "any_value") !== false || strpos($errMsg, "unknown") !== false) {

                log_message('debug', "Retrying ProjectProducts manage() using GROUP_CONCAT fallback.");

                // Rebuild SELECT using GROUP_CONCAT fallback
                $this->datatables->select("
                    pr.project_name AS project_name,
                    SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT COALESCE(ps.size_name, '') SEPARATOR '|'), '|', 1) AS project_size,
                    COUNT(DISTINCT p.id) AS number_of_products,
                    SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT COALESCE(prc.price, '') SEPARATOR '|'), '|', 1) AS project_price,
                    pr.id AS id
                ");

                $dt_json = $this->datatables->generate();

                if ($dt_json === false) {
                    $dberr2 = $this->db->error();
                    $lastq2 = method_exists($this->db, 'last_query') ? $this->db->last_query() : 'N/A';

                    log_message('error', "ProjectProducts retry failed: " . print_r($dberr2, true));
                    log_message('error', "ProjectProducts retry last query: " . $lastq2);

                    echo json_encode([
                        "data" => [],
                        "recordsTotal" => 0,
                        "recordsFiltered" => 0,
                        "error" => "SQL error. Check logs."
                    ]);
                    return;
                }
            } else {

                // Unknown DB error
                echo json_encode([
                    "data" => [],
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "error" => "SQL error. Check logs."
                ]);
                return;
            }
        }

        // SUCCESS
        log_message('debug', "ProjectProducts manage() JSON length: " . strlen($dt_json));
        echo $dt_json;
    }

    
    function show_price_data($id) {
        $contact_person = '<a href="javascript:;" class="btn btn-sm btn-success show_price_data" data-id="'.$id.'"><i class="fas fa-money-bill me-2 text-muted"></i> Price Data</a>';

        return $contact_person;
    }

    function get_price_data() {
        $data["price_data"] = $this->Common->get_all_info($this->input->post('ProjectID'), TBL_PROJECT_PRICE.' pp', 'project_id', '', 'pp.*');
        //$data['companyID'] = $this->input->post('companyID');
        $data['page_title'] = "Manage " . $this->title . " Product";
        $this->load->view($this->view_name . '/price_details', $data);
    }

    function action_row($id) {
        $action = <<<EOF
			<button class="btn btn-icon btn-primary w-30px h-30px me-3 open_my_form_form" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
				<i class="ki-duotone ki-setting-3 fs-3">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
					<span class="path5"></span>
				</i>
			</button>
			<button class="btn btn-icon btn-danger w-30px h-30px remove-item-btn delete_btn" data-original-title="Remove {$this->title}" data-method=remove data-table="{$this->table_name}" data-column="{$this->PrimaryKey}" data-id="{$id}">
				<i class="ki-duotone ki-trash fs-3">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
					<span class="path5"></span>
				</i>
			</button>


EOF;
        return $action;
    } 

    function action_row_projectsize($key) {
        // $key will be in the form "<project_id>::<size_id>" when replaced by Datatables
        $action = <<<EOF
            <button class="btn btn-icon btn-primary w-30px h-30px me-3 open_my_form_form" data-id="{$key}" data-original-title="Edit {$this->title}" data-control={$this->controllers} data-key-type="project_size">
                <i class="ki-duotone ki-setting-3 fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
            </button>
            <button class="btn btn-icon btn-danger w-30px h-30px remove-item-btn delete_btn" data-original-title="Remove {$this->title}" data-method=remove data-table="{$this->table_name}" data-column="{$this->PrimaryKey}" data-id="{$key}" data-key-type="project_size">
                <i class="ki-duotone ki-trash fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
            </button>


EOF;
        return $action;
    }

}