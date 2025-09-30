<?php
$DataID = $this->PrimaryKey;
//$old_Image = array('name' => 'old_Image', 'id' => 'old_Image', 'value' => (isset($data_info) && $data_info->product_image != "") ? $data_info->product_image : '', 'type' => "hidden",);

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
		    
		    <?php
                add_edit_form();
            ?>
		    
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
					    <h2>Manage Settings</h2>
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
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Enter company name" value = '<?php echo (isset($data_info) && $data_info->company_name != "") ? $data_info->company_name : set_value('company_name') ?>' required />
                                <div class="invalid-tooltip">Please enter product name</div>
                            </div>
                        </div>  
                        
                        <div class="col-lg-6">
                            <div>
                                <label for="gst_no" class="form-label">GST No</label>
                                <input type="text" id="gst_no" name="gst_no" class="form-control" placeholder="Enter gst no" value = '<?php echo (isset($data_info) && $data_info->gst_no != "") ? $data_info->gst_no : set_value('gst_no') ?>' required />
                                <div class="invalid-tooltip">Please enter gst no</div>
                            </div>
                        </div>  
                        
                        <div class="col-lg-6">
                            <div>
                                <label for="mobile1" class="form-label">Mobile1</label>
                                <input type="text" id="mobile1" name="mobile1" class="form-control" placeholder="Enter mobile number" value = '<?php echo (isset($data_info) && $data_info->mobile1 != "") ? $data_info->mobile1 : set_value('mobile1') ?>' required />
                                <div class="invalid-tooltip">Please enter mobile number1</div>
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div>
                                <label for="mobile2" class="form-label">Mobile2</label>
                                <input type="text" id="mobile2" name="mobile2" class="form-control" placeholder="Enter mobile number" value = '<?php echo (isset($data_info) && $data_info->mobile2 != "") ? $data_info->mobile2 : set_value('mobile2') ?>' required />
                                <div class="invalid-tooltip">Please enter mobile number2</div>
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Enter email" value = '<?php echo (isset($data_info) && $data_info->email != "") ? $data_info->email : set_value('email') ?>' required />
                                <div class="invalid-tooltip">Please enter email</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="email" class="form-label">Franchisee Code Prefix</label>
                                <input type="text" id="franchisee_code" name="franchisee_code" class="form-control" placeholder="Enter franchisee code" value = '<?php echo (isset($data_info) && $data_info->franchisee_code != "") ? $data_info->franchisee_code : set_value('franchisee_code') ?>' required />
                                <div class="invalid-tooltip">Please enter email</div>
                            </div>
                        </div>                        
                        <!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="address" class="form-label">Address</label>
                                <textarea id="address" name="address" class="form-control ckeditor-classic" placeholder="Enter address"><?php echo (isset($data_info) && $data_info->address != "") ? $data_info->address : set_value('address') ?> </textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="bank_details" class="form-label">Bank Details</label>
                                <textarea type="text" id="bank_details" name="bank_details" class="form-control ckeditor-classic" placeholder="Enter bank details" ><?php echo (isset($data_info) && $data_info->bank_details != "") ? $data_info->bank_details : set_value('bank_details') ?></textarea>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div>
                                <label for="quote_title" class="form-label">Quotation Title</label>
                                <textarea type="text" id="quote_title" name="quote_title" class="form-control ckeditor-classic" placeholder="Enter quotation title" ><?php echo (isset($data_info) && $data_info->quote_title != "") ? $data_info->quote_title : set_value('quote_title') ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="quote_note" class="form-label">Quotation Note</label>
                                <textarea id="quote_note" name="quote_note" class="form-control ckeditor-classic" placeholder="Enter quotation note" ><?php echo (isset($data_info) && $data_info->quote_note != "") ? $data_info->quote_note : set_value('quote_note') ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="quote_terms" class="form-label">Quotation Terms</label>
                                <textarea id="quote_terms" name="quote_terms" class="form-control ckeditor-classic" placeholder="Enter quotation terms"><?php echo (isset($data_info) && $data_info->quote_terms != "") ? $data_info->quote_terms : set_value('quote_terms') ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="quote_footer" class="form-label">Quotation Footer</label>
                                <textarea id="quote_footer" name="quote_footer" class="form-control ckeditor-classic" placeholder="Enter quotation footer" ><?php echo (isset($data_info) && $data_info->quote_footer != "") ? $data_info->quote_footer : set_value('quote_footer') ?></textarea>
                            </div>
                        </div>
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