<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Controller {

    public $table_name = TBL_PRODUCT;
    public $controllers = 'products';
    public $view_name = 'product';
    public $title = 'Product';
    public $PrimaryKey = 'id';
    public $role_id = '';

    function __construct() {
        parent::__construct();
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login/');
        }
        $this->role_id = $this->session->userdata('role_id');
        $this->load->Model('Remove_records');
    }

    function index() {
        $data['role_id'] = $this->role_id;
        $data['page_title'] = "Manage " . $this->title;
        $data['main_content'] = $this->view_name . '/list';
        $data['breadcrumb'] = '<!--begin::Item-->
					<li class="breadcrumb-item text-grey-900">Products</li>
					<!--end::Item-->';        
        
        $this->load->view('main_content', $data);
    }

    function add() {
        $data['categories'] = $this->Common->get_list(TBL_CATEGORY,'id','category_name',"status = 'ACTIVE'");
        $data['brands'] = $this->Common->get_list(TBL_BRAND,'id','brand_name');
        //$data['subcategory'] = array();
        $data['page_title'] = "Add New " . $this->title;
        $this->load->view($this->view_name . '/form', $data);
    }


    function edit($id) {
        $data_found = 0;
        if ($id > 0) {
            $data_obj = $this->Common->get_info($id, $this->table_name, $this->PrimaryKey);
            if (is_object($data_obj) && count((array) $data_obj) > 0) {
                $data['categories'] = $this->Common->get_list(TBL_CATEGORY,'id','category_name',"status = 'ACTIVE'");
                $data['brands'] = $this->Common->get_list(TBL_BRAND,'id','brand_name');
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
            $this->form_validation->set_rules('category_id', 'Category Name', 'required');
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
            $this->form_validation->set_rules('franchisee_price', 'Franchisee Price', 'required');
            /*if (empty($_FILES['Image']['name']) && $this->input->post('old_Image') == '') {
                $this->form_validation->set_rules('Image', 'Product Image', 'required');
            }*/
            $this->form_validation->set_error_delimiters($error_element[0], $error_element[1]);
            if ($this->form_validation->run()) {
                $id = ($this->input->post($this->PrimaryKey) && $this->input->post($this->PrimaryKey) > 0) ? $this->input->post($this->PrimaryKey) : 0;
                $post_data = array(
                    "category_id" => ($this->input->post('category_id')) ? $this->input->post('category_id') : 0,
                    "brand_id" => ($this->input->post('brand_id')) ? $this->input->post('brand_id') : 0,
                    "product_name" => $this->input->post('product_name'),
                    "price" => $this->input->post('price'),
                    "franchisee_price" => $this->input->post('franchisee_price'),
                    "warranty_years" => $this->input->post('warranty'),
                    "availability" => $this->input->post('availability'),
                    "quantity" => $this->input->post('quantity'),
                    "making" => $this->input->post('making'),
                    "description" => $this->input->post('description'),
                );
                if (!empty($_FILES['Image']['name'])) {
                    $file_data = upload_file('Image', UPLOAD_DIR . PRODUCT_DIR, ($this->input->post('old_Image')) ? $this->input->post('old_Image') : '');
                    if (is_array($file_data) && $file_data['file_name'] != "") {
                        $post_data['product_image'] = $file_data['file_name'];
                    } else {
                        $response['message'] = $file_data;
                        echo json_encode($response);
                        die;
                    }
                }
                if ($id > 0):
                    $post_data['updated_at'] = date("Y-m-d H:i:s");
                    if ($this->Common->update_info($id, $this->table_name, $post_data, $this->PrimaryKey)):
                        $response = array("status" => "ok", "heading" => "Product Updated successfully...", "message" => "Product updated successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Product Not Updated...", "message" => "Product not updated successfully.");
                    endif;
                else:
                    $post_data['created_at'] = date("Y-m-d H:i:s");
                    if ($this->Common->add_info($this->table_name, $post_data)):
                        $response = array("status" => "ok", "heading" => "Add successfully...", "message" => "Product added successfully.");
                    else:
                        $response = array("status" => "error", "heading" => "Not Added successfully...", "message" => "Product not added successfully.");
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
                $message = "Product Activated";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Product Deactivated";
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
                $message = "Product Feature Activated";
            } else {
                $activated = 0;
                $status = "ok";
                $heading = "Success";
                $message = "Product Feature Deactivated";
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
        $this->datatables->select('p.'.$this->PrimaryKey . ', product_name,category_name,warranty_years,price,franchisee_price');
        $this->datatables->from($this->table_name. ' p')
                ->join(TBL_CATEGORY . ' c', 'c.id = p.category_id', 'LEFT');
        if($this->role_id == 1) {
               $this->datatables->add_column('is_active', '$1', 'active_row($1,' . $this->table_name.', p.' . $this->PrimaryKey.',product)')
                ->add_column('action', $this->action_row('$1'), 'p.'.$this->PrimaryKey);
        }
        //$this->datatables->edit_column('Image', $this->show_image('$1'), 'Image');
        $this->datatables->unset_column('p.'.$this->PrimaryKey);
        $this->datatables->order_by('p.'.$this->PrimaryKey);
        echo $this->datatables->generate();
    }


    function show_image($image) {
        $url = UPLOAD_DIR . PRODUCT . $image;
        $defaultimage = DEFAULT_AVATAR;
        $image = '<img src="' . $url . '" width="80px" height="60px" onerror="this.onerror=null;this.src=\'' . $defaultimage . '\';">';
        return $image;
    }

    function action_row($id) {
        $action = <<<EOF
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
    
    function getdata() {
        $ProductID = $this->input->post('ProductID');
        $GetCat = $this->Common->get_info($ProductID, $this->table_name, $this->PrimaryKey);
        if (!empty($GetCat)) {
            $response = array("status" => "ok", "data" => $GetCat);
        } else {
            $response = array("status" => "error");
        }
        echo json_encode($response);
        die;
    }

}
