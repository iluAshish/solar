<script>
var Products = [];
Products = '<?php echo json_encode($products);?>';
Products = JSON.parse(Products);    
</script>

<?php
$DataID = $this->PrimaryKey;
$Products = array("" => "Select Product") + $products;
$product_id = array('name' => 'product_name[]', 'id' => 'productName-1', 'class' => "form-select");

if (isset($data_info) && isset($data_info->$DataID) && $data_info->$DataID > 0) {
    $data_id = array('name' => $DataID, 'id' => $DataID, 'value' => (isset($data_info) && $data_info->$DataID > 0) ? $data_info->$DataID : "", 'type' => 'hidden',);
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Add', 'class' => 'btn btn-success',);
$reset_btn = array('name' => 'cancel_btn', 'id' => 'cancel_btn', 'content' => 'Cancel', 'type' => 'reset', 'class' => 'btn btn-default',);
$form_attr = array('class' => 'default_form needs-validation', 'id' => 'course_frm', 'name' => 'course_frm' , 'novalidate' => '');

?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
					    <h2>Add Quotation</h2>
					</div>    
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
                <?php echo form_open_multipart(base_url($this->controllers.'/submit-form'), $form_attr); ?>
				<div class="card-body py-4">
                <?php
                    if (isset($data_info) && isset($data_info->$DataID) &&  $data_info->$DataID > 0) {
                        echo form_input($data_id);
                    }
                ?>
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="invoice_date" class="form-label">Date</label>
                                <input type="text" id="invoice_date" name="invoice_date" class="form-control date-field" placeholder="Enter date" value = '<?php echo (isset($data_info) && isset($data_info->invoice_date) && $data_info->invoice_date != "") ? $data_info->invoice_date : date('d-m-Y'); ?>' required data-provider="flatpickr" data-date-format="d-m-Y" readonly/>
                                <div class="invalid-tooltip">Please enter date</div>
                            </div>
                        </div>  
                        
                        <div class="col-lg-6">
                            <div>
                                <label for="reference_no" class="form-label">Invoice No</label>
                                <input type="text" id="invoice_no" name="invoice_no" class="form-control" placeholder="Enter invoice number" value = '<?php echo (isset($data_info) && isset($data_info->invoice_no) && $data_info->invoice_no != "") ? $data_info->invoice_no : $invoice_no; ?>' required readonly />
                                <div class="invalid-tooltip">Please enter refrence no</div>
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div>
                                <label for="franchisee_id" class="form-label">Franchisee</label>
                                <select class="form-select select-change" name="franchisee_id" id="franchisee_id" data-control="franchisee" data-name="client">
                                    <option>Select franchisee</option>
                                    <?php foreach($franchisees as $key=>$value) { ?>
                                    <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->franchisee_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="client_id" class="form-label">Client</label>
                                <select class="form-select select-change" name="client_id" id="client_id" data-control="franchisee" data-name="project">
                                    <option value="0">Select Client</option>
                                    <?php if(isset($data_info)) { 
                                        foreach($clients as $key=>$value) { ?>
                                    <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->client_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                    <?php } 
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="product_id" class="form-label">Products</label>
                                <select class="form-select" name="product_ids[]" data-control="select2" id="product_ids" multiple="multiple"  data-placeholder="Select products" >
                                    <option></option>
                                    <?php foreach($products as $key=>$value) { ?>
                                    <option value="<?php echo $key;?>" <?php echo (isset($data_info) && in_array($key, explode(',',$data_info->product_ids))) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                        <!--end row-->
                    <div class="row g-3 mt-4">

                    <div class="table-responsive">
                        <table class="quotation-table table table-nowrap mb-0">
                            <thead class="align-middle">
                                <tr>
                                    <th scope="col" style="width: 250px;">Project Name</th>
                                    <th scope="col" style="width: 100px;">Size Range</th>
                                    <th scope="col" style="width: 150px;">Rate / KW</th>
                                    <th scope="col" style="width: 100px;">Quantity</th>
                                    <th scope="col" style="width: 100px;">Amount</th>
                                </tr>
                            </thead>
                            <tbody id="newlink">
                            <!--begin::Form group-->
                                <?php if(isset($invoice_prod) && count($invoice_prod) > 0) {
                                $i=1;    
                                foreach($invoice_prod as $prod_data) { 
                                ?>
                                    <tr id="<?php echo $i;?>" class="product"> 
                                    <?php if(count($invoice_prod) == $i) { ?>
                                    <input type="hidden" id="row-count" class="row-count" value="<?php echo $i;?>">
                                    <?php } ?>
                                    <td style="padding-left:0px;">
                                        <select class="form-select" name="project_id[]" id="project_id">
                                            <option value="0" >Select Project</option>
                                            <?php foreach($projects as $key=>$value) { ?>
                                            <option value="<?php echo $key;?>" <?php echo (isset($prod_data) && $prod_data->project_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                            <?php  } ?>
                                        </select>
                                    </td>                                        
                                    <td>
                                        <select class="form-select size-ranges" name="project_prices[]" id="project_prices_1">
                                            <option value="0">Select Size</option>
                                            <?php 
                                            $ci = get_instance();
                                            $project_sizes = $this->Common->get_list(TBL_PROJECT_PRICE, "price_id", "size_range", "project_id = ".$prod_data->project_id);
                                            foreach($project_sizes as $key=>$value) { ?>
                                            <option value="<?php echo $key;?>" <?php echo (isset($prod_data) && $prod_data->size_range_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                            <?php } 
                                             ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control mb-2 mb-md-0 rate" placeholder="Enter rate" name="rate[]" value="<?php echo $prod_data->basic_rate;?>" readonly  />
                                    </td>
                                    <td>
                                        <input type="text" id="amount" name="amount[]" class="form-control amount" placeholder="Enter amount" value="<?php echo $prod_data->amount;?>" required readonly />
                                    </td>    
                                    
                                <?php $i++; }
                                } else {
                                ?>                                    
                                <tr>
                                    <input type="hidden" id="row-count" value="1">
                                    <td>
                                        <select class="form-select" name="project_id[]" id="project_id">
                                            <option value="0" >Select Project</option>
                                            <?php if(isset($data_info)) { 
                                                foreach($projects as $key=>$value) { ?>
                                            <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->project_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                            <?php } 
                                            } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-select size-ranges" name="project_prices[]" id="project_prices_1" data-control="projects" data-name="size_ranges">
                                            <option value="0" >Select Size</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control mb-2 mb-md-0" placeholder="Enter rate" name="rate[]"  />
                                    </td>
                                    <td>
                                        <input type="text" id="amount" name="amount[]" class="form-control" placeholder="Enter amount" value = '' required />
                                    </td>    
                                </tr>
                            <?php } ?>
                            </tbody>
                            <!--<tfoot>
                                <tr id="newForm" style="display: none;"><td class="d-none" colspan="5"><p>Add New Form</p></td></tr>
                                <tr>
                                    <td colspan="5">
                                        <a href="javascript:new_link()" id="add-item" class="btn btn-primary"><i class="ki-duotone ki-plus-square fs-3">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i> Add Item</a>
                                    </td>
                                </tr>
                            </tfoot> -->
                        </table>    
                    </div>
                        <!--end::Repeater-->


                        <!--end row-->
                        <div class="mt-4">
                            <label for="work_scope" class="form-label text-muted text-uppercase fw-semibold">Scope Of Work</label>
                            <textarea id="work_scope" name="work_scope" class="form-control alert alert-info" placeholder="Enter Scopre of work" ><?php echo (isset($data_info) && $data_info->work_scope != "") ? $data_info->work_scope : ''; ?></textarea>
                        </div>
        
                        <!--end row-->
                        <div class="mt-4">
                            <label for="specification" class="form-label text-muted text-uppercase fw-semibold">Specification</label>
                            <textarea id="specification" name="specification" class="form-control alert alert-info" placeholder="Enter specification" ><?php echo (isset($data_info) && $data_info->specification != "") ? $data_info->specification : ''; ?></textarea>
                        </div>
                        
                        <!--end row-->
                        <div class="mt-4">
                            <label for="invoice_details" class="form-label text-muted text-uppercase fw-semibold">NOTES</label>
                            <textarea id="invoice_details" name="invoice_details" class="form-control alert alert-info ckeditor-classic" placeholder="Enter invoice note" ><?php echo (isset($data_info) && isset($data_info->invoice_details) && $data_info->invoice_details != "") ? $data_info->invoice_details : $settings->quote_note; ?></textarea>
                        </div>
                        <div class="mt-4">
                            <label for="invoice_terms" class="form-label text-muted text-uppercase fw-semibold">Terms and Conditions</label>
                            <textarea id="invoice_terms" name="invoice_terms" class="form-control alert alert-info ckeditor-classic" placeholder="Enter invoice note" ><?php echo (isset($data_info) && isset($data_info->invoice_terms) && $data_info->invoice_terms != "") ? $data_info->invoice_terms : $settings->invoice_terms; ?></textarea>
                        </div>                                        
                        <!--<div class="hstack gap-2 justify-content-end d-print-none mt-4">
                            <button type="submit" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Save</button>
                            <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download Invoice</a>
                            <a href="javascript:void(0);" class="btn btn-danger"><i class="ri-send-plane-fill align-bottom me-1"></i> Send Invoice</a>
                        </div> --->
                    </div>
                <!--end row-->
                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light">Cancel</button>
                        <?php echo form_submit($submit_btn); ?>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
                </form>
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
<!--end::Content-->