<?php
$DataID = $this->PrimaryKey;
$SubcategoryName = array('name' => 'SubcategoryName', 'id' => 'SubcategoryName', 'value' => (isset($data_info) && $data_info->SubcategoryName != "") ? $data_info->SubcategoryName : set_value('SubcategoryName'), 'minlength' => 2, 'size' => 30, 'class' => "form-control");

$Category = array("" => "Select Category") + $category;
$CategoryID = array('name' => 'CategoryID', 'id' => 'CategoryID', 'class' => "form-control select");

$old_Image = array('name' => 'old_Image', 'id' => 'old_Image', 'value' => (isset($data_info) && $data_info->Image != "") ? $data_info->Image : '', 'type' => "hidden",);

if (isset($data_info) && $data_info->$DataID > 0) {
    $data_id = array('name' => $DataID, 'id' => $DataID, 'value' => (isset($data_info) && $data_info->$DataID > 0) ? $data_info->$DataID : "", 'type' => 'hidden',);
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Submit', 'class' => 'btn btn-success btn-cons',);
$reset_btn = array('name' => 'cancel_btn', 'id' => 'cancel_btn', 'content' => 'Cancel', 'type' => 'reset', 'class' => 'btn btn-default',);
$form_attr = array('class' => 'default_form', 'id' => 'course_frm', 'name' => 'course_frm');

?>

    <div class="page-title"> <i class="icon-custom-left"></i>
        <h3><?php echo $page_title; ?></h3>
      </div> 
    <div class="row">
        <div class="col-md-12">
            <div class="grid simple">
                <div class="grid-title no-border">
                    <h4>Subcategory Information</h4>
                </div>
                <div class="grid-body no-border">
                    <?php
                        $this->load->view("includes/messages");
                    ?>

                    <?php echo validation_errors(); ?>
                    <div class=" form">
                        <?php echo form_open_multipart(base_url($this->controllers.'/submit-form'), $form_attr); ?>
                        <?php
                            if (isset($data_info) && $data_info->$DataID > 0) {
                                echo form_input($data_id);
                            }
                        ?>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Category</label>
                                <?php
                                echo form_dropdown('CategoryID', $Category, (isset($data_info) && $data_info->CategoryID != "") ? $data_info->CategoryID : set_value('CategoryID'), $CategoryID);
                                ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">SubCategory Name</label>
                                <div class="input-with-icon  right">                                       
                                    <i class=""></i>
                                    <?php echo form_input($SubcategoryName); ?>                          
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Sub Category Image</label>
                                    <input type="file" name="Image" id="Image" class="Image form-control"  accept="image/x-png,image/jpeg" />
                                    <?php
                                    if (!empty($data_info->Image)) {
                                        echo '<img src="' . UPLOAD_DIR . CATEGORY . $data_info->Image . '" class="remove_image1" data-id="' . $data_info->Image . '"/ style="width:100px ;height: 100px;">';
                                        echo form_input($old_Image);
                                    }
                                    ?>
                                </div>
                        </div>
                        <div class="form-actions">  
                            <div class="pull-right">
                                <?php echo form_submit($submit_btn); ?>
                                <a class="btn btn-white btn-cons cancel_button" href="javascript:;">Cancel</a>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>		
    </div>