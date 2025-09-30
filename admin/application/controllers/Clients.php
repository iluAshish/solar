<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clients extends CI_Controller {

    public $table_name = TBL_CLIENTS;
    public $controllers = 'clients';
    public $view_name = 'clients';
    public $title = 'Clients';
    public $PrimaryKey = 'id';
    
    function __construct() {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login/');
        }
    }

    function index() {
        $data['page_title'] = "Manage " . $this->title;
        $data['main_content'] = $this->view_name . '/list';
        $data['breadcrumb'] = '<!--begin::Item-->
					<li class="breadcrumb-item text-grey-900">Clients</li>
					<!--end::Item-->';        
        
        $this->load->view('main_content', $data);
    }

    function add() {
        $user_id = $this->tank_auth->get_user_id();
        $role = $this->session->userdata('role_id');
        $data['role'] = $role;
        if($role == 1 or $role == 2 or $role == 5) {
            $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"(role ='3' or role ='4') and activated = 1");
        } else if($role == 3){
            $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"(role ='3' or role ='4') and activated = 1 and parent_id = '".$user_id."'");
        } 
        
        
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
                $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"(role ='3' or role ='4') and activated = 1");
                $data['states'] = $this->Common->get_list(TBL_STATES,'id','name','country_id = 101');
                $data['cities'] = $this->Common->get_list(TBL_CITIES, "id", "name", "state_id = $data_obj->state_id");
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
        if ($this->input->post()) {

            $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
            $error_element = error_elements();
            $this->form_validation->set_rules('client_name', 'Client Name', 'required');
            $this->form_validation->set_rules('franchisee_id', 'Franchisee Name', 'required');
            //$this->form_validation->set_rules('person_name', 'Person Name', 'required');
            //$this->form_validation->set_rules('designation_id', 'Person Designation', 'required');
            //$this->form_validation->set_rules('person_email', 'Person Email', 'required');
            //$this->form_validation->set_rules('person_mobile', 'Person Mobile', 'required');
            
            
            /*if (empty($_FILES['Image']['name']) && $this->input->post('old_Image') == '') {
                $this->form_validation->set_rules('Image', 'Banner Image', 'required');
            }*/
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $role = $this->session->userdata('role_id');
                $post_data = array(
                    "client_name" => $this->input->post('client_name'),
                    "franchisee_id" => ($role != 4 ) ?  $this->input->post('franchisee_id') : $this->tank_auth->get_user_id(),
                    "contact_person" => $this->input->post('contact_person'),
                    "client_email" => $this->input->post('email'),
                    "phone" => $this->input->post('mobile'),
                    "status" => 'Active',
                    "address" => $this->input->post('address'),
                    "pincode" => $this->input->post('pincode'),
                    "state_id" => $this->input->post('state_id'),
                    "city_id" => $this->input->post('city_id'),
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
                if ($this->Common->check_is_exists($this->table_name, $post_data['client_name'], "client_name", $id, $field = $this->PrimaryKey)):
                    $response['heading'] = $this->title.' Name details already exists';
                    $response['message'] = $this->title.' Name details already exists, Use another one..!';
                    echo json_encode($response);
                    die;
                endif;
                if ($id > 0):
                    $post_data['updated_at'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        //$this->load->model('Remove_records');
                        //$del_person_data = $this->Remove_records->remove_data($id,'company_id',TBL_COMPANY_PERSON);
                        /*for($i=0;$i<count($this->input->post('person_name')) ; $i++){
                            $person_data = array(
                                "company_id" => $id,
                                "person_name" => $this->input->post('person_name')[$i],
                                "person_designation" => $this->input->post('designation_id')[$i],
                                "person_email" => $this->input->post('person_email')[$i],
                                "person_mobile" => $this->input->post('person_mobile')[$i],
                                "is_send_mail" => (isset($this->input->post('is_send_mail')[$i])) ? 1 : 0,
                            );
                            $this->Common->add_info(TBL_COMPANY_PERSON, $person_data);
                        }*/
                        $response = array("status" => "ok", "heading" => "Updated successfully...", "message" => "Client updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Updated...", "message" => "Client not updated successfully.");
                    endif;
                else:
                    $post_data['created_at'] = date("Y-m-d H:i:s");
                    $post_data['user_id'] = $this->tank_auth->get_user_id();

                    if ($id = $this->Common->add_info($this->table_name, $post_data)):
                        
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Client added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Client not added successfully.");
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

    function get_city() {
        $state_id = $this->input->post('id');
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
                $message = "Client activated successfully.";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Client deactivated successfully.";
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

        $this->datatables->select('c.'.$this->PrimaryKey.', client_name, fullname,contact_person,client_email,phone');
        $this->datatables->from($this->table_name . ' c')
                ->join(TBL_USERS . ' u', 'u.id = c.franchisee_id', 'LEFT')
            ->add_column('status', '$1', 'active_row($1,' . $this->table_name.',c.'.$this->PrimaryKey.',client)')
                ->add_column('action', $this->action_row('$1'), 'c.'.$this->PrimaryKey);
        if(($this->session->userdata('role_id') != '1') and ($this->session->userdata('role_id') != '2')){
            $this->datatables->where('franchisee_id',$this->tank_auth->get_user_id());
        }
        $this->datatables->unset_column('c.'.$this->PrimaryKey);
        echo $this->datatables->generate();
    }

    function show_person_data($id) {
        $contact_person = '<a href="javascript:;" class="btn btn-sm btn-soft-secondary show_person_data" data-id="'.$id.'"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> Persons Data</a>';

        return $contact_person;
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