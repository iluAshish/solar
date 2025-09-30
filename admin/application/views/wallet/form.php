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
                            <label for="description" class="form-label">Amount</label>
                            <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter amount" required value = '<?php echo (isset($data_info) && $data_info->description != "") ? $data_info->description : set_value('description') ?>'/>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="project_type" class="form-label">Payment Mode</label>
                            <select class="form-select" name="payment_mode" id="payment_mode">
                                <option>Select Type</option>
                                <option value="Cash" <?php echo (isset($data_info) && $data_info->project_type == "Cash") ? 'selected' : ''; ?> >Cash</option>
                                <option value="Online" <?php echo (isset($data_info) && $data_info->project_type == "Online") ? 'selected' : ''; ?>>Online</option>
                            </select>
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