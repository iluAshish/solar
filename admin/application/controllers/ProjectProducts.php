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

        $this->load->view($this->view_name . '/form', $data);

    }

    function edit($id) {

        $data_found = 0;
        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            
            if (is_object($data_obj) && count((array)$data_obj) > 0) {
                $data['projects'] = $this->Common->get_list(TBL_PROJECTS,'id', 'project_name');
                $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id', 'product_name');
                $data["data_info"] = $data_obj;
                $data_found = 1;
            }
        }
        if ($data_found == 0) {
            redirect('/');
        }
        
        $data['page_title'] = "Edit " . $this->title;
        $this->load->view($this->view_name . '/form', $data);
    }

    function submit_form() {
        // echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die;
        if ($this->input->post()) {

            $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
            $error_element = error_elements();
            $this->form_validation->set_rules('project_id', 'Select project', 'required');
            $this->form_validation->set_rules('product_id', 'Select Project', 'required');
            $this->form_validation->set_rules('warranty', 'Warranty required', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity required', 'required');
            $this->form_validation->set_rules('watt_volt', 'Enter watt/volt of product', 'required');
            
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "project_id" => $this->input->post('project_id'),
                    "pro_product_id" => $this->input->post('product_id'),
                    "warranty" => $this->input->post('warranty'),
                    "quantity" => $this->input->post('quantity'),
                    "watt_volt" => $this->input->post('watt_volt'),
                );

                if ($id > 0) {
                    $post_data['updated_at'] = date('Y-m-d H:i:s');
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)) {
                        $response = array("status" => "ok", "heading" => "Success", "message" => $this->title . " updated successfully.", "redirect" => base_url($this->controllers));
                    } else {
                        $response = array("status" => "error", "heading" => "Error", "message" => "There was an error while updating " . $this->title . ". Please try again.");
                    }
                }else{

                    $post_data['created_at'] = date('Y-m-d H:i:s');
                    // echo "<pre>"; print_r($post_data); echo "</pre>"; die;
                    if ($last_id = $this->Common->add_info($this->table_name, $post_data)) {
                        $response = array("status" => "ok", "heading" => "Success", "message" => $this->title . " added successfully.", "redirect" => base_url($this->controllers));
                    } else {
                        $response = array("status" => "error", "heading" => "Error", "message" => "There was an error while adding " . $this->title . ". Please try again.");
                    }
                }
            }else {
                $errors = $this->form_validation->error_array();
                $response['error'] = $errors;
            }
            echo json_encode($response);
        }
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

    function manage() {

        $this->datatables->select('
            pp.product_name as pro_product_name,
            pr.project_name as project_name,
            b.brand_name as brand_name,
            p.quantity,
            p.id as id
            
        ');

        $this->datatables->from($this->table_name . ' p')
                // ->add_column('status', '$1', 'active_row($1,' . $this->table_name.','.$this->PrimaryKey.',project)')
            ->add_column('action', $this->action_row('$1'), $this->PrimaryKey);

        $this->datatables->unset_column($this->PrimaryKey);

        // join with projects
        $this->datatables->join(TBL_PROJECTS.' pr', 'pr.id = p.project_id', 'left');

        // join with pro_products
        $this->datatables->join(TBL_PRODUCT.' pp', 'pp.id = p.pro_product_id', 'left');

        //getting brand name
        $this->datatables->join(TBL_BRAND.' b', 'b.id = pp.brand_id', 'left');

        echo $this->datatables->generate();
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

}