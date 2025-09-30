<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
        }
    }

    function index() {
        // Payment statistics Count END
        // Register statistics User
        $user_id = $this->tank_auth->get_user_id();
        $where = 'role = "Franchisee"';
        $data['franchisee'] = $this->Common->get_info(1, TBL_USERS, 1,$where,'COUNT(id) as franchisee')->franchisee;
        $where = "role = 'Franchisee' && is_aadhar_verified = 0";
        $data['unverified_franchisee'] = $this->Common->get_info(1, TBL_USERS, 1,$where,'COUNT(id) as franchisee')->franchisee;
        $data['clients'] = $this->Common->get_info(1, TBL_CLIENTS, 1,'','COUNT(id) as clients')->clients;
        $data['projects'] = $this->Common->get_info(1, TBL_PROJECTS, 1,'','COUNT(id) as projects')->projects;
        $data['com_projects'] = $this->Common->get_info(1, TBL_PROJECTS, 1,"project_status = 'Completed'",'COUNT(id) as projects')->projects;
        $data['products'] = $this->Common->get_info(1, TBL_PRODUCT, 1,'','COUNT(id) as products')->products;
        //$data['users'] = $this->Common->get_info(1, TBL_USERS, 1,'role != "SuperAdmin"','COUNT(id) as users')->users;
        // Register statistics END
        //$data["extra_js"] = array('assets/libs/apexcharts/apexcharts.min','assets/js/pages/dashboard-crm.init');
        $data['breadcrumb'] = '<!--begin::Item-->
					<li class="breadcrumb-item text-grey-900">Dashboard</li>
					<!--end::Item-->';
        $data['page_title'] = "Dashboard";
        $data['main_content'] = 'dashboard/dashboard';
        $data['role'] = $this->session->userdata('role');
        $this->load->view('main_content', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */