<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subcategory extends CI_Controller {

    public $table_name = TBL_SUBCATEGORY;
    public $controllers = 'subcategory';
    public $view_name = 'subcategory';
    public $title = 'Subcategory';
    public $PrimaryKey = 'SubcategoryID';
    
    function __construct() {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login/');
        }
    }

    function index() {
        $data['category'] = $this->Common->get_list(TBL_CATEGORY,'CategoryID','CategoryName','isActive = 1');
        $data['page_title'] = "Manage " . $this->title;
        $data['main_content'] = $this->view_name . '/list';
        $this->load->view('main_content', $data);
    }

    function add() {
        $data['category'] = $this->Common->get_list(TBL_CATEGORY,'CategoryID','CategoryName','isActive = 1');
        $data['page_title'] = "Add New " . $this->title;
        $this->load->view($this->view_name . '/form', $data);
    }

    function edit($id) {
        $data_found = 0;

        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            if (is_object($data_obj) && count((array)$data_obj) > 0) {
                $data['category'] = $this->Common->get_list(TBL_CATEGORY,'CategoryID','CategoryName','isActive = 1');
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
            $this->form_validation->set_rules('SubcategoryName', 'Subcategory Name', 'required');
            if (empty($_FILES['Image']['name']) && $this->input->post('old_Image') == '') {
                $this->form_validation->set_rules('Image', 'Banner Image', 'required');
            }
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "SubcategoryName" => $this->input->post('SubcategoryName'),
                    "CategoryID" =>  $this->input->post('CategoryID'),
                    "isActive" => 1,
                );
                if (!empty($_FILES['Image']['name'])) {
                    $file_data = upload_file('Image', UPLOAD_DIR.CATEGORY, ($this->input->post('old_Image')) ? $this->input->post('old_Image') : '');
                    if (is_array($file_data) && $file_data['file_name'] != "") {
                        $post_data['Image'] = $file_data['file_name'];
                    } else {
                        $response['message'] = $file_data;
                        echo json_encode($response);
                        die;
                    }
                }

                if ($this->Common->check_is_exists($this->table_name, $post_data['SubcategoryName'], "SubcategoryName", $id, $field = $this->PrimaryKey)):
                    $response['heading'] = $this->title.' Name details already exists';
                    $response['message'] = $this->title.' Name details already exists, Use another one..!';
                    echo json_encode($response);
                    die;
                endif;

                if ($id > 0):
                    $post_data['ModifiedBy'] = $this->tank_auth->get_username();
                    $post_data['ModifiedOn'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Updated successfully...", "message" => "Sub category updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Updated...", "message" => "Sub category not updated successfully.");
                    endif;

                else:
                    $post_data['CreatedOn'] = date("Y-m-d H:i:s");
                    $post_data['CreatedBy'] = $this->tank_auth->get_username();
                    if ($this->Common->add_info($this->table_name, $post_data)):
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Sub category added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Sub category not added successfully.");
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
                $message = "Sub Category activated successfully.";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Sub Category deactivated successfully.";
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
        $this->datatables->select($this->PrimaryKey.', SubcategoryName,Image');
        $this->datatables->from($this->table_name)
                ->add_column('isActive', '$1', 'subcategory_active_row(' . $this->PrimaryKey.')')
                ->add_column('action', $this->action_row('$1'), $this->PrimaryKey);
                $this->datatables->edit_column('Image', $this->show_image('$1'), 'Image');
        $this->datatables->unset_column($this->PrimaryKey);
        echo $this->datatables->generate();
    }

    function show_image($image) {
        $url = UPLOAD_DIR . CATEGORY.$image;
        $defaultimage = DEFAULT_AVATAR;
        $image = '<img src="'.$url.'" width="80px" height="60px" onerror="this.onerror=null;this.src=\''.$defaultimage.'\';">';
        return $image;
    }

    function action_row($id) {
        $action = <<<EOF
            <div class="tooltip-top">
                <a data-original-title="Edit {$this->title}" data-placement="top" data-toggle="tooltip" href="javascript:;" class="btn btn-xs btn-default btn-equal btn-mini open_my_form_form" data-id="{$id}" data-control="{$this->controllers}"><i class="fa fa-pencil"></i></a>
                <a data-original-title="Remove {$this->title}" data-placement="top" data-toggle="tooltip" href="javascript:;" class="btn btn-xs btn-default btn-equal delete_btn btn-mini" data-id="{$id}" data-method="{$this->controllers}"><i class="fa fa-trash-o"></i></a>
            </div>
EOF;
        return $action;
    }

}