<?php
$old_password = array(
    'class' => 'form-control',
    'name' => 'old_password',
    'id' => 'old_password',
    'value' => set_value('old_password'),
    'size' => 30,
);
$new_password = array(
    'class' => 'form-control',
    'name' => 'new_password',
    'id' => 'new_password',
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'size' => 30,
);
$confirm_new_password = array(
    'class' => 'form-control',
    'name' => 'confirm_new_password',
    'id' => 'confirm_new_password',
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'size' => 30,
);
$submit_btn = array(
	'value'	=> 'Change Password',
	'type'	=> 'submit',
	'class'	=> 'btn btn-primary btn-cons',
);
?>
<?php echo form_open($this->uri->uri_string()); ?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
            <!--begin::Card header-->
            <?php echo form_open($this->uri->uri_string(), array('class' => 'animated fadeIn', 'id' => 'frm_login')); ?>
			<!--begin::Card-->
			<div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="address" class="form-label">Old Password</label>
                                <?php echo form_password($old_password); ?>
                                <span class="text-danger"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']]) ? $errors[$old_password['name']] : ''; ?></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="address" class="form-label">New Password</label>
                                <?php echo form_password($new_password); ?>
                                <span class="text-danger"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']]) ? $errors[$new_password['name']] : ''; ?></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="address" class="form-label">Confirm New Password</label>
                                <?php echo form_password($confirm_new_password); ?>
                                <span class="text-danger"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']]) ? $errors[$confirm_new_password['name']] : ''; ?></span>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <?php echo form_submit($submit_btn); ?>                            
                        <?php echo form_close(); ?>
                    </div>
                </div>    
                <?php echo form_close(); ?>
            </div>
        </div>    
    </div>
</div>    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
            
