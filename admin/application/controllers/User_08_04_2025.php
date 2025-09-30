<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public $table_name = TBL_USERS;
    public $controllers = 'user';
    public $view_name = 'users';
    public $title = 'User';
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
        $data['designations'] = $this->Common->get_list(TBL_DESIGNATION,'designation_id','designation_name','is_active = 1');
        $this->load->view($this->view_name . '/form', $data);
    }

    function edit($id) {
        $data_found = 0;
        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            if (is_object($data_obj) && count((array) $data_obj) > 0) {
                $data['designations'] = $this->Common->get_list(TBL_DESIGNATION,'designation_id','designation_name','is_active = 1');
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
            $this->form_validation->set_rules('staff_name', 'Name', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');
            //$this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_users.email]');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "staff_id" => $this->input->post('staff_id'),
                    "designation" => $this->input->post('designation_id'),
                    "staff_name" => $this->input->post('staff_name'),
                    "email" => $this->input->post('email'),
                    "mobile" => $this->input->post('mobile') ? $this->input->post('mobile') : "",
                    "activated" => 1,
                    "role" => $this->input->post('role'),
                );
                if ($id > 0):
                    $post_data['modified'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "User Updated successfully...", "message" => "User updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "User Not Updated...", "message" => "User not updated successfully.");
                    endif;
                else:
                    $post_data['created'] = date("Y-m-d H:i:s");
                    $hasher = new PasswordHash(
                    $this->config->item('phpass_hash_strength', 'tank_auth'), $this->config->item('phpass_hash_portable', 'tank_auth'));
                    //$password = generateRandomString(6);
                    $password = $this->input->post('password');
                    $hashed_password = $hasher->HashPassword($password);
                    $post_data["password"] = $hashed_password;
                    $post_data["username"] = $this->input->post('username');

                    if ($this->Common->add_info($this->table_name, $post_data)):
                        $post_data["passwordUser"] = $password;
                        $post_data['site_name'] = 'Futek Automation';
                        
                        $this->Common->_send_email('confirmation', 'New User Confirmation', $this->input->post('email'), $post_data);
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "User added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "User not added successfully.");
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
    function activated($id) {
        if ($id > 0) {
            $IsFeatured = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey, FALSE, 'activated');
            if ($IsFeatured->activated == 0) {
                $activated = 1;
                $status = "ok";
                $heading = "Success";
                $message = "User activated successfully.";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "User deactivated successfully.";
            }
            $data = array(
                "activated" => $activated,
            );

            if ($this->Common->update_info($id, $this->table_name, $data, $this->PrimaryKey)) {
                $response = array("status" => $status, "heading" => $heading, "message" => $message);
                echo json_encode($response);
                die;
            }
        }
    }
    function manage() {
        $this->datatables->select($this->PrimaryKey . ', staff_id,role,staff_name,designation_name,email,mobile');
        $this->datatables->from($this->table_name. ' u')
                ->join(TBL_DESIGNATION.' d','d.designation_id = u.designation','left')
                ->add_column('activated', '$1', 'user_active_row($1,' . $this->table_name.',' . $this->PrimaryKey.',user)')
                ->add_column('action', $this->action_row('$1'), $this->PrimaryKey);
        $this->datatables->where("role != 'SuperAdmin'");
        $this->datatables->unset_column($this->PrimaryKey);
        $this->datatables->order_by($this->PrimaryKey);
        echo $this->datatables->generate();
    }
    
    
    function action_row($id) {
        $action = <<<EOF
            <div class="dropdown d-inline-block">
                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-fill align-middle"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
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

    

    function _send_email_o($type, $subject, $email, &$data) {
        $password = EMAIL_PASSWORD;
        $emailid = EMAILID;
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_crypto' => 'tls',
            'smtp_port' => 587,
            'smtp_user' => $emailid,
            'smtp_pass' => $password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from('riyom.infotech@gmail.com');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($this->load->view('email/' . $type . '-html', $data, TRUE));
        $this->email->set_alt_message($this->load->view('email/' . $type . '-txt', $data, TRUE));
        $this->email->send();
        echo $this->email->print_debugger();
    }

    function _send_email($type, $subject, $email, &$data) {
        $this->load->library('phpmailer_library');
        $mail = $this->phpmailer_library->load();
        $response = false;
        //$mail =  $this->phpmailer_library;

        //Set PHPMailer to use the sendmail transport
        $mail->isSendmail();
        //Set who the message is to be sent from
        $mail->setFrom('riyom.infotech@gmail.com', 'Riyom Infotech');
        //Set an alternative reply-to address
        $mail->addReplyTo('riyom.infotech@gmail.com', 'Riyom Infotech');
        //Set who the message is to be sent to
        $mail->addAddress($email, $data['staff_name']);
        //Set the subject line
        $mail->Subject = 'Your registration details';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($this->load->view('email/' . $type . '-html', $data, TRUE));
        //Replace the plain text body with one created manually

        //send the message, check for errors
        if (!$mail->send()) {
            return 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return  'success';
        }
    }



}
