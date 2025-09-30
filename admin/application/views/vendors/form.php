<?php
$DataID = $this->PrimaryKey;
if (isset($data_info) && $data_info->$DataID > 0) {
    $data_id = array('name' => $DataID, 'id' => $DataID, 'value' => (isset($data_info) && $data_info->$DataID > 0) ? $data_info->$DataID : "", 'type' => 'hidden',);
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Add', 'class' => 'btn btn-success btn-cons',);
$reset_btn = array('name' => 'cancel_btn', 'id' => 'cancel_btn', 'content' => 'Cancel', 'type' => 'reset', 'class' => 'btn btn-default',);
$form_attr = array('class' => 'default_form needs-validation', 'id' => 'course_frm', 'name' => 'course_frm' , 'novalidate' => '');

?>
<div class="row">
    <div class="col-lg-12">
        <?php echo form_open_multipart(base_url($this->controllers.'/submit-form'), $form_attr); ?>
        <?php
            if (isset($data_info) && $data_info->$DataID > 0) {
                echo form_input($data_id);
            }
        ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Add Vendor</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div>
                            <label for="vendor_name" class="form-label">Vendor Name</label>
                            <input type="text" id="vendor_name" name="vendor_name" class="form-control" placeholder="Enter vendor name" required value = '<?php echo (isset($data_info) && $data_info->vendor_name != "") ? $data_info->vendor_name : set_value('vendor_name') ?>'/>
                        </div>
                    </div>  
                    <div class="col-lg-6">
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Enter company email" required  value = '<?php echo (isset($data_info) && $data_info->vendor_email != "") ? $data_info->vendor_email : set_value('email') ?>'/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Enter mobile" required value = '<?php echo (isset($data_info) && $data_info->phone != "") ? $data_info->phone : set_value('mobile') ?>'/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Enter address" value = '<?php echo (isset($data_info) && $data_info->address != "") ? $data_info->address : set_value('address') ?>'/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="address" class="form-label">Pincode</label>
                            <input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter pincode" value = '<?php echo (isset($data_info) && $data_info->pincode != "") ? $data_info->pincode : set_value('pincode') ?>'/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="state_id" class="form-label">State</label>
                            <select class="form-select select-change" id="state_id" name="state_id" data-control="clients" data-name="city">
        						<option value="">Select State</option>
                                <?php foreach($states as $key=>$value) { ?>
        						<option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->state_id != "" && $data_info->state_id == $key) ? 'selected' : '' ?>><?php echo $value;?></option>
        						<?php } ?>
        					</select>
					    </div>
                    </div>

                    <!-- account details payouts  -->

                    <div class="col-lg-6">
                        <label>Account Holder Name</label>
                        <input type="text" name="account_holder" class="form-control" value = '<?php echo (isset($data_info) && $data_info->account_holder != "") ? $data_info->account_holder : set_value('account_holder') ?>'/>
                    </div>

                    <div class="col-lg-6">
                        <label>Account Number</label>
                        <input type="text" name="account_number" class="form-control" value = '<?php echo (isset($data_info) && $data_info->account_number != "") ? $data_info->account_number : set_value('account_number') ?>'/>
                    </div>

                    <div class="col-lg-6">
                        <label>IFSC Code</label>
                        <input type="text" name="ifsc_code" class="form-control" value = '<?php echo (isset($data_info) && $data_info->ifsc_code != "") ? $data_info->ifsc_code : set_value('ifsc_code') ?>'/>
                    </div>

                    <div class="col-lg-6">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" class="form-control" value = '<?php echo (isset($data_info) && $data_info->bank_name != "") ? $data_info->bank_name : set_value('bank_name') ?>'/>
                    </div>

                    <div class="col-lg-6">
                        <label>Branch Name</label>
                        <input type="text" name="branch_name" class="form-control" value = '<?php echo (isset($data_info) && $data_info->branch_name != "") ? $data_info->branch_name : set_value('branch_name') ?>'/>
                    </div>

                    <div class="col-lg-6">
                        <label>Payout Email</label>
                        <input type="email" name="payout_email" class="form-control" value = '<?php echo (isset($data_info) && $data_info->payout_email != "") ? $data_info->payout_email : set_value('payout_email') ?>'/>
                    </div>

                    <div class="col-lg-6">
                        <label>GSTIN Number</label>
                        <input type="text" name="gstin_number" class="form-control" value = '<?php echo (isset($data_info) && $data_info->gstin_number != "") ? $data_info->gstin_number : set_value('gstin_number') ?>'/>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light">Cancel</button>
                    <?php echo form_submit($submit_btn); ?>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>    