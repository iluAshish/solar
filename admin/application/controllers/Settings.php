<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    public $table_name = TBL_SETTINGS;
    public $controllers = 'settings';
    public $view_name = 'settings';
    public $title = 'Settings';
    public $PrimaryKey = 'setting_id';

    function __construct() {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login/');
        }
        $this->load->Model('Remove_records');
    }

    function index() {
        $data['page_title'] = "Add New " . $this->title;
        $data_obj = $this->Common->get_info(1, $this->table_name, $this->PrimaryKey);
        if (is_object($data_obj) && count((array) $data_obj) > 0) {
            $data["data_info"] = $data_obj;
        } 
        $data['breadcrumb'] = '<!--begin::Item-->
					<li class="breadcrumb-item text-grey-900">Setting</li>
					<!--end::Item-->'; 
        //$data['subcategory'] = array();
        $data['page_title'] = "Add New " . $this->title;
        $data['main_content'] = $this->view_name . '/index';
        $this->load->view('main_content', $data);
    }


    function submit_form() {
        if ($this->input->post()) {
            $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
            $error_element = error_elements();
            $this->form_validation->set_rules('company_name', 'Company Name', 'required');
            $this->form_validation->set_rules('gst_no', 'GST No', 'required');
            $this->form_validation->set_rules('mobile1', 'Mobile number', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            /*if (empty($_FILES['Image']['name']) && $this->input->post('old_Image') == '') {
                $this->form_validation->set_rules('Image', 'Product Image', 'required');
            }*/
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "company_name" => $this->input->post('company_name'),
                    "gst_no" => $this->input->post('gst_no'),
                    "mobile1" => $this->input->post('mobile1'),
                    "mobile2" => $this->input->post('mobile2'),
                    "email" => $this->input->post('email'),
                    "address" => $this->input->post('address'),
                    "quote_title" => $this->input->post('quote_title'),
                    "quote_note" => $this->input->post('quote_note'),
                    "quote_terms" => $this->input->post('quote_terms'),
                    "quote_footer" => $this->input->post('quote_footer'),
                    "franchisee_code" => $this->input->post('franchisee_code'),
                    "bank_details" => $this->input->post('bank_details'),
                );
                if (!empty($_FILES['Image']['name'])) {
                    $file_data = upload_file('Image', UPLOAD_DIR . PRODUCT_DIR, ($this->input->post('old_Image')) ? $this->input->post('old_Image') : '');
                    if (is_array($file_data) && $file_data['file_name'] != "") {
                        $post_data['product_image'] = $file_data['file_name'];
                    } else {
                        $response['message'] = $file_data;
                        echo json_encode($response);
                        die;
                    }
                }
                if ($id > 0):
                    $post_data['modified_on'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Product Updated successfully...", "message" => "Setting updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Product Not Updated...", "message" => "Setting not updated successfully.");
                    endif;
                else:
                    $post_data['modified_on'] = date("Y-m-d H:i:s");
                    $post_data['created_on'] = date("Y-m-d H:i:s");
                    if ($this->Common->add_info($this->table_name, $post_data)):
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Setting added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Setting not added successfully.");
                    endif;
                endif;
            } else {
                $errors = $this->form_validation->error_array();
                $response['error'] = $errors;
            }
            echo json_encode($response);
            die;
        }
    }

}
