<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quotation extends CI_Controller {

    public $table_name = TBL_QUOTATION;
    public $controllers = 'quotation';
    public $view_name = 'quotation';
    public $title = 'Quotation';
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
					<li class="breadcrumb-item text-grey-900">Quotation</li>
					<!--end::Item-->'; 
        $data['main_content'] = $this->view_name . '/list';
        $this->load->view('main_content', $data);
    }

    function add() {
        $user_id = $this->tank_auth->get_user_id();
        //$where = ($this->session->userdata('role') != 'SuperAdmin') ? 'and user_id = "'.$user_id.'"' : '';
        $role = $this->session->userdata('role_id');
        $data['role'] = $role;
        if($role == 1 or $role == 2 or $role == 5) {
            $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"(role='3' or role='4') and activated = 1"); 
        } else if($role == 3){
            $data['clients'] = $this->Common->get_list(TBL_CLIENTS,'id','client_name',"status = 'ACTIVE' and (franchisee_id = '".$user_id."' or franchisee_id in (select GROUP_CONCAT(DISTINCT id) FROM ".TBL_USERS." where parent_id = '".$user_id."') "); 
        } else if($role == 4){
            $data['clients'] = $this->Common->get_list(TBL_CLIENTS,'id','client_name',"status = 'ACTIVE' and franchisee_id = '".$user_id."'"); 
        }
        $data['projects'] = $this->Common->get_list(TBL_PROJECTS,'id','project_name',"status = 'ACTIVE'");
        $data['vendors'] = $this->Common->get_list(TBL_VENDORS,'id','vendor_name',"status = 'ACTIVE'");
        $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id','product_name','status = "ACTIVE"');
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        $quote = $this->Common->get_info(1, $this->table_name, '','reference_no like "%'.date('Y').'%"','*','','',array('field'=>'id','order'=>'desc'),1);
        if($quote) {
            $old_ref_data = explode('/',$quote->reference_no);
            $number = str_pad($old_ref_data[2] + 1, 5, '0', STR_PAD_LEFT);
            $data['ref_no'] = $data['settings']->quote_ref_no.$number;
            $data['ref_no'] = $data['settings']->quote_ref_no.$number.'/'.date('Y');
        } else {
            $data['ref_no'] = $data['settings']->quote_ref_no.'000001/'.date('Y');
            $data['ref_no'] = $data['settings']->quote_ref_no.'000001';
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
                $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"role='Franchisee' and activated = 1");
                $data['clients'] = $this->Common->get_list(TBL_CLIENTS,'id','client_name',"status = 'ACTIVE'");
                $data['projects'] = $this->Common->get_list(TBL_PROJECTS,'id','project_name',"status = 'ACTIVE'");
                $data['vendors'] = $this->Common->get_list(TBL_VENDORS,'id','vendor_name',"status = 'ACTIVE'");
                $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id','product_name','status = "ACTIVE"');
                $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
                $join = array(
                    array("table" => TBL_PROJECTS . " p","on" => "p.id=qp.project_id",
                        "type" => "LEFT"),
                );
                $data['quote_prod'] = $this->Common->get_all_info('',TBL_QUOTATION_PROJECT.' qp','','quote_id = "'.$id.'"',"qp.*,p.project_name","",$join);

                $data["data_info"] = $data_obj;
                $data_found = 1;
            }
        }
        // echo "<pre>"; print_r($data['quote_prod']); echo "</pre>"; die;
        if ($data_found == 0) {
            redirect('quotation');
        }

        $data['page_title'] = "Edit " . $this->title;
        $data['main_content'] = $this->view_name . '/add';
        $this->load->view('main_content', $data);
    }

    function add_row() {
        $data['unit'] = $this->Common->get_list(TBL_PACKET_UNIT,'PackageUnitTypeID','PackageUnitType');
      //  $this->load->view($this->view_name . '/add_sub_row');
        $this->load->view('product/add_sub_row',$data);
    }

    function submit_form() {
        if ($this->input->post()) {
            $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
            $error_element = error_elements();
            $this->form_validation->set_rules('reference_no', 'Reference No', 'required');
            $this->form_validation->set_rules('qauote_date', 'Date', 'required');
            $this->form_validation->set_rules('client_id', 'Client', 'required');
            /*if (empty($_FILES['Image']['name']) && $this->input->post('old_Image') == '') {
                $this->form_validation->set_rules('Image', 'Product Image', 'required');
            }*/
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "reference_no" => $this->input->post('reference_no'),
                    "franchisee_id" => $this->input->post('franchisee_id'),
                    "client_id" => $this->input->post('client_id'),
                    "product_ids" => ($this->input->post('product_ids')) ? implode(',',$this->input->post('product_ids')) : '',
                    //"cust_ref_no" => $this->input->post('com_reference_no'),
                    "qauote_date" => date('Y-m-d',strtotime($this->input->post('qauote_date'))),
                    "work_scope" => $this->input->post('work_scope'),
                    "specification" => $this->input->post('specification'),
                    "quote_notes" => $this->input->post('quote_note'),
                    "quote_terms" => $this->input->post('quote_terms'),
                    "total_amount" => $this->input->post('amount')[0],
                    "vendor_id" => $this->input->post('vendor_id'),
                    "project_id" => $this->input->post('project_id')[0],
                );
                if ($this->Common->check_is_exists($this->table_name, $post_data['reference_no'], "reference_no", $id, $field = $this->PrimaryKey)):
                    $response['heading'] = $this->title.' Name details already exists';
                    $response['message'] = $this->title.' Name details already exists, Use another one..!';
                    echo json_encode($response);
                    die;
                endif;
                if ($id > 0):
                    $post_data['modified_on'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $this->load->model('Remove_records');
                        $del_pro_data = $this->Remove_records->remove_data($id,'quote_id',TBL_QUOTATION_PROJECT);
                        for($i=0;$i<count($this->input->post('project_id')) ; $i++){
                            $prod_data = array(
                                "quote_id" => $id,
                                "project_id" => $this->input->post('project_id')[$i],
                                "size_range_id" => $this->input->post('project_prices')[$i],
                                "qty" => $this->input->post('qty')[$i],
                                //"unit" => $this->input->post('unit')[$i],
                                "basic_rate" => $this->input->post('rate')[$i],
                                //"net_rate" => $this->input->post('net_rate')[$i],
                                //"gst" => $this->input->post('gst')[$i],
                                "amount" => $this->input->post('amount')[$i]
                            );
                            $this->Common->add_info(TBL_QUOTATION_PROJECT, $prod_data);
                        }
                        
                        $response = array("status" => "ok", "heading" => "Quotation Updated successfully...", "message" => "Quotation updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Quotation Not Updated...", "message" => "Quotation not updated successfully.");
                    endif;
                else:
                    $post_data['modified_on'] = date("Y-m-d H:i:s");
                    $post_data['created_on'] = date("Y-m-d H:i:s");
                    $post_data['user_id'] = $this->tank_auth->get_user_id();

                    if ($id = $this->Common->add_info($this->table_name, $post_data)):
                        for($i=0;$i<count($this->input->post('project_id')) ; $i++){
                            $prod_data = array(
                                "quote_id" => $id,
                                "project_id" => $this->input->post('project_id')[$i],
                                "size_range_id" => $this->input->post('project_prices')[$i],
                                "qty" => $this->input->post('qty')[$i],
                                "basic_rate" => $this->input->post('rate')[$i],
                                "amount" => $this->input->post('amount')[$i]
                            );
                            $this->Common->add_info(TBL_QUOTATION_PROJECT, $prod_data);
                        }
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Quotation added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Quotation not added successfully.");
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
                $message = "Quotation Activated";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Quotation Deactivated";
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
        $this->datatables->select('q.'.$this->PrimaryKey . ', DATE_FORMAT(qauote_date, "%d-%m-%Y") as quote_date, reference_no,fullname,client_name,project_name');
        $this->datatables->from($this->table_name. ' q')
                ->join(TBL_USERS . ' u', 'u.id = q.franchisee_id', 'LEFT')
                ->join(TBL_CLIENTS . ' c', 'c.id = q.client_id', 'LEFT')
                ->join(TBL_PROJECTS . ' p', 'p.id = q.project_id', 'LEFT')
               ->add_column('is_active', '$1', 'active_row($1,' . $this->table_name.', q.' . $this->PrimaryKey.',quotation)')
                ->add_column('action', $this->action_row('$1'), 'q.'.$this->PrimaryKey);
        //$this->datatables->edit_column('Image', $this->show_image('$1'), 'Image');
        if(($this->input->post('dates')) && $this->input->post('dates') != '') {
            $dates = explode(" - ",$this->input->post('dates'));
            if(isset($dates[1])) {
                $this->datatables->where("qauote_date >= '".date('Y-m-d',strtotime(trim($dates[0])))."' and qauote_date <= '".date('Y-m-d',strtotime(trim($dates[1])))."'");
            } else {
                $this->datatables->where("qauote_date = '".date('Y-m-d',strtotime(trim($dates[0])))."'");
            }
        }        
        if(($this->session->userdata('role') != 'SuperAdmin')){
            $this->datatables->where('q.user_id',$this->tank_auth->get_user_id());
        }
        $this->datatables->order_by('q.'.$this->PrimaryKey,'desc');
        $this->datatables->unset_column('q.'.$this->PrimaryKey);
        echo $this->datatables->generate();
    }


    function action_row($id) {
        $action = <<<EOF
			<a class="btn btn-icon btn-secondary payment-btn w-30px h-30px me-3 " href="javascript:;" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
				<i class="fas fa-rupee-sign"></i>
			</a>
            
			<a class="btn btn-icon btn-secondary w-30px h-30px me-3 " href="invoice/create/{$id}" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
				<i class="fas fa-file-lines"></i>
			</a>

			<a class="btn btn-icon btn-success w-30px h-30px me-3 " href="quotation/view/{$id}" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
				<i class="fa fa-eye"></i>
			</a>
			<a class="btn btn-icon btn-primary w-30px h-30px me-3 " href="quotation/edit/{$id}" data-id="{$id}" data-original-title="Edit {$this->title}" data-control={$this->controllers}>
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
                // vendor data prepration with state name
                $fields = 'v.*,'.TBL_STATES.'.name as state_name';
                $vendorJoin = array(
                    'table' => TBL_STATES,
                    'on'    => 'v.state_id = '.TBL_STATES.'.id',
                    'type'  => 'left'
                );

                $data['vendor'] = $this->Common->get_info(
                    $data_obj->vendor_id,
                    TBL_VENDORS.' v',          // alias added
                    'v.id',                    // <— fully qualified
                    '',
                    $fields,
                    $vendorJoin
                );
                $join = array(
                    array("table" => TBL_PROJECT_PRICE . " sp","on" => "pr.size_range_id=sp.price_id","type" => "LEFT"),
                    array("table" => TBL_PROJECTS . " p","on" => "pr.project_id = p.id","type" => "LEFT"),
                );
                $data['project'] = $this->Common->get_info($id, TBL_QUOTATION_PROJECT.' pr', 'quote_id',false,'pr.*,p.project_name,p.project_image,p.project_type',$join);

               

                $join = array(array("table" => TBL_PRODUCT . " p", "on" => "qp.product_id=p.id", "type" => "left"),); 
                $data['quote_prod'] = $this->Common->get_all_info('',TBL_QUOTATION_PRODUCT.' qp','','quote_id = "'.$id.'"','qp.*,p.product_name,p.making,p.description',false, $join);

                $project_id = $data['project']->quote_project_id ?? 0;

                if(strpos(strtolower($data['project']->project_name),strtolower('ONGRID')) !== false) {
                    $data['products'] = $this->Common->get_all_info('',TBL_PROJECT_PRODUCT.' p','','project_id = 2','p.*',false);
                }  else if(strpos(strtolower($data['project']->project_name),strtolower('Offgrid')) !== false) {
                    $data['products'] = $this->Common->get_all_info('',TBL_PROJECT_PRODUCT.' p','','project_id = 5','p.*',false);
                } else {
                    $data['products'] = $this->Common->get_all_info('',TBL_PROJECT_PRODUCT.' p','','project_id = 6','p.*',false);
                }

                $data["data_info"] = $data_obj;
                $data_found = 1;
            }
        }
        // echo "<pre>";

        // print_r($data);
        // echo "</pre>";
        // exit;
        if ($data_found == 0) {
            redirect('/');
        }

        $data['page_title'] = "View " . $this->title;
        $data['main_content'] = $this->view_name . '/view';

        
        $this->load->view('main_content', $data);
    }
    
    function getQuotationData() {
        $response = array("status" => "error",'message' => 'Error in fetch data');
        $id = $this->input->post('id');
        $user_id = $this->tank_auth->get_user_id();
        $where = ($this->session->userdata('role') != 'SuperAdmin') ? 'q.user_id = "'.$user_id.'"' : '';
        $join = array(
                    array("table" => TBL_CLIENTS . " cl","on" => "cl.id=q.client_id",
                        "type" => "LEFT"),
                );
        $quote_data = $this->Common->get_info($id, $this->table_name.' q', 'q.'.$this->PrimaryKey,$where,'q.*',$join);
        if($quote_data) {
            if($quote_data->pending_amount > 0) {
                $response = array("status" => "ok",'quote_data' => $quote_data); 
            } else {
                $response = array("status" => "error",'message' => 'already paid'); 
            }
        } 
        echo json_encode($response);
        die;
        
    }

    function get_quotation() {
        $client_id = $this->input->post('id');
        $GetCat = $this->Common->get_list($this->table_name, "id", "reference_no", "client_id = '$client_id' and pending_amount != 0");
        if (!empty($GetCat)) {
            $response = array("status" => "ok", "data" => $GetCat);
        } else {
            $response = array("status" => "error");
        }
        echo json_encode($response);
        die;
    }

}
