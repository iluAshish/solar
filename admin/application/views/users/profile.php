<?php
$DataID = $this->PrimaryKey;
if (isset($data_info) && $data_info->$DataID > 0) {
    $data_id = array('name' => $DataID, 'id' => $DataID, 'value' => (isset($data_info) && $data_info->$DataID > 0) ? $data_info->$DataID : "", 'type' => 'hidden',);
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Update', 'class' => 'btn btn-success',);
$reset_btn = array('name' => 'cancel_btn', 'id' => 'cancel_btn', 'content' => 'Cancel', 'type' => 'reset', 'class' => 'btn btn-default',);
$form_attr = array('class' => 'default_form needs-validation', 'id' => 'course_frm', 'name' => 'course_frm' , 'novalidate' => '');

?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Details</h5>
                </div>

                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <?php echo form_open_multipart(base_url($this->controllers.'/update-profile'), $form_attr); ?>
                    <?php
                        if (isset($data_info) && $data_info->$DataID > 0) {
                            echo form_input($data_id);
                        }
                    ?>
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <div class="row g-3">
                            <div class="col-12 mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>   
                                <!--end::Label-->  
                                
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true" style="background-image: url('<?php echo $user_img; ?>')">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: none;"></div>
                                        <!--end::Preview existing avatar-->
            
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                            <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="profile_pic" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="avatar_remove" value="1">
                                            <input type="hidden" name="avatar_remove" value="<?php echo $data_info->profilepic;?>">
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
            
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                            </span>
                                        <!--end::Cancel-->
            
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                            </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
            
                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types:  png, jpg, jpeg.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                            </div>                            
                            
                            <div class="col-lg-6">
                                <div>
                                    <label for="fullname" class="form-label">Name</label>
                                    <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter name" required value = '<?php echo (isset($data_info) && $data_info->fullname != "") ? $data_info->fullname : set_value('fullname') ?>'/>
                                </div>
                            </div>  
                            <div class="col-lg-6">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter company email" required  value = '<?php echo (isset($data_info) && $data_info->email != "") ? $data_info->email : set_value('email') ?>'/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Enter mobile" required value = '<?php echo (isset($data_info) && $data_info->mobile != "") ? $data_info->mobile : set_value('mobile') ?>'/>
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
                        </div>        
                    </div>
                    <!--end::Card body-->
        
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                        <?php echo form_submit($submit_btn); ?>
                    </div>
                        <!--end::Actions-->
                    <input type="hidden">
                    </form>
                    <!--end::Form-->
                </div>
            </div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
<!--end::Content-->