<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payments extends CI_Controller {

    public $table_name = TBL_PAYMENTS;
    public $controllers = 'payments';
    public $view_name = 'payments';
    public $title = 'Payments';
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
					<li class="breadcrumb-item text-grey-900">Payments</li>
					<!--end::Item-->'; 
        $data['main_content'] = $this->view_name . '/list';
        $this->load->view('main_content', $data);
    }

    function cashfree() {
        $data['page_title'] = "Manage " . $this->title;
        $data['breadcrumb'] = '<!--begin::Item-->
					<li class="breadcrumb-item text-grey-900">Cashfree Payments</li>
					<!--end::Item-->'; 
        $data['main_content'] = $this->view_name . '/cashfree-payments';
        $this->load->view('main_content', $data);
    }

    
    function add() {
        $user_id = $this->tank_auth->get_user_id();
        $where = ($this->session->userdata('role') != 'SuperAdmin') ? 'and user_id = "'.$user_id.'"' : '';
        $data['franchisees'] = $this->Common->get_list(TBL_USERS,'id','fullname',"(role='3' or role='4') and activated = 1");
        $data['quotations'] = $this->Common->get_list(TBL_QUOTATION,'id','reference_no',"status = 'ACTIVE' and pending_amount != 0");
        $data['projects'] = $this->Common->get_list(TBL_PROJECTS,'id','project_name',"status = 'ACTIVE'");
        $data['products'] = $this->Common->get_list(TBL_PRODUCT,'id','product_name','status = "ACTIVE"');
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        //$data['subcategory'] = array();
        $data['page_title'] = "Add New " . $this->title;
        $this->load->view($this->view_name . '/form', $data);
    }

    function submitOrder() {
        $id = $this->input->post('pf_order_id');
        $user_id = $this->tank_auth->get_user_id();
        $cf_order_id = "order_" . time();
        $post_data['cf_order_id'] = $cf_order_id;
        $post_data['modified_on'] = date("Y-m-d H:i:s");
        $this->Common->update_info($id, TBL_QUOTATION, $post_data, $this->PrimaryKey);

        $where = ($this->session->userdata('role') != 'SuperAdmin') ? 'q.user_id = "'.$user_id.'"' : '';
        $join = array(
                    array("table" => TBL_CLIENTS . " cl","on" => "cl.id=q.client_id",
                        "type" => "LEFT"),
                );
        $quote_data = $this->Common->get_info($id, TBL_QUOTATION.' q', 'q.'.$this->PrimaryKey,$where,'q.*,cl.*',$join);
        if ($quote_data) {
            $orderData = [
                "order_id" => $cf_order_id,
                "order_amount" => $this->input->post('pf_amount'),
                "order_currency" => "INR",
                "order_note" => $quote_data->quote_notes,
                "customer_details" => array(
                    'customer_id' => 'CUST_' . uniqid(),
                    'customer_name' => $quote_data->client_name,
                    'customer_email' => $quote_data->client_email,
                    'customer_phone' => $quote_data->phone
                ),
                'order_meta'=> array(
                    'return_url' => CF_RETURN_URL,
                    'notify_url' => BASE_URL.'/admin',
                    'payment_methods' =>'' 
                )
            ];
            
            $orderResponse = createOrder($orderData);
            
            if (isset($orderResponse['payments'])) {
                // Redirect to Cashfree payment page
                $response = array("status" => "ok", "session_id" => $orderResponse['payment_session_id']);
            } else {
                $response = array("status" => "erorr", "message" => "Error creating order: " . print_r($orderResponse, true));
            }
        } else {
            $response = array("status" => "erorr", "message" => "Invalid quotation data");
        }
        echo json_encode($response);
        die;
    }
    function cfReturn() {
        $data['page_title'] = "Manage " . $this->title;
        $data['breadcrumb'] = '<!--begin::Item-->
					<li class="breadcrumb-item text-grey-900">Quotation</li>
					<!--end::Item-->'; 
        $orderId = $this->input->get('order_id');
        $paymentResponse = verifyPayment($orderId);
        $quotation_data = $this->Common->get_info($orderId, TBL_QUOTATION.' q', 'q.cf_order_id','','q.*');
        if($paymentResponse) {
            $post_data = array(
                "qauote_id" => $quotation_data->id,
                "user_id" => $this->tank_auth->get_user_id(),
                "cf_order_id" => $orderId,
                "transaction_id" =>  $paymentResponse[0]['cf_payment_id'],
                "quote_amount" =>  $paymentResponse[0]['order_amount'],
                "status" => $paymentResponse[0]['payment_status'],
                //"cust_ref_no" => $this->input->post('com_reference_no'),
                "payment_date" =>  $paymentResponse[0]['payment_status'],
                "payment_amount" =>  $paymentResponse[0]['payment_amount'],
                "bank_reference" =>  $paymentResponse[0]['bank_reference'],
            );
            $id = $this->Common->add_info(TBL_CF_TRANSACTION, $post_data);
            $data['paymentResponse'] = $paymentResponse;
            if (isset($paymentResponse[0]['payment_status']) && $paymentResponse[0]['payment_status'] === 'SUCCESS') {
                
                $pending_amount = $quotation_data->pending_amount - $paymentResponse[0]['order_amount'];
                $qoute_data['pending_amount'] = $pending_amount;
                $qoute_data['payment_status'] = ($pending_amount == 0) ? 'paid' : 'unpaid';
                $qoute_data['modified_on'] = date("Y-m-d H:i:s");
                $this->Common->update_info($orderId, TBL_QUOTATION, $qoute_data, 'cf_order_id');

                $post_data = array(
                    "franchisee_id" => $quotation_data->franchisee_id,
                    "client_id" => $quotation_data->client_id,
                    "quotation_id" => $quotation_data->id,
                    "pending_quote_amount" => $quotation_data->pending_amount,
                    "paid_amount" => $paymentResponse[0]['order_amount'],
                    "remaining_amount" => $pending_amount,
                    "payment_date" => date('Y-m-d'),
                    "payment_mode" => 'online',
                    "transaction_id" => $paymentResponse[0]['cf_payment_id'],
                    "remarks" => 'cashfree payments',
                );
                
                $post_data['updated_at'] = date("Y-m-d H:i:s");
                $post_data['created_at'] = date("Y-m-d H:i:s");
                $post_data['user_id'] = $this->tank_auth->get_user_id();

                $id = $this->Common->add_info($this->table_name, $post_data);

                //echo "Payment Successful for Order ID: " . $orderId;
                $data['main_content'] = $this->view_name . '/list';
                $this->load->view('main_content', $data);
                // Update your database, send confirmation email, etc.
            } else {
                $data['main_content'] = $this->view_name . '/list';
                $this->load->view('main_content', $data);
                //echo "Payment Failed or Pending for Order ID: " . $orderId;
            }
        } else {
            $data['main_content'] = $this->view_name . '/list';
            $this->load->view('main_content', $data);
        }
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
            $this->form_validation->set_rules('franchisee_id', 'Franchisee', 'required');
            $this->form_validation->set_rules('client_id', 'Client', 'required');
            $this->form_validation->set_rules('quotation_id', 'Quotation', 'required');
            $this->form_validation->set_rules('client_id', 'Client', 'required');
            /*if (empty($_FILES['Image']['name']) && $this->input->post('old_Image') == '') {
                $this->form_validation->set_rules('Image', 'Product Image', 'required');
            }*/
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $pending_amount = $this->input->post('pending_amount') - $this->input->post('paid_amount');
                $post_data = array(
                    "franchisee_id" => $this->input->post('franchisee_id'),
                    "client_id" => $this->input->post('client_id'),
                    "quotation_id" => $this->input->post('quotation_id'),
                    "pending_quote_amount" => $this->input->post('pending_amount'),
                    "paid_amount" => $this->input->post('paid_amount'),
                    "remaining_amount" => $pending_amount,
                    "payment_date" => date('Y-m-d',strtotime($this->input->post('payment_date'))),
                    "payment_mode" => $this->input->post('payment_mode'),
                    "transaction_id" => $this->input->post('transaction_no'),
                    "remarks" => $this->input->post('description'),
                );
                if ($id > 0):
                    $post_data['updated_at'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Payment Updated successfully...", "message" => "Payment updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Payment Not Updated...", "message" => "Payment not updated successfully.");
                    endif;
                else:
                    $post_data['updated_at'] = date("Y-m-d H:i:s");
                    $post_data['created_at'] = date("Y-m-d H:i:s");
                    $post_data['user_id'] = $this->tank_auth->get_user_id();

                    if ($id = $this->Common->add_info($this->table_name, $post_data)):
                        $qoute_data['pending_amount'] = $pending_amount;
                        $qoute_data['payment_status'] = ($pending_amount == 0) ? 'paid' : 'unpaid';
                        $qoute_data['modified_on'] = date("Y-m-d H:i:s");
                        $this->Common->update_info($this->input->post('quotation_id'), TBL_QUOTATION, $qoute_data, $this->PrimaryKey);

                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Payment added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Payment not added successfully.");
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
                $message = "Payment Activated";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Payment Deactivated";
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
        $this->datatables->select('p.'.$this->PrimaryKey . ', fullname,client_name,reference_no,payment_mode,paid_amount');
        $this->datatables->from($this->table_name. ' p')
                ->join(TBL_USERS . ' u', 'u.id = p.franchisee_id', 'LEFT')
                ->join(TBL_CLIENTS . ' c', 'c.id = p.client_id', 'LEFT')
                ->join(TBL_QUOTATION . ' q', 'q.id = p.quotation_id', 'LEFT')
                ->join(TBL_PROJECTS . ' pr', 'pr.id = q.project_id', 'LEFT')
                ->add_column('action', $this->action_row('$1'), 'p.'.$this->PrimaryKey);
        //$this->datatables->edit_column('Image', $this->show_image('$1'), 'Image');
        if(($this->session->userdata('role') != 1)){
            $this->datatables->where('p.user_id',$this->tank_auth->get_user_id());
        }
        $this->datatables->unset_column('p.'.$this->PrimaryKey);
        $this->datatables->order_by('p.'.$this->PrimaryKey,'desc');
        echo $this->datatables->generate();
    }

    function manage_cashfree_payments() {
        $this->datatables->select('reference_no,cf.cf_order_id,transaction_id,quote_amount,payment_amount,bank_reference,cf.status');
        $this->datatables->from(TBL_CF_TRANSACTION. ' cf')
                ->join(TBL_QUOTATION . ' q', 'q.id = cf.qauote_id', 'LEFT');
        if(($this->session->userdata('role') != 1)){
            $this->datatables->where('cf.user_id',$this->tank_auth->get_user_id());
        }
        $this->datatables->order_by('cf.'.$this->PrimaryKey,'desc');
        $this->db->last_query();
        echo $this->datatables->generate();
    }


    function action_row($id) {
        $action = <<<EOF
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
