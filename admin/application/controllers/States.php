<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class States extends CI_Controller {

    public $table_name = TBL_STATES;
    public $controllers = 'states';
    public $view_name = 'states';
    public $title = 'States';
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
					<li class="breadcrumb-item text-grey-900">States</li>
					<!--end::Item-->';        

        $this->load->view('main_content', $data);
    }

    function add() {
        $data['page_title'] = "Add New " . $this->title;
        $this->load->view($this->view_name . '/form', $data);
    }

    function edit($id) {

        $data_found = 0;
        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            if (is_object($data_obj) && count((array)$data_obj) > 0) {
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
            $this->form_validation->set_rules('state_name', 'State Name', 'required');
            /*if (empty($_FILES['Image']['name']) && $this->input->post('old_Image') == '') {
                $this->form_validation->set_rules('Image', 'Banner Image', 'required');
            }*/
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "name" => $this->input->post('state_name'),
                    "short_name" => $this->input->post('short_name'),
                    "rto_code" => $this->input->post('rto_code'),
                    "state_id" => 101
                );
                if ($this->Common->check_is_exists($this->table_name, $post_data['name'], "name", $id, $field = $this->PrimaryKey)):
                    $response['heading'] = $this->title.' Name details already exists';
                    $response['message'] = $this->title.' Name details already exists, Use another one..!';
                    echo json_encode($response);
                    die;
                endif;
                if ($id > 0):
                    $post_data['updated_at'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Updated successfully...", "message" => "State updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Updated...", "message" => "State not updated successfully.");
                    endif;
                else:
                    $post_data['created_at'] = date("Y-m-d H:i:s");
                    if ($this->Common->add_info($this->table_name, $post_data)):
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "State added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "State not added successfully.");
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

    function activated($id) {
        if ($id > 0) {
            $IsFeatured = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey, FALSE, 'isActive');
            if ($IsFeatured->isActive == 0) {
                $activated = 1;
                $status = "ok";
                $heading = "Success";
                $message = "State activated successfully.";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "State deactivated successfully.";
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

        $this->datatables->select($this->PrimaryKey.', name,short_name,rto_code');
        $this->datatables->from($this->table_name)
                ->where('country_id',101)
                ->add_column('action', $this->action_row('$1'), $this->PrimaryKey);
        //$this->datatables->edit_column('Image', $this->show_image('$1'), 'Image');
        $this->datatables->unset_column($this->PrimaryKey);
        echo $this->datatables->generate();
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