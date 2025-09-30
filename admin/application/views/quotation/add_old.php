<script>
var Products = [];
Products = '<?php echo json_encode($products);?>';
Products = JSON.parse(Products);    
</script>

<?php
$DataID = $this->PrimaryKey;
$Products = array("" => "Select Product") + $products;
$product_id = array('name' => 'product_name[]', 'id' => 'productName-1', 'class' => "form-select");

if (isset($data_info) && $data_info->$DataID > 0) {
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
                    if (isset($data_info) && $data_info->$DataID > 0) {
                        echo form_input($data_id);
                    }
                ?>
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="qauote_date" class="form-label">Date</label>
                                <input type="text" id="qauote_date" name="qauote_date" class="form-control date-field" placeholder="Enter date" value = '<?php echo (isset($data_info) && $data_info->qauote_date != "") ? $data_info->qauote_date : date('d-m-Y'); ?>' required data-provider="flatpickr" data-date-format="d-m-Y" readonly/>
                                <div class="invalid-tooltip">Please enter date</div>
                            </div>
                        </div>  
                        
                        <div class="col-lg-6">
                            <div>
                                <label for="reference_no" class="form-label">Reference Number</label>
                                <input type="text" id="reference_no" name="reference_no" class="form-control" placeholder="Enter reference number" value = '<?php echo (isset($data_info) && $data_info->reference_no != "") ? $data_info->reference_no : $ref_no; ?>' required readonly />
                                <div class="invalid-tooltip">Please enter refrence no</div>
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div>
                                <label for="franchisee_id" class="form-label">Franchisee</label>
                                <select class="form-select select-change" name="franchisee_id" id="franchisee_id" data-control="franchisee" data-name="client">
                                    <option value="0">Select franchisee</option>
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
                                <label for="client_id" class="form-label">Project</label>
                                <select class="form-select" name="project_id" id="project_id">
                                    <option value="0" >Select Project</option>
                                    <?php if(isset($data_info)) { 
                                        foreach($projects as $key=>$value) { ?>
                                    <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->project_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                    <?php } 
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="com_reference_no" class="form-label">Company Ref. Number</label>
                                <input type="text" id="com_reference_no" name="com_reference_no" class="form-control" placeholder="Enter reference number" value = '<?php echo (isset($data_info) && $data_info->cust_ref_no != "") ? $data_info->cust_ref_no : ''; ?>' required />
                                <div class="invalid-tooltip">Please enter company reference no</div>
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
                                    <th scope="col" style="width: 250px;">Product Name</th>
                                    <th scope="col" style="width: 100px;">Quantity</th>
                                    <th scope="col" style="width: 150px;">Rate / KW</th>
                                    <th scope="col" style="width: 100px;">Amount</th>
                                    <th scope="col" style="width: 80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="newlink">
                                <?php if(isset($quote_prod) && count($quote_prod) > 0) {
                                $i=1;    
                                foreach($quote_prod as $prod_data) { 
                                ?>
                                    <tr id="<?php echo $i;?>" class="product"> 
                                    <?php if(count($quote_prod) == $i) { ?>
                                    <input type="hidden" id="row-count" class="row-count" value="<?php echo $i;?>">
                                    <?php } ?>
                                    <td style="padding-left:0px;">
                                        <?php
                                            $product_id = array('name' => 'product_name[]', 'id' => 'productName-'.$i, 'class' => "form-select product");
                                            echo form_dropdown('product_name[]', $Products,$prod_data->product_id, $product_id);
                                        ?>
                                    </td>                                        
                                    <td>
                                        <input type="text" class="form-control mb-2 mb-md-0 quantity" placeholder="Enter quantity" name="qty[]" value="<?php echo $prod_data->qty;?>" />
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
                                        <?php
                                            echo form_dropdown('product_name[]', $Products, set_value('product_name'), $product_id);
                                        ?>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control mb-2 mb-md-0 quantity" placeholder="Enter quantity" name="qty[]" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control mb-2 mb-md-0 rate" placeholder="Enter rate" name="rate[]" readonly  />
                                    </td>
                                    <td>
                                        <input type="text" id="amount" name="amount[]" class="form-control amount" placeholder="Enter amount" value = '' required readonly />
                                    </td>    
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
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
                            </tfoot>
                        </table>    
                    </div>
                        <!--end::Repeater-->


                        
                        <!--end row-->
                        <div class="mt-4">
                            <label for="quote_note" class="form-label text-muted text-uppercase fw-semibold">NOTES</label>
                            <textarea id="quote_note" name="quote_note" class="form-control alert alert-info ckeditor-classic" placeholder="Enter quotation note" ><?php echo (isset($data_info) && $data_info->quote_notes != "") ? $data_info->quote_notes : $settings->quote_note; ?></textarea>
                        </div>
                        <div class="mt-4">
                            <label for="quote_terms" class="form-label text-muted text-uppercase fw-semibold">Terms and Conditions</label>
                            <textarea id="quote_terms" name="quote_terms" class="form-control alert alert-info ckeditor-classic" placeholder="Enter quotation note" ><?php echo (isset($data_info) && $data_info->quote_terms != "") ? $data_info->quote_terms : $settings->quote_terms; ?></textarea>
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