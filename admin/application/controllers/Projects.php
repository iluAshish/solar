<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Projects extends CI_Controller {

    public $table_name = TBL_PROJECTS;
    public $controllers = 'projects';
    public $view_name = 'projects';
    public $title = 'Projects';
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
					<li class="breadcrumb-item text-grey-900">Projects</li>
					<!--end::Item-->';        
        
        $this->load->view('main_content', $data);
    }

    function add() {
        $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"role='Franchisee' and activated = 1");
        //$data['designations'] = $this->Common->get_list(TBL_DESIGNATION,'designation_id','designation_name','is_active = 1');
        $data['states'] = $this->Common->get_list(TBL_STATES,'id','name','country_id = 101');
        $data['page_title'] = "Add New " . $this->title;
        $this->load->view($this->view_name . '/form', $data);
    }

    function edit($id) {

        $data_found = 0;
        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            if (is_object($data_obj) && count((array)$data_obj) > 0) {
                $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"role='Franchisee' and activated = 1");
                $data['clients'] = $this->Common->get_list(TBL_CLIENTS, "id", "client_name", "franchisee_id = $data_obj->franchisee_id");
                $data['price_data'] = $this->Common->get_all_info('',TBL_PROJECT_PRICE.' pp','','project_id = "'.$id.'"',"pp.*");
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
        echo "<pre>"; print_r($this->input->post()); echo "</pre>"; die;
        if ($this->input->post()) {

            $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
            $error_element = error_elements();
            $this->form_validation->set_rules('project_name', 'Project Name', 'required');
            //$this->form_validation->set_rules('project_type', 'Project Type', 'required');
            //$this->form_validation->set_rules('person_email', 'Person Email', 'required');
            //$this->form_validation->set_rules('person_mobile', 'Person Mobile', 'required');
            
            
            /*if (empty($_FILES['Image']['name']) && $this->input->post('old_Image') == '') {
                $this->form_validation->set_rules('Image', 'Banner Image', 'required');
            }*/
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "project_name" => $this->input->post('project_name'),
                    //"franchisee_id" => $this->input->post('franchisee_id'),
                    //"client_id" => $this->input->post('client_id'),
                    "description" => $this->input->post('description'),
                    //"project_type" => $this->input->post('project_type'),
                    "status" => 'Active',
                    //"project_status" => $this->input->post('project_status'),
                );
                if (!empty($_FILES['Image']['name'])) {
                    $file_data = upload_file('Image', UPLOAD_DIR.COMPANY, ($this->input->post('old_Image')) ? $this->input->post('old_Image') : '');
                    if (is_array($file_data) && $file_data['file_name'] != "") {
                        $post_data['Image'] = $file_data['file_name'];
                    } else {
                        $response['message'] = $file_data;
                        echo json_encode($response);
                        die;
                    }
                }
                if ($this->Common->check_is_exists($this->table_name, $post_data['project_name'], "project_name", $id, $field = $this->PrimaryKey)):
                    $response['heading'] = $this->title.' Name details already exists';
                    $response['message'] = $this->title.' Name details already exists, Use another one..!';
                    echo json_encode($response);
                    die;
                endif;
                if ($id > 0):
                    $post_data['updated_at'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $this->load->model('Remove_records');
                        $del_pro_data = $this->Remove_records->remove_data($id,'project_id',TBL_PROJECT_PRICE);
                        for($i=0;$i<count($this->input->post('size')) ; $i++){
                            $price_data = array(
                                "project_id" => $id,
                                "size_range" => $this->input->post('size')[$i],
                                "price" => $this->input->post('price')[$i],
                                "description" => $this->input->post('specification')[$i]
                            );
                            $this->Common->add_info(TBL_PROJECT_PRICE, $price_data);
                        }                        
                        $response = array("status" => "ok", "heading" => "Updated successfully...", "message" => "Project updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Updated...", "message" => "Project not updated successfully.");
                    endif;
                else:
                    $post_data['created_at'] = date("Y-m-d H:i:s");

                    if ($id = $this->Common->add_info($this->table_name, $post_data)):
                        for($i=0;$i<count($this->input->post('size')) ; $i++){
                            $price_data = array(
                                "project_id" => $id,
                                "size_range" => $this->input->post('size')[$i],
                                "price" => $this->input->post('price')[$i],
                                "description" => $this->input->post('specification')[$i]
                            );
                            $this->Common->add_info(TBL_PROJECT_PRICE, $price_data);
                        }                        
                        
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Project added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Project not added successfully.");
                    endif;
                endif;
            }else {
                $errors = $this->form_validation->error_array();
                $response['error'] = $errors;
            }
            echo json_encode($response);
            die;
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

        $this->datatables->select('p.'.$this->PrimaryKey.',  project_name,"price_data" as price_data');
        $this->datatables->from($this->table_name . ' p');
        if($this->role_id == 1) {
        $this->datatables->add_column('status', '$1', 'active_row($1,' . $this->table_name.',p.'.$this->PrimaryKey.',project)')
                ->add_column('action', $this->action_row('$1'), 'p.'.$this->PrimaryKey);
        }        
        $this->datatables->edit_column('price_data', $this->show_price_data('$1'), 'p.'.$this->PrimaryKey);        
        $this->datatables->unset_column('p.'.$this->PrimaryKey);
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