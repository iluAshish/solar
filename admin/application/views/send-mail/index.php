<?php 
$DataID = $this->PrimaryKey;
//$Brands = array("all" => "Send All") + $companies;
//$company_id = array('name' => 'company_ids[]', 'id' => 'company_ids', 'class' => "js-example-basic-single");
$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Send Mail', 'class' => 'btn btn-success',);
$reset_btn = array('name' => 'cancel_btn', 'id' => 'cancel_btn', 'content' => 'Cancel', 'type' => 'reset', 'class' => 'btn btn-default',);
$form_attr = array('class' => 'default_form needs-validation', 'id' => 'course_frm', 'name' => 'course_frm' , 'novalidate' => '');



?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php $this->load->view('partials/page-title', array('pagetitle'=>'Home','title'=>'Send Mail')); ?>
                    <?php
                        add_edit_form();
                    ?>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo form_open_multipart(base_url($this->controllers.'/send-mail'), $form_attr); ?>
                            <?php
                                if (isset($data_info) && $data_info->$DataID > 0) {
                                    echo form_input($data_id);
                                }
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Send Mail</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="industry_type-field" class="form-label">Company</label>
                                                <select class="js-example-basic-single select2" name="companies_id[]" id="send_company_id" multiple="">
                                                    <option value="all">All</option>
                                                    <?php
                                                    foreach($companies as $key=>$value) { ?>
                                                        <option value=<?php echo $key;?>><?php echo $value;?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="subject" class="form-label">Subject</label>
                                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter subject" value = '<?php echo (isset($data_info) && $data_info->model_number != "") ? $data_info->model_number : set_value('model_number') ?>' required />
                                                <div class="invalid-tooltip">Please enter subject</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="description" class="form-label">Message</label>
                                                <textarea id="description" name="description" class="form-control ckeditor-classic" placeholder="Enter description"><?php echo (isset($data_info) && $data_info->description != "") ? $data_info->description : set_value('description') ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light">Cancel</button>
                                        <?php echo form_submit($submit_btn); ?>
                                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>  

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

             <?php $this->load->view('partials/footer') ?>
        </div>
        <!-- end main content-->
