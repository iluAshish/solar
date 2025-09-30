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
                <h5 class="card-title mb-0">Add User</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div>
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select generate-code" name="role" id="role">
							    <option value="0">Select Role</option>
							    <?php foreach($roles as $key=>$value) { ?>
                                    <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->role == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!--<div class="col-lg-6">
                        <div>
                            <label for="franchisee_level" class="form-label">Level</label>
                            <select class="form-select" name="franchisee_level" id="franchisee_level">
                                <option value="District" <?php echo (isset($data_info) && $data_info->franchisee_level == "District") ? 'selected' : '' ?>>District</option>
                                <option value="State" <?php echo (isset($data_info) && $data_info->franchisee_level != "State") ? 'selected' : '' ?>>State</option>
                            </select>
                        </div>
                    </div>                     
                    <div class="col-lg-6">
                        <div>
                            <label for="franchisee_code" class="form-label">User Code</label>
                            <input type="text" id="user_code" name="franchisee_code" class="form-control" placeholder="Enter name" readonly required value = '<?php echo (isset($data_info) && $data_info->franchisee_code != "") ? $data_info->franchisee_code : $franchisee_code; ?>'/>
                        </div>
                    </div> -->  
                    <div class="col-lg-6">
                        <div>
                            <label for="fullname" class="form-label">Name</label>
                            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter name" required value = '<?php echo (isset($data_info) && $data_info->fullname != "") ? $data_info->fullname : set_value('fullname') ?>'/>
                        </div>
                    </div>  
                    <?php if(!isset($data_info)) { ?>
                        <div class="col-lg-6">
                            <div>
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required  value = ''/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required value = ''/>
                            </div>
                        </div>
                    <?php } ?>
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
                    <div class="col-lg-6">
                        <div>
                            <label for="state_id" class="form-label">State</label>
                            <select class="form-select select-change" id="state_id" name="state_id" data-control="user" data-name="district">
        						<option value="">Select State</option>
                                <?php foreach($states as $key=>$value) { ?>
        						<option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->state_id != "" && $data_info->state_id == $key) ? 'selected' : '' ?>><?php echo $value;?></option>
        						<?php } ?>
        					</select>
					    </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="district_id" class="form-label">District</label>
                            <select class="form-select" id="district_id" name="district_id">
        						<option value="">Select District</option>
                                <?php 
                                if($districts) {
                                    foreach($districts as $key=>$value) { ?>
            						<option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->district_id != "" && $data_info->district_id == $key) ? 'selected' : '' ?>><?php echo $value;?></option>
            						<?php }
            					} ?>
        					</select>
                        </div>
                    </div>
                    <?php if(!isset($data_info)) { ?>
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label">Is Vendor?</label>
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_vendor" >
                                </div>                                
                            </div>
                        </div>
                    <?php } ?>
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