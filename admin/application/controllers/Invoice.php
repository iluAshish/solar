<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends CI_Controller {

    public $table_name = TBL_INVOICE;
    public $controllers = 'invoice';
    public $view_name = 'invoice';
    public $title = 'Invoice';
    public $PrimaryKey = 'id';

    function __construct() {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login/');
        }
        $this->load->Model('Remove_records');
    }

    function index() {
        $data['page_title'] = "Manage " . $this->title;
        $data['breadcrumb'] = '<!--begin::Item-->
					<li class="breadcrumb-item text-grey-900">Invoices</li>
					<!--end::Item-->'; 
        $data['main_content'] = $this->view_name . '/list';
        $this->load->view('main_content', $data);
    }

    function create($id) {
        $data_found = 0;
        $user_id = $this->tank_auth->get_user_id();
        $where = ($this->session->userdata('role') != 'SuperAdmin') ? 'user_id = "'.$user_id.'"' : '';

        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, TBL_QUOTATION, $this->PrimaryKey,$where);
            if (is_object($data_obj) && count((array) $data_obj) > 0) {
                $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"(role='3' or role='4') and activated = 1");
                $data['clients'] = $this->Common->get_list(TBL_CLIENTS,'id','client_name',"status = 'ACTIVE'");
                $data['projects'] = $this->Common->get_list(TBL_PROJECTS,'id','project_name',"status = 'ACTIVE'");
                $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id','product_name','status = "ACTIVE"');
                $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
                $join = array(
                    array("table" => TBL_PROJECTS . " p","on" => "p.id=qp.project_id",
                        "type" => "LEFT"),
                );
                $data['invoice_prod'] = $this->Common->get_all_info('',TBL_QUOTATION_PROJECT.' qp','','quote_id = "'.$id.'"',"qp.*,p.project_name","",$join);
                unset($data_obj->id);
                $data["data_info"] = $data_obj;
                $data_found = 1;
            }
        }
        if ($data_found == 0) {
            redirect('quotation');
        }

        $invoice = $this->Common->get_info(1, $this->table_name, '','','*','','',array('field'=>'invoice_no','order'=>'desc'),1);
        if($invoice) {
            $old_ref_data = explode('/',$invoice->invoice_no);
            $number = str_pad($old_ref_data[2] + 1, 4, '0', STR_PAD_LEFT);
            $data['invoice_no'] = $data['settings']->quote_ref_no.$number.'/'.date('Y');
        } else {
            $data['invoice_no'] = $data['settings']->quote_ref_no.'0001/'.date('Y');
        }
        $data['page_title'] = "Create " . $this->title;
        $data['main_content'] = $this->view_name . '/add';
        $this->load->view('main_content', $data);
    }


    function add() {
        $user_id = $this->tank_auth->get_user_id();
        $where = ($this->session->userdata('role') != 'SuperAdmin') ? 'and user_id = "'.$user_id.'"' : '';
        $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"role='Franchisee' and activated = 1");
        $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id','product_name','status = "ACTIVE"');
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        $invoice = $this->Common->get_info(1, $this->table_name, '','','*','','',array('field'=>'invoice_no','order'=>'desc'),1);
        if($invoice) {
            $old_ref_data = explode('/',$invoice->invoice_no);
            $number = str_pad($old_ref_data[2] + 1, 4, '0', STR_PAD_LEFT);
            $data['invoice_no'] = $data['settings']->quote_ref_no.$number.'/'.date('Y');
        } else {
            $data['invoice_no'] = $data['settings']->quote_ref_no.'0001/'.date('Y');
        }
        //$data['subcategory'] = array();
        $data['page_title'] = "Add New " . $this->title;
        $data['main_content'] = $this->view_name . '/add';
        $this->load->view('main_content', $data);
    }

    function edit($id) {
        $data_found = 0;
        $user_id = $this->tank_auth->get_user_id();
        $where = ($this->session->userdata('role') != 'SuperAdmin') ? 'user_id = "'.$user_id.'"' : '';

        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey,$where);
            if (is_object($data_obj) && count((array) $data_obj) > 0) {
                $where = ($this->session->userdata('role') != 'SuperAdmin') ? 'and user_id = "'.$user_id.'"' : '';
                $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"(role='3' or role='4') and activated = 1");
                $data['clients'] = $this->Common->get_list(TBL_CLIENTS,'id','client_name',"status = 'ACTIVE'");
                $data['projects'] = $this->Common->get_list(TBL_PROJECTS,'id','project_name',"status = 'ACTIVE'");
                $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id','product_name','status = "ACTIVE"');
                $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
                $join = array(
                    array("table" => TBL_PROJECTS . " p","on" => "p.id=qp.project_id",
                        "type" => "LEFT"),
                );
                $data['invoice_prod'] = $this->Common->get_all_info('',TBL_QUOTATION_PROJECT.' qp','','quote_id = "'.$id.'"',"qp.*,p.project_name","",$join);

                $data["data_info"] = $data_obj;
                $data_found = 1;
            }
        }
        if ($data_found == 0) {
            redirect('/');
        }

        $data['page_title'] = "Edit " . $this->title;
        $data['main_content'] = $this->view_name . '/add';
        $this->load->view('main_content', $data);
    }


    function submit_form() {
        if ($this->input->post()) {
            $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
            $error_element = error_elements();
            $this->form_validation->set_rules('invoice_no', 'Invoice No', 'required');
            $this->form_validation->set_rules('invoice_date', 'Date', 'required');
            $this->form_validation->set_rules('client_id', 'Company', 'required');
            //$this->form_validation->set_rules('dc_no', 'DC No', 'required');
            //$this->form_validation->set_rules('po_no', 'PO No', 'required');
            /*if (empty($_FILES['Image']['name']) && $this->input->post('old_Image') == '') {
                $this->form_validation->set_rules('Image', 'Product Image', 'required');
            }*/
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "invoice_no" => $this->input->post('invoice_no'),
                    "franchisee_id" => $this->input->post('franchisee_id'),
                    "client_id" => $this->input->post('client_id'),
                    "product_ids" => implode(',',$this->input->post('product_ids')),
                    "invoice_date" => date('Y-m-d',strtotime($this->input->post('invoice_date'))),
                    //"dispatch_by" => $this->input->post('dispatch_by'),
                    "invoice_details" => $this->input->post('invoice_details'),
                    "invoice_terms" => $this->input->post('invoice_terms'),
                    "specification" => $this->input->post('specification'),
                    "work_scope" => $this->input->post('work_scope'),
                );
                
                if ($this->Common->check_is_exists($this->table_name, $post_data['invoice_no'], "invoice_no", $id, $field = $this->PrimaryKey)):
                    $response['heading'] = $this->title.' Name details already exists';
                    $response['message'] = $this->title.' Name details already exists, Use another one..!';
                    echo json_encode($response);
                    die;
                endif;
                if ($id > 0):
                    $post_data['updated_at'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $this->load->model('Remove_records');
                        $del_pro_data = $this->Remove_records->remove_data($id,'invoice_id',TBL_INVOICE_PRODUCT);
                        for($i=0;$i<count($this->input->post('project_id')) ; $i++){
                            $prod_data = array(
                                "invoice_id" => $id,
                                "project_id" => $this->input->post('project_id')[$i],
                                "size_range_id" => $this->input->post('project_prices')[$i],
                                //"qty" => $this->input->post('qty')[$i],
                                //"unit" => $this->input->post('unit')[$i],
                                "basic_rate" => $this->input->post('rate')[$i],
                                //"net_rate" => $this->input->post('net_rate')[$i],
                                //"gst" => $this->input->post('gst')[$i],
                                "amount" => $this->input->post('amount')[$i]
                            );
                            $this->Common->add_info(TBL_INVOICE_PRODUCT, $prod_data);
                        }
                        
                        $response = array("status" => "ok", "heading" => "Invoice Updated successfully...", "message" => "Invoice updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Invoice Not Updated...", "message" => "Invoice not updated successfully.");
                    endif;
                else:
                    //$post_data['user_id'] = $this->tank_auth->get_user_id();
                    $post_data['updated_at'] = date("Y-m-d H:i:s");
                    $post_data['created_at'] = date("Y-m-d H:i:s");
                    
                    if ($id = $this->Common->add_info($this->table_name, $post_data)):
                        for($i=0;$i<count($this->input->post('project_id')) ; $i++){
                            $prod_data = array(
                                "invoice_id" => $id,
                                "project_id" => $this->input->post('project_id')[$i],
                                "size_range_id" => $this->input->post('project_prices')[$i],
                                //"qty" => $this->input->post('qty')[$i],
                                //"unit" => $this->input->post('unit')[$i],
                                "basic_rate" => $this->input->post('rate')[$i],
                                //"net_rate" => $this->input->post('net_rate')[$i],
                                //"gst" => $this->input->post('gst')[$i],
                                "amount" => $this->input->post('amount')[$i]
                            );
                            $this->Common->add_info(TBL_INVOICE_PRODUCT, $prod_data);
                        }
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Invoice added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Invoice not added successfully.");
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
            $IsFeatured = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey, FALSE, 'isActive');
            if ($IsFeatured->isActive == 0) {
                $activated = 1;
                $status = "ok";
                $heading = "Success";
                $message = "Invoice Activated";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Invoice Deactivated";
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
    function isfeature($id) {
        if ($id > 0) {
            $IsFeatured = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey, FALSE, 'isFeature');
            if ($IsFeatured->isFeature == 0) {
                $activated = 1;
                $status = "ok";
                $heading = "Success";
                $message = "Invoice Feature Activated";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Invoice Feature Deactivated";
            }
            $data = array(
                "isFeature" => $activated,
            );

            if ($this->Common->update_info($id, $this->table_name, $data, $this->PrimaryKey)) {
                $response = array("status" => $status, "heading" => $heading, "message" => $message);
                echo json_encode($response);
                die;
            }
        }
    }

    function manage() {
        $this->datatables->select('i.'.$this->PrimaryKey . ', DATE_FORMAT(invoice_date, "%d-%m-%Y") as invoice_date, invoice_no,fullname,client_name,project_name,total');
        $this->datatables->from($this->table_name. ' i')
                ->join(TBL_USERS . ' u', 'u.id = i.franchisee_id', 'LEFT')
                ->join(TBL_CLIENTS . ' c', 'c.id = i.client_id', 'LEFT')
                ->join(TBL_PROJECTS . ' p', 'p.id = i.project_id', 'LEFT')
               ->add_column('is_active', '$1', 'active_row($1,' . $this->table_name.',i.' . $this->PrimaryKey.',invoice)')
                ->add_column('action', $this->action_row('$1'), 'i.'.$this->PrimaryKey);
        //$this->datatables->edit_column('Image', $this->show_image('$1'), 'Image');
        if(($this->session->userdata('role') != 'SuperAdmin')){
            $this->datatables->where('i.user_id',$this->tank_auth->get_user_id());
        }
        $this->datatables->unset_column('i.'.$this->PrimaryKey);
        $this->datatables->order_by('i.'.$this->PrimaryKey);
        echo $this->datatables->generate();
    }


    function action_row($id) {
        $action = <<<EOF
			<a class="btn btn-icon btn-success w-30px h-30px me-3 " href="invoice/view/{$id}" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
				<i class="fa fa-eye"></i>
			</a>
        
			<a class="btn btn-icon btn-primary w-30px h-30px me-3 " href="invoice/edit/{$id}" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
				<i class="ki-duotone ki-setting-3 fs-3">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
					<span class="path5"></span>
				</i>
			</a>
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
    
    
    
    function view($id) {
        $data_found = 0;
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            if (is_object($data_obj) && count((array) $data_obj) > 0) {
                $data['franchisee'] = $this->Common->get_info($data_obj->franchisee_id, TBL_USERS, 'id');
                $data['client'] = $this->Common->get_info($data_obj->client_id, TBL_CLIENTS, 'id');
                $join = array(
                    array("table" => TBL_PROJECT_PRICE . " sp","on" => "pr.size_range_id=sp.price_id","type" => "LEFT"),
                    array("table" => TBL_PROJECTS . " p","on" => "pr.project_id = p.id","type" => "LEFT"),
                );
                $data['project'] = $this->Common->get_info($id, TBL_QUOTATION_PROJECT.' pr', 'quote_id',false,'pr.*,p.project_name,p.project_type',$join);
                $join = array(array("table" => TBL_PRODUCT . " p", "on" => "qp.product_id=p.id", "type" => "left"),); 
                $data['quote_prod'] = $this->Common->get_all_info('',TBL_QUOTATION_PRODUCT.' qp','','quote_id = "'.$id.'"','qp.*,p.product_name,p.making,p.description',false, $join);

                $data["data_info"] = $data_obj;
                $data_found = 1;
            }
        }
        if ($data_found == 0) {
            redirect('/');
        }

        $data['page_title'] = "View " . $this->title;
        $data['main_content'] = $this->view_name . '/view';
        $this->load->view('main_content', $data);
    }

}
