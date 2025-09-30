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
                <h5 class="card-title mb-0">Add Project</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div>
                            <label for="franchisee_id" class="form-label">Franchisee</label>
                            <select class="form-select select-change" name="franchisee_id" id="franchisee_id" data-control="user" data-name="client">
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
                            <select class="form-select select-change" name="client_id" id="client_id" id="franchisee_id" data-control="quotation" data-name="quotation">
                                <option>Select Client</option>
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
                            <label for="client_id" class="form-label">Quotation</label>
                            <select class="form-select quotation_id" name="quotation_id" id="quotation_id">
                                <option>Select Quotation</option>
                                <?php if(isset($data_info)) { 
                                    foreach($quotations as $key=>$value) { ?>
                                <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->client_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                <?php } 
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="description" class="form-label">Pending Amount</label>
                            <input type="number" min="1" id="pending_amount" name="pending_amount" class="form-control" placeholder="Enter pending amount" required readonly  value = '<?php echo (isset($data_info) && $data_info->description != "") ? $data_info->description : set_value('description') ?>'/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="description" class="form-label">Paid Amount</label>
                            <input type="text" id="paid_amount" name="paid_amount" class="form-control" placeholder="Enter paid amount" required value = '<?php echo (isset($data_info) && $data_info->description != "") ? $data_info->description : set_value('description') ?>'/>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="project_type" class="form-label">Payment Mode</label>
                            <select class="form-select" name="payment_mode" id="payment_mode">
                                <option>Select Type</option>
                                <option value="Cash" <?php echo (isset($data_info) && $data_info->project_type == "Cash") ? 'selected' : ''; ?> >Cash</option>
                                <option value="Online" <?php echo (isset($data_info) && $data_info->project_type == "Online") ? 'selected' : ''; ?>>Online</option>
                                <option value="Cheque" <?php echo (isset($data_info) && $data_info->project_type == "Cheque") ? 'selected' : ''; ?> >Cheque</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="project_type" class="form-label">Transaction No</label>
                            <input type="text" id="transaction_no" name="transaction_no" class="form-control" placeholder="Enter transaction no" required  value = '<?php echo (isset($data_info) && $data_info->description != "") ? $data_info->description : set_value('description') ?>'/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="payment_date" class="form-label">Date</label>
                            <input type="text" id="payment_date" name="payment_date" class="form-control date-field" placeholder="Enter date" value = '<?php echo (isset($data_info) && $data_info->payment_date != "") ? $data_info->payment_date : date('d-m-Y'); ?>' required data-provider="flatpickr" data-date-format="d-m-Y" readonly/>
                            <div class="invalid-tooltip">Please enter date</div>
                        </div>
                    </div>  
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" name="description" class="form-control" placeholder="Enter description" required  value = '<?php echo (isset($data_info) && $data_info->description != "") ? $data_info->description : set_value('description') ?>'/>
                        </div>
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