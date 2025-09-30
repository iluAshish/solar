<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brand extends CI_Controller {

    public $table_name = TBL_BRAND;
    public $controllers = 'brand';
    public $view_name = 'brand';
    public $title = 'Brand';
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
            $this->form_validation->set_rules('brand_name', 'Brand Name', 'required');
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "brand_name" => $this->input->post('brand_name'),
                    "description" => $this->input->post('description'),
                    "status" => 1,
                );
                if ($this->Common->check_is_exists($this->table_name, $post_data['brand_name'], "brand_name", $id, $field = $this->PrimaryKey)):
                    $response['heading'] = $this->title.' Name details already exists';
                    $response['message'] = $this->title.' Name details already exists, Use another one..!';
                    echo json_encode($response);
                    die;
                endif;
                if ($id > 0):
                    $post_data['updated_at'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Updated successfully...", "message" => "Brand updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Updated...", "message" => "Brand not updated successfully.");
                    endif;
                else:
                    $post_data['created_at'] = date("Y-m-d H:i:s");
                    if ($this->Common->add_info($this->table_name, $post_data)):
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Brand added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Brand not added successfully.");
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
            $IsFeatured = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey, FALSE, 'is_active');
            if ($IsFeatured->is_active == 0) {
                $activated = 1;
                $status = "ok";
                $heading = "Success";
                $message = "Brand activated successfully.";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Brand deactivated successfully.";
            }
            $data = array(
                "is_active" => $activated,
            );

            if ($this->Common->update_info($id, $this->table_name, $data, $this->PrimaryKey)) {  
                $response = array("status" => $status, "heading" => $heading, "message" => $message);
                echo json_encode($response);
                die;
            }

        }
    }

    function manage() {

        $this->datatables->select($this->PrimaryKey.', brand_name,description');
        $this->datatables->from($this->table_name)
                //->add_column('is_active', '$1', 'active_row($1,' . $this->table_name.',' . $this->PrimaryKey.',brand)')
                ->add_column('action', $this->action_row('$1'), $this->PrimaryKey);
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