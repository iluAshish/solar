<?php
$DataID = $this->PrimaryKey;
    $designation_name = array('name' => 'designation_name', 'id' => 'designation_name', 'value' => (isset($data_info) && $data_info->designation_name != "") ? $data_info->designation_name : set_value('designation_name'), 'minlength' => 2, 'required' => 'required', 'size' => 30, 'class' => "form-control");

if (isset($data_info) && $data_info->$DataID > 0) {
    $data_id = array('name' => $DataID, 'id' => $DataID, 'value' => (isset($data_info) && $data_info->$DataID > 0) ? $data_info->$DataID : "", 'type' => 'hidden',);
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Add', 'class' => 'btn btn-success',);
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
                <h5 class="card-title mb-0">Add Desingation</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div>
                            <label for="designation_name" class="form-label">Desingation Name</label>
                            <?php echo form_input($designation_name); ?>   
                            <div class="invalid-tooltip">Please enter designation name</div>
                        </div>
                    </div>  
                    <div class="col-lg-6">
                        <div>
                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" name="description" class="form-control" placeholder="Enter description" value = <?php echo (isset($data_info) && $data_info->description != "") ? $data_info->description : set_value('description') ?> >
                        </div>
                    </div>  
                </div>
            </div>
            <div class="card-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light cancel_button">Cancel</button>
                    <?php echo form_submit($submit_btn); ?>
                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                </div>
            </div>
        </div>
        </form>
    </div>
</div>    