<?php
$DataID = $this->PrimaryKey;
$category_name = array('name' => 'category_name', 'id' => 'category_name', 'value' => (isset($data_info) && $data_info->category_name != "") ? $data_info->category_name : set_value('category_name'), 'minlength' => 2, 'size' => 30, 'class' => "form-control");

$old_Image = array('name' => 'old_Image', 'id' => 'old_Image', 'value' => (isset($data_info) && $data_info->cat_image != "") ? $data_info->cat_image : '', 'type' => "hidden",);

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
                <h5 class="card-title mb-0">Add Client</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label">Category Name</label>
                        <div class="input-with-icon  right">                                       
                            <i class=""></i>
                            <?php echo form_input($category_name); ?>                          
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label class="form-label">Category Image</label>
                            <input type="file" name="Image" id="Image" class="Image form-control"  accept="image/x-png,image/jpeg" />
                            <?php
                            if (!empty($data_info->cat_image)) {
                                echo '<img src="' . UPLOAD_DIR . CATEGORY . $data_info->cat_image . '" class="remove_image1" data-id="' . $data_info->cat_image . '"/ style="width:100px ;height: 100px;">';
                                echo form_input($old_Image);
                            }
                            ?>
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