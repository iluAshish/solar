<?php
$DataID = $this->PrimaryKey;
$state_name = array('name' => 'state_name', 'id' => 'state_name', 'value' => (isset($data_info) && $data_info->name != "") ? $data_info->name : set_value('state_name'), 'minlength' => 2, 'size' => 30, 'class' => "form-control");

if (isset($data_info) && $data_info->$DataID > 0) {
    $data_id = array('name' => $DataID, 'id' => $DataID, 'value' => (isset($data_info) && $data_info->$DataID > 0) ? $data_info->$DataID : "", 'type' => 'hidden',);
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Submit', 'class' => 'btn btn-success btn-cons',);
$reset_btn = array('name' => 'cancel_btn', 'id' => 'cancel_btn', 'content' => 'Cancel', 'type' => 'reset', 'class' => 'btn btn-default',);
$form_attr = array('class' => 'default_form', 'id' => 'course_frm', 'name' => 'course_frm');

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
                <h5 class="card-title mb-0">Add State</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label">State Name</label>
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                            <?php echo form_input($state_name); ?>                          
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="short_name" class="form-label">Short Name</label>
                            <input type="text" id="short_name" name="short_name" class="form-control" placeholder="Enter short name" required value = '<?php echo (isset($data_info) && $data_info->short_name != "") ? $data_info->short_name : set_value('short_name') ?>'/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="rto_code" class="form-label">RTO Code</label>
                            <input type="text" id="rto_code" name="rto_code" class="form-control" placeholder="Enter rto code" required value = '<?php echo (isset($data_info) && $data_info->rto_code != "") ? $data_info->rto_code : set_value('rto_code') ?>'/>
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