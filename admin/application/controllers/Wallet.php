<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wallet extends CI_Controller {

    public $table_name = TBL_WALLET_TRANSACTION;
    public $controllers = 'wallet';
    public $view_name = 'wallet';
    public $title = 'My Wallet';
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
					<li class="breadcrumb-item text-grey-900">Wallet</li>
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
        $data['settings'] = $this->Common->get_info(1, TBL_SETTINGS, 'setting_id');
        //$data['subcategory'] = array();
        $data['page_title'] = "Add New " . $this->title;
        $this->load->view($this->view_name . '/form', $data);
    }

    function withdraw() {
        
        $amount = $this->input->post('amount');
        $user_id = 3;
        $bank_data = $this->Common->get_info($user_id, TBL_BANK_DATA.' b', 'b.franchisee_id');
        if ($bank_data) {
            $data = ['transfer_id' => 'JUNOB2018',
                'transfer_amount' => 1,
                'transfer_mode' => 'imps',
                'beneficiary_details' => [
                    'beneficiary_details' => [
                            'beneficiary_instrument_details' => [
                                'bank_account_number' => $bank_data->account_number,
                                'bank_ifsc' => $bank_data->ifsc_code
                            ]
                    ]
                ]
            ];

            $response_data = withdrawMoney($data);
            if ($response_data) {
                if (isset($response_data['status']) && $response_data['status'] === 'RECEIVED') {
                    // Redirect to Cashfree payment page
                    $response = array("status" => "ok", "session_id" => "Amount transferred successfully!");
                } else {
                    $response = array("status" => "erorr", "message" => "Transfer failed. Error: " . $response_data['message']);
                }
            }
        } else {
            $response = array("status" => "erorr", "message" => "Invalid quotation data");
        }
        echo json_encode($response);
        die;
    }
    function submit_form() {
        if ($this->input->post()) {
            $response = array("status" => "error", "heading" => "Unknown Error", "message" => "There was an unknown error that occurred. You will need to refresh the page to continue working.");
            $error_element = error_elements();
            $this->form_validation->set_rules('amount', 'amount', 'required');
            $this->form_validation->set_rules('payment_mode', 'payment_mode', 'required');
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $user_id = $this->tank_auth->get_user_id();
                $user_id = 3;
                $amount = $this->input->post('amount');
                $payment_mode = $this->input->post('payment_mode');
                $wallet_data = $this->Common->get_info($user_id, $this->table_name.' w', 'w.user_id','','w.available_amount as available_amount','','',array('field'=>'id','order'=>'desc'),1);
                $available_amount = ($wallet_data) ? $wallet_data->available_amount + $amount : $amount;
                $post_data = array(
                    "user_id" => $user_id,
                    "amount" => $amount,
                    "available_amount" => $available_amount,
                    "transaction_type" => 'Credit',
                    "payment_mode" => $payment_mode,
                    "remarks" => $this->input->post('description'),
                    "updated_at" => date("Y-m-d H:i:s"),
                    "created_at" => date("Y-m-d H:i:s"),
                );

                if ($payment_mode == 'Online') {
                    $bank_data = $this->Common->get_info($user_id, TBL_BANK_DATA.' b', 'b.franchisee_id');
                    if ($bank_data) {
                        $data = ['transfer_id' => 'Scopnix'.uniqid().'-'.date('M').date('Y'),
                            'transfer_amount' => $amount,
                            'transfer_mode' => 'imps',
                            'beneficiary_details' => [
                                'beneficiary_details' => [
                                        'beneficiary_instrument_details' => [
                                            'bank_account_number' => $bank_data->account_number,
                                            'bank_ifsc' => $bank_data->ifsc_code
                                        ]
                                ]
                            ]
                        ];
                        
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://sandbox.cashfree.com/payout/transfers",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'transfer_id' => 'JUNOB2018',
    'transfer_amount' => 1,
    'transfer_mode' => 'imps',
    'beneficiary_details' => [
        'beneficiary_details' => [
                'beneficiary_instrument_details' => [
                                'bank_account_number' => '1234554321',
                                'bank_ifsc' => 'SBIN0001161'
                ]
        ]
    ]
  ]),
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "x-api-version: 2024-01-01",
    'x-client-id: ' . CF_APP_ID,
    'x-client-secret: ' . CF_SECRET_KEY
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}                        
die;
$curl = curl_init();
                        curl_setopt_array($curl, [
                          CURLOPT_URL => "https://sandbox.cashfree.com/payout/transfers",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => json_encode([
                        'transfer_id' => 'JUNOB2018',
                        'transfer_amount' => 1,
                        'transfer_mode' => 'imps',
                        'beneficiary_details' => [
                            'beneficiary_details' => [
                                    'beneficiary_instrument_details' => [
                                                    'bank_account_number' => '1234554321',
                                                    'bank_ifsc' => 'SBIN0001161'
                                    ]
                            ]
                        ]
                        ]),                          
                        CURLOPT_HTTPHEADER => [
                            "x-api-version: 2024-01-01",
                            'x-client-id: ' . CF_APP_ID,
                            'x-client-secret: ' . CF_SECRET_KEY
                          ],
                        ]);
                        
                        $response = curl_exec($curl);
                        $err = curl_error($curl);

                        curl_close($curl);
                        if ($err) {
                          echo "cURL Error #:" . $err;
                          die;
                        } else {
                          echo 'here';
                          die;
                        }                       
                        die;
                    } else {
                        $response = array("status" => "erorr", "message" => "Invalid quotation data");
                    }
                } else {
                    if ($id = $this->Common->add_info($this->table_name, $post_data)):
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Payment added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Payment not added successfully.");
                    endif;
                }
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
    

    function getAvailableAmount() {
        $response = array("status" => "error",'message' => 'Balance not available');
        $user_id = $this->tank_auth->get_user_id();
        $wallet_data = $this->Common->get_info($user_id, $this->table_name.' w', 'w.user_id','','w.available_amount as available_amount','','',array('field'=>'id','order'=>'desc'),1);
        if($wallet_data) {
            if($quote_data->pending_amount > 0) {
                $response = array("status" => "ok",'data' => $wallet_data); 
            } else {
                $wallet_data->wallet_amount = 0;
                $response = array("status" => "ok",'data' => $wallet_data); 
            }
        } 
        echo json_encode($response);
        die;
        
    }

}
