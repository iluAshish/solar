<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends CI_Controller {

    public $table_name = TBL_QUOTATION;
    public $controllers = 'report';
    public $view_name = 'report';
    public $title = 'Quotation';
    public $PrimaryKey = 'quotation_id';

    function __construct() {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login/');
        }
        $this->load->Model('Remove_records');
    }

    function Quotations() {
        $user_id = $this->tank_auth->get_user_id();
        $where = ($this->session->userdata('role') != 'SuperAdmin') ? 'and user_id = "'.$user_id.'"' : '';
        $data['page_title'] = "Manage " . $this->title;
        $data['companies'] = $this->Common->get_list(TBL_COMPANY,'company_id','company_name','is_active = 1 '.$where);
        $data['users'] = $this->Common->get_list(TBL_USERS,'id','staff_name','role <> "SuperAdmin" ');
        $data['main_content'] = $this->view_name . '/quotations';
        $this->load->view('main_content', $data);
    }

    function Invoices() {
        $user_id = $this->tank_auth->get_user_id();
        $where = ($this->session->userdata('role') != 'SuperAdmin') ? 'and user_id = "'.$user_id.'"' : '';
        $data['page_title'] = "Manage " . $this->title;
        $data['companies'] = $this->Common->get_list(TBL_COMPANY,'company_id','company_name','is_active = 1 '.$where);
        $data['main_content'] = $this->view_name . '/invoices';
        $this->load->view('main_content', $data);
    }


    function manage_quotations() {
        $this->datatables->select($this->PrimaryKey . ', DATE_FORMAT(qauote_date, "%d-%m-%Y") as quote_date, reference_no,company_name,cust_ref_no');
        $this->datatables->from($this->table_name. ' q')
                ->join(TBL_COMPANY . ' c', 'c.company_id = q.customer_id', 'LEFT');
               //->add_column('is_active', '$1', 'active_row($1,' . $this->table_name.',' . $this->PrimaryKey.',quotation)');
                //->add_column('action', $this->action_row('$1'), $this->PrimaryKey);
        //$this->datatables->edit_column('Image', $this->show_image('$1'), 'Image');
        if(($this->session->userdata('role') != 'SuperAdmin')){
            $this->datatables->where('q.user_id',$this->tank_auth->get_user_id());
        }
        if(($this->input->post('user_id'))){
            $this->datatables->where('q.user_id',$this->input->post('user_id'));
        }
        if(($this->input->post('company_id'))){
            $this->datatables->where('q.customer_id',$this->input->post('company_id'));
        }
        if(($this->input->post('from_date')) && !($this->input->post('to_date'))){
            $this->datatables->where('q.qauote_date',date('Y-m-d',strtotime($this->input->post('from_date'))));
        }        
        if(($this->input->post('to_date'))){
            $this->datatables->where('q.qauote_date between "'.date('Y-m-d',strtotime($this->input->post('from_date'))).'" and "'.date('Y-m-d',strtotime($this->input->post('to_date'))).'"' );
        }    
        $this->datatables->unset_column($this->PrimaryKey);
        $this->datatables->order_by($this->PrimaryKey,'desc');
        echo $this->datatables->generate();
        //echo $this->db->last_query();
    }
    
    function manage_invoices() {
        $this->datatables->select('invoice_id, DATE_FORMAT(invoice_date, "%d-%m-%Y") as invoice_date, invoice_no,company_name,total');
        $this->datatables->from(TBL_INVOICE. ' i')
                ->join(TBL_COMPANY . ' c', 'c.company_id = i.consinee_id', 'LEFT');
               //->add_column('is_active', '$1', 'active_row($1,' . $this->table_name.',' . $this->PrimaryKey.',invoice)')
                //->add_column('action', $this->action_row('$1'), $this->PrimaryKey);
        //$this->datatables->edit_column('Image', $this->show_image('$1'), 'Image');
        if(($this->session->userdata('role') != 'SuperAdmin')){
            $this->datatables->where('i.user_id',$this->tank_auth->get_user_id());
        }
        if(($this->input->post('user_id'))){
            $this->datatables->where('q.user_id',$this->input->post('user_id'));
        }
        if(($this->input->post('company_id'))){
            $this->datatables->where('q.customer_id',$this->input->post('company_id'));
        }
        if(($this->input->post('from_date')) && !($this->input->post('to_date'))){
            $this->datatables->where('i.invoice_date',date('Y-m-d',strtotime($this->input->post('from_date'))));
        }        
        if(($this->input->post('to_date'))){
            $this->datatables->where('i.invoice_date between "'.date('Y-m-d',strtotime($this->input->post('from_date'))).'" and "'.date('Y-m-d',strtotime($this->input->post('to_date'))).'"' );
        }    
        
        $this->datatables->unset_column('invoice_id');
        $this->datatables->order_by('invoice_id');
        echo $this->datatables->generate();
    }
    


    
}
