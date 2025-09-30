<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public $table_name = TBL_USERS;
    public $controllers = 'user';
    public $view_name = 'users';
    public $title = 'Users';
    public $PrimaryKey = 'id';

    function __construct() {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login/');
        }
        $role_id = $this->session->userdata('role_id');
        $permission = check_permission('user','is_view');
		if($role_id == 1 or $permission->is_view == 1) {
		} else {
		    redirect('dashboard');
		}
    }

    function index() {
        $data['page_title'] = "Manage " . $this->title;
        $data['main_content'] = $this->view_name . '/list';
        $data['breadcrumb'] = '<!--begin::Item-->
					<li class="breadcrumb-item text-grey-900">Users</li>
					<!--end::Item-->';        
        $this->load->view('main_content', $data);
    }

    function role() {
        $data['page_title'] = "Manage " . $this->title;
        $data['main_content'] = $this->view_name . '/roles';
        $data['breadcrumb'] = '<!--begin::Item-->
					<li class="breadcrumb-item text-grey-900">Users</li>
					<!--end::Item-->';
		$data['roles'] = $this->Common->get_all_info('',TBL_ROLE);
        $this->load->view('main_content', $data);
    }

    function add() {
        $data['page_title'] = "Add New " . $this->title;
        $data['states'] = $this->Common->get_list(TBL_STATES,'id','name','country_id = 101');
        $data['roles'] = $this->Common->get_list(TBL_ROLE,'role_id','role_name');
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        $franchisee = $this->Common->get_info(1, $this->table_name, '','franchisee_code like "%'.date('Y').'%"','*','','',array('field'=>'id','order'=>'desc'),1);
        if($franchisee) {
            list($code_prefix,$code_num) = sscanf($franchisee->franchisee_code,"%[A-Za-z]%[0-9]");
            $data['franchisee_code'] = $code_prefix . str_pad($code_num + 1,4,'0',STR_PAD_LEFT).'/'.date('Y');
            
        } else {
            $data['franchisee_code'] = $data['settings']->franchisee_code.'0001/'.date('Y');
        }        
        $this->load->view($this->view_name . '/form', $data);
    }

    function edit($id) {
        $data_found = 0;
        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            $data['states'] = $this->Common->get_list(TBL_STATES,'id','name','country_id = 101');
            $data['districts'] = $this->Common->get_list(TBL_DISTRICTS, "id", "name", "state_id = $data_obj->state_id");
            $data['roles'] = $this->Common->get_list(TBL_ROLE,'role_id','role_name');
            if (is_object($data_obj) && count((array) $data_obj) > 0) {
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
            $this->form_validation->set_rules('fullname', 'Name', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
            if ($id <= 0) {
                $this->form_validation->set_rules('password', 'Password', 'required');
            }
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);    
            if ($this->form_validation->run()) {
                $post_data = array(
                    "fullname" => $this->input->post('fullname'),
                    "email" => $this->input->post('email'),
                    "mobile" => $this->input->post('mobile') ? $this->input->post('mobile') : "",
                    "activated" => 1,
                    "role" => $this->input->post('role'),
                    "address" => $this->input->post('address'),
                    "pincode" => $this->input->post('pincode'),
                    "state_id" => $this->input->post('state_id'),
                    "district_id" => $this->input->post('district_id'),
                    //"franchisee_level" => $this->input->post('franchisee_level'),
                );
                if ($this->Common->check_is_exists($this->table_name, $post_data['email'], "email", $id, $field = $this->PrimaryKey)):
                    $response['heading'] = $this->title.' Email already exists';
                    $response['message'] = $this->title.' Email already exists, Use another one..!';
                    echo json_encode($response);
                    die;
                endif;                

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
                    
                    //code settings
                    $franchisee = '';
                    $settings = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
                    if($post_data['role'] == '3') {
                        $post_data["franchisee_level"] = 'State';
                        $state_data = $this->Common->get_info($post_data['state_id'], TBL_STATES, 'id');
                        $fcode_like = $settings->franchisee_code.$state_data->short_name.'/';
                        $franchisee = $this->Common->get_info(1, $this->table_name, '','(franchisee_code like "%'.$fcode_like.'%" and role = "'.$post_data['role'].'")','*','','',array('field'=>'id','order'=>'desc'),1);
                    } else if($post_data['role'] == '4') {
                        $post_data["franchisee_level"] = 'District';
                        $state_data = $this->Common->get_info($post_data['state_id'], TBL_STATES, 'id');
                        $district_data = $this->Common->get_info($post_data['district_id'], TBL_DISTRICTS, 'id');
                        $fcode_like = $settings->franchisee_code.$state_data->short_name.'/'.$district_data->rto_code.'/';
                        $franchisee = $this->Common->get_info(1, $this->table_name, '','(franchisee_code like "%'.$fcode_like.'%" and role = "'.$post_data['role'].'")','*','','',array('field'=>'id','order'=>'desc'),1);
                    } else if($post_data['role'] == '5') {
                        $settings = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
                        $state_data = $this->Common->get_info($post_data['state_id'], TBL_STATES, 'id');
                        $fcode_like = $settings->franchisee_code.$state_data->short_name.'/';
                        $franchisee = $this->Common->get_info(1, $this->table_name, '','(franchisee_code like "%'.$fcode_like.'%" and role = "'.$post_data['role'].'")','*','','',array('field'=>'id','order'=>'desc'),1);
                    } else if($post_data['role'] == '2') {
                        $settings = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
                        $fcode_like = $settings->franchisee_code.'IND/';
                        $franchisee = $this->Common->get_info(1, $this->table_name, '','(franchisee_code like "%'.$fcode_like.'%" and role = "'.$post_data['role'].'")','*','','',array('field'=>'id','order'=>'desc'),1);
                        if($franchisee) {
                            $post_data['franchisee_code'] = ++$franchisee->franchisee_code;
                        } else {
                            $post_data['franchisee_code'] = $settings->franchisee_code.$fcode_like.'0001';
                        }        
                    }
                    if($post_data['role'] != '1') {
                        $post_data['franchisee_code'] = ($franchisee) ? ++$franchisee->franchisee_code : $fcode_like.'0001';
                    } else {
                        $post_data['franchisee_code'] = 'SITPL/SE/IND/Admin';
                    }
                    
                    if ($this->Common->add_info($this->table_name, $post_data)):
                        if(($this->input->post('is_vendor')) && $this->input->post('is_vendor') == '1') {    
                            $vendor_data = array(
                                "vendor_name" => $this->input->post('fullname'),
                                "vendor_email" => $this->input->post('email'),
                                "phone" => $this->input->post('mobile') ? $this->input->post('mobile') : "",
                                "status" => 'Active',
                                "address" => $this->input->post('address'),
                                "pincode" => $this->input->post('pincode'),
                                "state_id" => $this->input->post('state_id'),
                            );
                            $this->Common->add_info(TBL_VENDORS, $vendor_data);
                        }
                        $post_data["passwordUser"] = $password;
                        $post_data['site_name'] = WEBSITE_NAME;
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
    
    function submit_role_form() {
        if ($this->input->post()) {
            $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
            $error_element = error_elements();
            $this->form_validation->set_rules('role', 'Role Id', 'required');
            
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $this->load->model('Remove_records');
                $role_id = $this->input->post('role');
                $del_pro_data = $this->Remove_records->remove_data($role_id,'role_id',TBL_PERMISSIONS);
                $post_data['updated_at'] = date("Y-m-d H:i:s");
                $post_data['created_at'] = date("Y-m-d H:i:s");
                for($i=0;$i<count($this->input->post('module_name')) ; $i++){
                    $post_data = array(
                        "role_id" => $role_id,
                        "module_name" => $this->input->post('module_name')[$i],
                        "is_view" => $this->input->post('view')[$i],
                        "is_add" => $this->input->post('insert')[$i],
                        "is_edit" => $this->input->post('update')[$i],
                        "is_delete" => $this->input->post('delete')[$i]
                    );
                    $this->Common->add_info(TBL_PERMISSIONS, $post_data);
                }
                $response = array("status" => "ok", "heading" => "Permission set successfully...", "message" => "Permission set successfully");
            } else {
                $errors = $this->form_validation->error_array();
                $response['error'] = $errors;
            }
            echo json_encode($response);
            die;
        }
    }
    
    function idcard($id) {
        $data_found = 0;
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            if (is_object($data_obj) && count((array) $data_obj) > 0) {
                $data['aadhar_info'] = $this->Common->get_info($data_obj->id, TBL_AADHAR_DATA, 'franchisee_id');
                $data['user_image'] = base64_to_jpeg($data['aadhar_info']->photo_link,UPLOAD_DIR.'profile/'.$data_obj->fullname.'.jpg');
                $data["data_info"] = $data_obj;
                $data_found = 1;
            }
        }
        if ($data_found == 0) {
            redirect('/');
        }

        $data['page_title'] = "View " . $this->title;
        $data['main_content'] = $this->view_name . '/id-card';
        $this->load->view('main_content', $data);
    }

    function emiCalculator() {
        $data['page_title'] = "EMI Calculator";
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        $data['main_content'] = $this->view_name . '/emi-calculator';
        $this->load->view('main_content', $data);
    }

    function getEmiAmount() {
        $principal = $this->input->post('amount');
        $rate = $this->input->post('rate');
        $tenture = $this->input->post('tenture');
        $emiAmount = calculateEMI($principal, $rate, $tenture);
        $response = array("status" => "ok", "emi_amount" => round($emiAmount, 2));
        echo json_encode($response);
        die;
    }

    function visitingcard($id) {
        $data_found = 0;
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            if (is_object($data_obj) && count((array) $data_obj) > 0) {
                $data['aadhar_info'] = $this->Common->get_info($data_obj->id, TBL_AADHAR_DATA, 'franchisee_id');
                $data['user_image'] = base64_to_jpeg($data['aadhar_info']->photo_link,UPLOAD_DIR.'profile/'.$data_obj->fullname.'.jpg');
                $data["data_info"] = $data_obj;
                $data_found = 1;
            }
        }
        if ($data_found == 0) {
            redirect('/');
        }

        $data['page_title'] = "View " . $this->title;
        $data['main_content'] = $this->view_name . '/visitng-card';
        $this->load->view('main_content', $data);
    }
    function certificate($id) {
        $data_found = 0;
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            if (is_object($data_obj) && count((array) $data_obj) > 0) {
                $data['aadhar_info'] = $this->Common->get_info($data_obj->id, TBL_AADHAR_DATA, 'franchisee_id');
                $data['user_image'] = base64_to_jpeg($data['aadhar_info']->photo_link,UPLOAD_DIR.'profile/'.$data_obj->fullname.'.jpg');
                $data["data_info"] = $data_obj;
                $data_found = 1;
            }
        }
        if ($data_found == 0) {
            redirect('/');
        }

        $data['page_title'] = "View " . $this->title;
        $data['main_content'] = $this->view_name . '/certificate';
        $this->load->view('main_content', $data);
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

    function permission($id) {
        $data_found = 0;
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['roles'] = $this->Common->get_list(TBL_ROLE,'role','role');
        $data['modules'] = array('user','clients','projects','category','products','quotation','invoice');
		$data['permissions'] = $this->Common->get_all_info($id,TBL_PERMISSIONS,'role_id');
        $data['role_id'] = $id; 

        //$data['subcategory'] = array();
        $data['page_title'] = "Add New " . $this->title;
        $data['main_content'] = $this->view_name . '/permission';
        $this->load->view('main_content', $data);
    }


    function manage() {
        $this->datatables->select($this->PrimaryKey . ',franchisee_level,franchisee_code,fullname,(case when is_aadhar_verified = 1 then "Yes" else "No" end) as aadhar,(case when is_pan_verified = 1 then "Yes" else "No" end) as pan,role_name,email,mobile');
        $this->datatables->from($this->table_name. ' u')
                ->add_column('activated', '$1', 'user_active_row($1,' . $this->table_name.',' . $this->PrimaryKey.',user)')
                ->add_column('action', '$1', 'user_action_row($1,' . $this->table_name.',' . $this->PrimaryKey.',user)');
        $this->datatables->join(TBL_ROLE.' r','r.role_id = u.role', 'LEFT');        
        $this->datatables->where("role != 'SuperAdmin' and id != '".$this->tank_auth->get_user_id()."'");
        $this->datatables->unset_column($this->PrimaryKey);
        $this->datatables->order_by($this->PrimaryKey);
        echo $this->datatables->generate();
    }

    function profile() {
        $data_found = 0;
        $data_obj = $this->Common->get_info($this->tank_auth->get_user_id(), $this->table_name, $this->PrimaryKey);
        $data['user_img'] =  ($data_obj->profilepic != '' && file_exists(UPLOAD_DIR.USERS.$data_obj->profilepic)) ? base_url().UPLOAD.USERS.$data_obj->profilepic : base_url().'assets/media/svg/avatars/blank.svg';
        $data['states'] = $this->Common->get_list(TBL_STATES,'id','name','country_id = 101');
        $data['districts'] = $this->Common->get_list(TBL_DISTRICTS, "id", "name", "state_id = $data_obj->state_id");
        $data['roles'] = $this->Common->get_list(TBL_ROLE,'role_id','role_name');
        if (is_object($data_obj) && count((array) $data_obj) > 0) {
            $data["data_info"] = $data_obj;
            $data_found = 1;
        } 
        if ($data_found == 0) {
            redirect('/');
        }
        $data['page_title'] = "My Profile";
        $data['main_content'] = $this->view_name . '/profile';
        $this->load->view('main_content', $data);
    }

    function update_profile() {
        if ($this->input->post()) {
            $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
            $error_element = error_elements();
            $this->form_validation->set_rules('fullname', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "fullname" => $this->input->post('fullname'),
                    "email" => $this->input->post('email'),
                    "mobile" => $this->input->post('mobile') ? $this->input->post('mobile') : "",
                    "address" => $this->input->post('address'),
                    "pincode" => $this->input->post('pincode'),
                    //"franchisee_level" => $this->input->post('franchisee_level'),
                );
                if ($this->Common->check_is_exists($this->table_name, $post_data['email'], "email", $id, $field = $this->PrimaryKey)):
                    $response['heading'] = $this->title.' Email already exists';
                    $response['message'] = $this->title.' Email already exists, Use another one..!';
                    echo json_encode($response);
                    die;
                endif;                

                if (!empty($_FILES['profile_pic']['name'])) {
                    $file_data = upload_file('profile_pic', UPLOAD_DIR.USERS, ($this->input->post('old_image')) ? $this->input->post('old_image') : '');
                    if (is_array($file_data) && $file_data['file_name'] != "") {
                        $post_data['profilepic'] = $file_data['file_name'];
                    } else {
                        $response['message'] = $file_data;
                        echo json_encode($response);
                        die;
                    }
                }

                if ($id > 0):
                    $post_data['modified'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Profile Updated successfully...", "message" => "Profile updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Profile Not Updated...", "message" => "Profile not updated successfully.");
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
    
    function get_client() {
        $franchisee_id = $this->input->post('id');
        $GetCat = $this->Common->get_list(TBL_CLIENTS, "id", "client_name", "franchisee_id = $franchisee_id");
        if (!empty($GetCat)) {
            $response = array("status" => "ok", "data" => $GetCat);
        } else {
            $response = array("status" => "error");
        }
        echo json_encode($response);
        die;
    }
    
    function get_project() {
        $client_id = $this->input->post('id');
        $GetCat = $this->Common->get_list(TBL_PROJECTS, "id", "project_name", "client_id = $client_id");
        if (!empty($GetCat)) {
            $response = array("status" => "ok", "data" => $GetCat);
        } else {
            $response = array("status" => "error");
        }
        echo json_encode($response);
        die;
    }
    
    
    function action_row($id) {
        $action = <<<EOF
            <a class="btn btn-icon btn-warning w-30px h-30px me-3 " href="user/permission/{$id}" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
				<i class="fas fa-lock-open"></i>
			</a>
            <a class="btn btn-icon btn-info w-30px h-30px me-3 " href="user/visitingcard/{$id}" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
				<i class="fas fa-address-card"></i>
			</a>
            <a class="btn btn-icon btn-secondary w-30px h-30px me-3 " href="user/certificate/{$id}" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
				<i class="fa fa-medal"></i>
			</a>
            <a class="btn btn-icon btn-success w-30px h-30px me-3 " href="user/idcard/{$id}" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
				<i class="fas fa-id-card-clip"></i>
			</a>
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

    function send_aadhar_otp () {
        $aadhar_no = $this->input->post('aadhar_number');
        if($aadhar_no != '') {
            $url = "https://api.cashfree.com/verification/offline-aadhaar/otp";
            $data = (json_encode(array('aadhaar_number'=> $aadhar_no)));
            //$data = '{\n  \"aadhaar_number\": \"'.$aadhar_no.'\"\n}';
            $response = json_decode($this->Common->cashfree_verification_api($url,$data));
            if((isset($response->type)) &&  $response->type == 'validation_error') {
                $response = array("status" => "error",'message' => $response->message);
            } else {
                if(isset($response->ref_id)) {
                    $response = array("status" => "ok",'message' => $response->message,'ref_id' => $response->ref_id); 
                } else {
                    $response = array("status" => "error",'message' => $response->message);
                }
            }
        } else {
            $response['error'] = 'AAdhar number is required';
        }
        echo json_encode($response);
        die;
    }
    
    function verify_aadhar_otp () {
        $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
        $error_element = error_elements();
        $this->form_validation->set_rules('otp', 'OTP', 'required');
        $this->form_validation->set_rules('ref_id', 'Reference ID', 'required');
        $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
        if ($this->form_validation->run()) {    
            $otp = $this->input->post('otp');
            $ref_id = $this->input->post('ref_id');
            $url = "https://api.cashfree.com/verification/offline-aadhaar/verify";
            $data = json_encode(array('otp'=> $otp, 'ref_id' => $ref_id));
            $response = json_decode($this->Common->cashfree_verification_api($url,$data));
            if((isset($response->type)) && ($response->type  == 'validation_error')) {
                $response = array("status" => "error",'message' => $response->message);
            } else {
                if(isset($response->ref_id)) {
                    $post_data['is_aadhar_verfied'] = 1;
                    $post_data['modified'] = date("Y-m-d H:i:s");
                    $id = $this->tank_auth->get_user_id();
                    
                    $aadhar_data = array(
                        "reference_id" => $response->ref_id,
                        "aadhar_number" => $this->input->post('aadhar_number'),
                        "status" => $response->status,
                        "address" => $response->address,
                        "birthdate" => date('Y-m-d',strtotime($response->dob)),
                        "name" => $response->name,
                        "mobile_hash" => $response->mobile_hash,
                        "photo_link" => $response->photo_link,
                        "share_code" => $response->share_code,
                        "franchisee_id" => $id,
                    );
                    $this->Common->add_info(TBL_AADHAR_DATA, $aadhar_data);
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Aadhar verified successfully...", "message" => "Aadhar verified successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Aadhar not verified...", "message" => "Aadhar not verified successfully.");
                    endif;
                } else {
                    $response = array("status" => "error",'message' => $response->message);
                }
            }
        } else {
            $errors = $this->form_validation->error_array();
            $response['error'] = $errors;
        }
        echo json_encode($response);
        die;
    }
    
    function verify_pan () {
        $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
        $error_element = error_elements();
        $this->form_validation->set_rules('pan_number', 'Pan Number', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
        if ($this->form_validation->run()) {
            $pan_no = $this->input->post('pan_number');
            $name = $this->input->post('name');
            $url = "https://api.cashfree.com/verification/pan";
            $data = json_encode(array('pan'=> $pan_no, 'name' => $name));
            $response = json_decode($this->Common->cashfree_verification_api($url,$data));
            if((isset($response->type)) && ($response->type  == 'validation_error')) {
                $response = array("status" => "error",'message' => $response->message);
            } else {
                if(isset($response->reference_id)) {
                    $post_data['is_pan_verified'] = 1;
                    $post_data['modified'] = date("Y-m-d H:i:s");
                    $id = $this->tank_auth->get_user_id();
                    
                    $pan_data = array(
                        
                        "reference_id" => $response->reference_id,
                        "pan_number" => $pan_no,
                        "type" => $response->type,
                        "provided_name" => $response->name_provided,
                        "registered_name" => $response->registered_name,
                        "father_name" => $response->father_name,
                        "status" => $response->valid,
                        "franchisee_id" => $id,
                        
                    );
                    $this->Common->add_info(TBL_PAN_DATA, $pan_data);
                    
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Pan verified successfully...", "message" => "Pan verified successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Pan not verified...", "message" => "Pan not verified.");
                    endif;
                } else {
                    $response = array("status" => "error",'message' => $response->message);
                }
    
            }
        } else {
            $errors = $this->form_validation->error_array();
            $response['error'] = $errors;
        }
        echo json_encode($response);
        die;
    }
    
    function verify_bank () {
        $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
        $error_element = error_elements();
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('acc_number', 'Account Number', 'required');
        $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'required');
        $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
        if ($this->form_validation->run()) {
            $acc_number = $this->input->post('acc_number');
            $name = $this->input->post('name');
            $ifsc_code = $this->input->post('ifsc_code');
            $phone = $this->input->post('phone');
            
            $url = "https://api.cashfree.com/verification/bank-account/sync";
            $data = json_encode(array('name'=> $name, 'bank_account' => $acc_number, 'ifsc' => $ifsc_code, 'phone' => $phone));
            $response = json_decode($this->Common->cashfree_verification_api($url,$data));
            if((isset($response->type)) && ($response->type  == 'validation_error')) {
                $response = array("status" => "error",'message' => $response->message);
            } else {
                if(isset($response->reference_id)) {
                    $post_data['is_bank_verified'] = 1;
                    $post_data['modified'] = date("Y-m-d H:i:s");
                    $id = $this->tank_auth->get_user_id();
                    
                    $bank_data = array(
                        "name" => $name,
                        "account_number" => $acc_number,
                        "ifsc_code" => $ifsc_code,
                        "phone" => $phone,
                        "reference_id" => $response->reference_id,
                        "name_at_bank" => $response->name_at_bank,
                        "bank_name" => $response->bank_name,
                        "city" => $response->city,
                        "branch" => $response->branch,
                        "micr" => $response->micr,
                        "name_match_score" => ($response->name_match_score != '') ? $response->name_match_score : 0,
                        "name_match_result" => $response->name_match_result,
                        "status" => $response->account_status,
                        "account_status_code" => $response->account_status_code,
                        "utr" => (isset($response->utr)) ? $response->utr : 0,
                        "franchisee_id" => $id,
                        
                    );
                    $this->Common->add_info(TBL_BANK_DATA, $bank_data);
                    
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Bank verified successfully...", "message" => "Bank verified successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Bank Not verified...", "message" => "Bank data not verified.");
                    endif;
                } else {
                    $response = array("status" => "error",'message' => $response->message);
                }
    
            }
        } else {
            $errors = $this->form_validation->error_array();
            $response['error'] = $errors;
        }
        echo json_encode($response);
        die;
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
        $mail->addAddress($email, $data['fullname']);
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

    function get_district() {
        $state_id = $this->input->post('id');
        $GetCat = $this->Common->get_list(TBL_DISTRICTS, "id", "name", "state_id = $state_id");
        if (!empty($GetCat)) {
            $response = array("status" => "ok", "data" => $GetCat);
        } else {
            $response = array("status" => "error");
        }
        echo json_encode($response);
        die;
    }
    
    function generateCode() {
        $role = $this->input->post('Role');
        $user_code = '';
        $settings = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        if($role == '3') {
            $franchisee = $this->Common->get_info(1, $this->table_name, '','franchisee_code like "%'.date('Y').'%"','*','','',array('field'=>'id','order'=>'desc'),1);
            if($franchisee) {
                list($code_prefix,$code_num) = sscanf($franchisee->franchisee_code,"%[A-Za-z]%[0-9]");
                $user_code = $code_prefix . str_pad($code_num + 1,4,'0',STR_PAD_LEFT).'/'.date('Y');
                
            } else {
                $user_code = $settings->franchisee_code.'0001/'.date('Y');
            }        
        } else if($role == '4') {
            $franchisee = $this->Common->get_info(1, $this->table_name, '','franchisee_code like "%'.date('Y').'%"','*','','',array('field'=>'id','order'=>'desc'),1);
            if($franchisee) {
                list($code_prefix,$code_num) = sscanf($franchisee->franchisee_code,"%[A-Za-z]%[0-9]");
                $user_code = $code_prefix . str_pad($code_num + 1,4,'0',STR_PAD_LEFT).'/'.date('Y');
                
            } else {
                $user_code = $settings->franchisee_code.'0001/'.date('Y');
            }        
        }
        $response = array("status" => "ok", "user_code" => $user_code);
        echo json_encode($response);
        die;
    }

}
