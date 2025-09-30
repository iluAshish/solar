<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Designation extends CI_Controller {

    public $table_name = TBL_DESIGNATION;
    public $controllers = 'designation';
    public $view_name = 'designation';
    public $title = 'Designation';
    public $PrimaryKey = 'designation_id';
    
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
            $this->form_validation->set_rules('designation_name', 'Designation Name', 'required');
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "designation_name" => $this->input->post('designation_name'),
                    "description" => $this->input->post('description'),
                    "is_active" => 1,
                );
                if ($this->Common->check_is_exists($this->table_name, $post_data['designation_name'], "designation_name", $id, $field = $this->PrimaryKey)):
                    $response['heading'] = $this->title.' Name details already exists';
                    $response['message'] = $this->title.' Name details already exists, Use another one..!';
                    echo json_encode($response);
                    die;
                endif;
                if ($id > 0):
                    $post_data['modified_on'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Updated successfully...", "message" => "Designation updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Updated...", "message" => "Designation not updated successfully.");
                    endif;
                else:
                    $post_data['created_on'] = date("Y-m-d H:i:s");
                    if ($this->Common->add_info($this->table_name, $post_data)):
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Designation added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Designation not added successfully.");
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
                $message = "Designation activated successfully.";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Designation deactivated successfully.";
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

        $this->datatables->select($this->PrimaryKey.', designation_name,description');
        $this->datatables->from($this->table_name)
                ->add_column('is_active', '$1', 'active_row($1,' . $this->table_name.',' . $this->PrimaryKey.',designation)')
                ->add_column('action', $this->action_row('$1'), $this->PrimaryKey);
        $this->datatables->unset_column($this->PrimaryKey);
        echo $this->datatables->generate();
    }

    function action_row($id) {
        $action = <<<EOF
            <div class="dropdown d-inline-block">
                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-fill align-middle"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item btn edit-item-btn open_my_form_form" data-id="{$id}" data-original-title="Edit {$this->title}" data-placement="top" data-toggle="tooltip" data-control={$this->controllers} href="javascript:;"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                    <li>
                        <a class="dropdown-item btn remove-item-btn delete_btn" data-original-title="Remove {$this->title}" data-method=remove data-table="{$this->table_name}" data-column="{$this->PrimaryKey}" data-id="{$id}"  data-placement="top" data-toggle="tooltip" href="javascript:;">
                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
            
EOF;
        return $action;
    }

}