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
                <h5 class="card-title mb-0">Add Client</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <?php if($role != 4) { ?>
                    <div class="col-lg-6">
                        <div>
                            <label for="staff_id" class="form-label">Franchisee</label>
                            <select class="form-select" name="franchisee_id" id="franchisee_id">
                                <option>Select franchisee</option>
                                <?php foreach($franchisees as $key=>$value) { ?>
                                <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->franchisee_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>  
                    <?php } ?>
                    <div class="col-lg-6">
                        <div>
                            <label for="staff_name" class="form-label">Client Name</label>
                            <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Enter client name" required value = '<?php echo (isset($data_info) && $data_info->client_name != "") ? $data_info->client_name : set_value('client_name') ?>'/>
                        </div>
                    </div>  
                    <div class="col-lg-6">
                        <div>
                            <label for="email" class="form-label">Person Name</label>
                            <input type="text" id="contact_person" name="contact_person" class="form-control" placeholder="Enter company person" required  value = '<?php echo (isset($data_info) && $data_info->contact_person != "") ? $data_info->contact_person : set_value('contact_person') ?>'/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Enter company email" required  value = '<?php echo (isset($data_info) && $data_info->client_email != "") ? $data_info->client_email : set_value('email') ?>'/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Enter mobile" required value = '<?php echo (isset($data_info) && $data_info->phone != "") ? $data_info->phone : set_value('mobile') ?>'/>
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
                            <select class="form-select select-change" id="state_id" name="state_id" data-control="clients" data-name="city">
        						<option value="">Select State</option>
                                <?php foreach($states as $key=>$value) { ?>
        						<option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->state_id != "" && $data_info->state_id == $key) ? 'selected' : '' ?>><?php echo $value;?></option>
        						<?php } ?>
        					</select>
					    </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="city_id" class="form-label">City</label>
                            <select class="form-select" id="city_id" name="city_id">
        						<option value="">Select City</option>
                                <?php 
                                if($cities) {
                                    foreach($cities as $key=>$value) { ?>
            						<option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->city_id != "" && $data_info->city_id == $key) ? 'selected' : '' ?>><?php echo $value;?></option>
            						<?php }
            					} ?>
        					</select>
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