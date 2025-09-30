<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SendMail extends CI_Controller {

    public $table_name = TBL_PRODUCT;
    public $controllers = 'sendMail';
    public $view_name = 'send-mail';
    public $title = 'Product';
    public $PrimaryKey = 'product_id';

    function __construct() {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login/');
        }
        $this->load->Model('Remove_records');
    }

    function index() {
        $data['companies'] = $this->Common->get_list(TBL_COMPANY,'company_id','company_name','is_active = 1');
        $data['page_title'] = "Manage " . $this->title;
        $data['main_content'] = $this->view_name . '/index';
        $this->load->view('main_content', $data);
    }


    function send_mail() {
        if ($this->input->post()) {
            $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
            $error_element = error_elements();
            //$this->form_validation->set_rules('brand_id', 'Brand Name', 'required');
            //$this->form_validation->set_rules('company_id[]', 'Company Name', 'required');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            
            if ($this->form_validation->run()) {
                if($this->input->post('companies_id')[0] == 'all') {
                    $companies = array_keys($this->Common->get_list(TBL_COMPANY,'company_id','company_name','is_active = 1'));
                    
                } else {
                    $companies = $this->input->post('companies_id');
                }
                $c_ids = implode(', ', $companies);
                $c_email = $this->Common->get_all_info("", TBL_COMPANY_PERSON, '','company_id in ('.$c_ids.') and is_send_mail = 1','person_name,person_email as email');
                $settings = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
                $from = $settings->email;
                $projectName = $settings->company_name;
                $subject = $this->input->post('subject');
                $post_data['site_name'] = 'Futek Automation';
                $post_data['message'] = $this->input->post('description');
                foreach($c_email as $company_data) {
                    $post_data['name'] = $company_data->email;
                    $this->Common->_send_email('marketing', $subject, $company_data->email, $post_data);
                }
            } else {
                $errors = $this->form_validation->error_array();
                $response['error'] = $errors;
            }
            echo json_encode($response);
            die;
        }
    }

}
