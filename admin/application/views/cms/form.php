<?php
$DataID = $this->PrimaryKey;

$PageName = array('name' => 'PageName', 'id' => 'PageName', 'value' => (isset($data_info) && $data_info->PageName != "") ? $data_info->PageName : set_value('PageName'), 'minlength' => 2, 'size' => 30, 'class' => "form-control");

$Description = array('name' => 'Description', 'id' => 'Description', 'value' => (isset($data_info) && $data_info->Description != "") ? $data_info->Description : set_value('Description'), 'class' => "form-control");

$ShortDes = array('name' => 'ShortDes', 'id' => 'ShortDes', 'value' => (isset($data_info) && $data_info->ShortDes != "") ? $data_info->ShortDes : set_value('ShortDes'), 'class' => "form-control");

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
                    <h4>Banner Information</h4>
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
                                <label class="form-label">Page Name</label>
                                <div class="input-with-icon  right">                                       
                                    <i class=""></i>
                                    <?php echo form_input($PageName); ?>                          
                                </div>
                            </div>
                            <div class="row">
                                 <div class="form-group col-md-6">
                                    <label>Images</label>
                                        <input type="file" name="Image" id="Image" class="Image form-control" multiple="multiple" accept="image/x-png,image/jpeg" />
                                    <?php
                                    if (!empty($data_info->Image)) {
                                        echo '<img src="' . UPLOAD_DIR . CMS . $data_info->Image . '" class="remove_image1" data-id="' . $data_info->Image . '"/ style="width:100px ;height: 100px;">';
                                        echo form_input($old_Image);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                                <label class="form-label">Short Description</label>
                                <div class="input-with-icon  right">                                       
                                    <i class=""></i>
                                    <?php echo form_textarea($ShortDes); ?>                          
                                </div>
                          </div>
                          <div class="form-group col-md-6">
                                <label class="form-label">Description</label>
                                <div class="input-with-icon  right">                                       
                                    <i class=""></i>
                                    <?php echo form_textarea($Description); ?>                          
                                </div>
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

<script>
CKEDITOR.replace('ShortDes');  
</script>

 <script>
CKEDITOR.replace('Description');  
</script>
   

  