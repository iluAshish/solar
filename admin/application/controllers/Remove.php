<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Remove extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login/');
        }
        $this->load->model('Remove_records');
       /* if ($this->input->post('pass') && !empty($this->input->post('pass'))):
            if (!$this->check_pass($this->input->post('pass'))):
                $response = array('status' => 'error', 'message' => 'Password not matched.');
                $this->response($response);
            endif;
        else:
            $response = array('status' => 'error', 'message' => 'Password enter valid password.');
            $this->response($response);
        endif; */
    }

    function check_pass($password) {
        $user = $this->users->get_user_by_username($this->tank_auth->get_username());
        if (count((array)$user) > 0):
            $hasher = new PasswordHash(
                    $this->config->item('phpass_hash_strength', 'tank_auth'), $this->config->item('phpass_hash_portable', 'tank_auth'));
            if ($hasher->CheckPassword($password, $user->password)):
                return TRUE;
            endif;
        endif;
        return FALSE;
    }

    function category($pid = 0, $where = 'CategoryID') {
        $id = ($pid > 0) ? $pid : (($this->input->post('id'))?$this->input->post('id'):0);
        if ($id > 0):
            $getCategoryImages = $this->Common->get_info($id, TBL_CATEGORY,'CategoryID');
            $path = UPLOAD_DIR.CATEGORY.$getCategoryImages->Image;
            @unlink($path);
            $data_remove = $this->Remove_records->remove_data($id, $where, TBL_CATEGORY);   
            if($pid > 0):
                return ($data_remove)?TRUE:FALSE;
            else:
                $response = ($data_remove)?array('status' => 'ok', 'message' => 'Details removed successfully.!'):array('status' => 'ok', 'message' => 'Details not removed successfully.!');
                $this->response($response);
            endif;
        endif;
    }

    function remove($pid = 0, $where = 'brand_id') {
        $id = ($pid > 0) ? $pid : (($this->input->post('id'))?$this->input->post('id'):0);
        $table = $this->input->post('table');
        $where = $this->input->post('where');
        if ($id > 0):
            $data_remove = $this->Remove_records->remove_data($id, $where, $table);   
            if($pid > 0):
                return ($data_remove)?TRUE:FALSE;
            else:
                $response = ($data_remove)?array('status' => 'ok', 'message' => 'Details removed successfully.!'):array('status' => 'ok', 'message' => 'Details not removed successfully.!');
                $this->response($response);
            endif;
        endif;
    }
    


    function subcategory($pid = 0, $where = 'SubcategoryID') {
        $id = ($pid > 0) ? $pid : (($this->input->post('id'))?$this->input->post('id'):0);
        if ($id > 0):
            $getSubegoryImages = $this->Common->get_info($id, TBL_SUBCATEGORY,'SubcategoryID');
            $path = UPLOAD_DIR.CATEGORY.$getSubegoryImages->Image;
            @unlink($path);
            $data_remove = $this->Remove_records->remove_data($id, $where, TBL_SUBCATEGORY);   
            if($pid > 0):
                return ($data_remove)?TRUE:FALSE;
            else:
                $response = ($data_remove)?array('status' => 'ok', 'message' => 'Details removed successfully.!'):array('status' => 'ok', 'message' => 'Details not removed successfully.!');
                $this->response($response);
            endif; 
        endif;
    }

    function banner($pid = 0, $where = 'BannerID') {
        $id = ($pid > 0) ? $pid : (($this->input->post('id'))?$this->input->post('id'):0);
        if ($id > 0):
            $getBannerImages = $this->Common->get_info($id, TBL_BANNER,'BannerID');
            $path = UPLOAD_DIR.BANNER_DIR.$getBannerImages->BannerURL;
            @unlink($path);
            $data_remove = $this->Remove_records->remove_data($id, $where, TBL_BANNER);   
            if($pid > 0):
                return ($data_remove)?TRUE:FALSE;
            else:
                $response = ($data_remove)?array('status' => 'ok', 'message' => 'Details removed successfully.!'):array('status' => 'ok', 'message' => 'Details not removed successfully.!');
                $this->response($response);
            endif; 
        endif;
    }

    function user($pid = 0, $where = 'id') {
        $id = ($pid > 0) ? $pid : (($this->input->post('id'))?$this->input->post('id'):0);
        if ($id > 0):
            $data_remove = $this->Remove_records->remove_data($id, $where, TBL_USERS);   
            if($pid > 0):
                return ($data_remove)?TRUE:FALSE;
            else:
                $response = ($data_remove)?array('status' => 'ok', 'message' => 'Details removed successfully.!'):array('status' => 'ok', 'message' => 'Details not removed successfully.!');
                $this->response($response);
            endif;
        endif;
    }

    function promocode($pid = 0, $where = 'CouponID') {
        $id = ($pid > 0) ? $pid : (($this->input->post('id'))?$this->input->post('id'):0);
        if ($id > 0):
            $getCoponImages = $this->Common->get_info($id, TBL_COUPON,'CouponID');
            $MobileImage = UPLOAD_DIR.COUPON.$getCoponImages->MobileImage;
            $WebsiteImage = UPLOAD_DIR.COUPON.$getCoponImages->WebsiteImage;
            @unlink($MobileImage);
            @unlink($WebsiteImage);
            $data_remove = $this->Remove_records->remove_data($id, $where, TBL_COUPON);   
            if($pid > 0):
                return ($data_remove)?TRUE:FALSE;
            else:
                $response = ($data_remove)?array('status' => 'ok', 'message' => 'Details removed successfully.!'):array('status' => 'ok', 'message' => 'Details not removed successfully.!');
                $this->response($response);
            endif;
        endif;
    }

    function product($pid = 0, $where = 'ProductID') {
        $id = ($pid > 0) ? $pid : (($this->input->post('id'))?$this->input->post('id'):0);
        if ($id > 0):
            $getImage = $this->Common->get_info($id, TBL_PRODUCT,'ProductID');
            $Image = UPLOAD_DIR.PRODUCT.$getImage->Image;
            @unlink($Image);
            $data_remove = $this->Remove_records->remove_data($id, $where, TBL_PRODUCT); 
            $this->Remove_records->remove_data($id, $where, TBL_VARIATION);  
            if($pid > 0):
                return ($data_remove)?TRUE:FALSE;
            else:
                $response = ($data_remove)?array('status' => 'ok', 'message' => 'Details removed successfully.!'):array('status' => 'ok', 'message' => 'Details not removed successfully.!');
                $this->response($response);
            endif;
        endif;
    }

    function response($response) {
        echo json_encode($response);
        die;
    }

}