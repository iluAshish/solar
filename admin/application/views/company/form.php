<?php
$DataID = $this->PrimaryKey;
$Sectors = array("" => "Select Sector") + $sectors;
$sector_id = array('name' => 'sector_id', 'id' => 'sector_id', 'class' => "js-example-basic-single");

$Designations = array("" => "Select Designation") + $designations;
$designation_id = array('name' => 'designation_id[]', 'id' => 'designation_id_1', 'class' => "js-example-basic-single designation");



//$old_Image = array('name' => 'old_Image', 'id' => 'old_Image', 'value' => (isset($data_info) && $data_info->Image != "") ? $data_info->Image : '', 'type' => "hidden",);

if (isset($data_info) && $data_info->$DataID > 0) {
    $data_id = array('name' => $DataID, 'id' => $DataID, 'value' => (isset($data_info) && $data_info->$DataID > 0) ? $data_info->$DataID : "", 'type' => 'hidden',);
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Add', 'class' => 'btn btn-success btn-cons',);
$reset_btn = array('name' => 'cancel_btn', 'id' => 'cancel_btn', 'content' => 'Cancel', 'type' => 'reset', 'class' => 'btn btn-default',);
$form_attr = array('class' => 'default_form needs-validation', 'id' => 'course_frm', 'name' => 'course_frm' , 'novalidate' => '');

?>

<script>
var Designations = [];
Designations = '<?php echo json_encode($designations);?>';
Designations = JSON.parse(Designations);    
</script>



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
                <h5 class="card-title mb-0">Add Company</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!--<div class="col-lg-12">
                        <div class="text-center">
                            <div class="position-relative d-inline-block">
                                <div class="position-absolute bottom-0 end-0">
                                    <label for="company-logo-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                        <div class="avatar-xs cursor-pointer">
                                            <div class="avatar-title bg-light border rounded-circle text-muted">
                                                <i class="ri-image-fill"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input class="form-control d-none" value="" id="company-logo-input" type="file" accept="image/png, image/gif, image/jpeg">
                                </div>
                                <div class="avatar-lg p-1">
                                    <div class="avatar-title bg-light rounded-circle">
                                        <img src="assets/images/users/multi-user.jpg" id="companylogo-img" class="avatar-md rounded-circle object-fit-cover" />
                                    </div>
                                </div>
                            </div>
                            <h5 class="fs-13 mt-3">Company Logo</h5>
                        </div>
                    </div> -->
                    <div class="col-lg-6">
                        <div>
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Enter company name" required value = '<?php echo (isset($data_info) && $data_info->company_name != "") ? $data_info->company_name : set_value('company_name') ?>'/>
                            <div class="invalid-tooltip">Please enter company name</div>
                        </div>
                    </div>  
                    <div class="col-lg-6">
                        <div>
                            <label for="sector" class="form-label">Sector</label>
                            <div class="col-lg-11" style="display:inline-block;">
                            <?php
                                echo form_dropdown('sector_id', $Sectors, (isset($data_info) && $data_info->company_sector != "") ? $data_info->company_sector : set_value('sector_id'), $sector_id);
                            ?>
                            </div><div class="col-lg-1" style="display:inline;">
                            <button id="addRow" class="btn btn-sm btn-primary open_master_popup" data-control="sector" method=""><i class="ri-add-fill me-1 align-bottom"></i></button></div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="company_phone" class="form-label">Company Phone</label>
                            <input type="text" id="company_phone" name="company_phone" class="form-control" placeholder="Enter company phone" value = '<?php echo (isset($data_info) && $data_info->company_phone != "") ? $data_info->company_phone : set_value('company_phone') ?>'/>
                            <div class="invalid-tooltip">Please enter Company phone</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="company_email" class="form-label">Company Email</label>
                            <input type="text" id="company_email" name="company_email" class="form-control" placeholder="Enter company email" value = '<?php echo (isset($data_info) && $data_info->company_email != "") ? $data_info->company_email : set_value('company_email') ?>'/>
                            <div class="invalid-tooltip">Please enter Company email</div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div>
                            <label for="person_email" class="form-label">Person Email</label>
                            <input type="text" id="person_email" name="person_email" class="form-control" placeholder="Enter email" required value = '<?php echo (isset($data_info) && $data_info->person_email != "") ? $data_info->person_email : set_value('person_email') ?>'/>
                            <div class="invalid-tooltip">Please enter person email</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="person_mobile" class="form-label">Person Mobile</label>
                            <input type="text" id="person_mobile" name="person_mobile" class="form-control" placeholder="Enter mobile" required value = '<?php echo (isset($data_info) && $data_info->person_mobile != "") ? $data_info->person_mobile : set_value('person_mobile') ?>'/>
                            <div class="invalid-tooltip">Please enter person mobile</div>
                        </div>
                    </div> -->
                    <div class="col-lg-6">
                        <div>
                            <label for="company_website" class="form-label">Website</label>
                            <input type="text" id="company_website" name="company_website" class="form-control" placeholder="Enter website" value = '<?php echo (isset($data_info) && $data_info->company_website != "") ? $data_info->company_website : set_value('company_website') ?>'/>
                            <div class="invalid-tooltip">Please enter company website</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="gst_no" class="form-label">GST No.</label>
                            <input type="text" id="gst_no" name="gst_no" class="form-control" placeholder="Enter gst no" value = '<?php echo (isset($data_info) && $data_info->gst_no != "") ? $data_info->gst_no : set_value('gst_no') ?>'/>
                            <div class="invalid-tooltip">Please enter gst no</div>
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
                            <label for="address" class="form-label">Landmark</label>
                            <input type="text" id="landmark" name="landmark" class="form-control" placeholder="Enter landmark" value = '<?php echo (isset($data_info) && $data_info->landmark != "") ? $data_info->landmark : set_value('landmark') ?>'/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="state_id" class="form-label">State</label>
                            <select class="form-control select2" id="state_id" name="state_id">
        						<option value="">Select State</option>
                                <?php foreach($states as $key=>$value) { ?>
        						<option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->state != "" && $data_info->state == $key) ? 'selected' : '' ?>><?php echo $value;?></option>
        						<?php } ?>
        					</select>
					    </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="city_id" class="form-label">City</label>
                            <select class="form-control select2" id="city_id" name="city_id">
        						<option value="">Select City</option>
                                <?php 
                                if($cities) {
                                    foreach($cities as $key=>$value) { ?>
            						<option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->city != "" && $data_info->city == $key) ? 'selected' : '' ?>><?php echo $value;?></option>
            						<?php }
            					} ?>
        					</select>
                        </div>
                    </div>
                    <div class="table-responsive col-lg-12">
                        <table class="invoice-table table table-borderless table-nowrap mb-0">
                            <thead class="align-middle">
                                <tr class="table-active">
                                    <th scope="col">#</th>
                                    <th scope="col">Person Name</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Is Mail</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="newperson">
                                <?php if(isset($company_person)) {
                                $i=1;    
                                foreach($company_person as $person_data) { 
                                ?>
                                    
                                   <tr id="<?php echo $i;?>" class="product"> 
                                   <?php if(count($company_person) == $i) { ?>
                                    <input type="hidden" id="row-count" class="row-count" value="<?php echo $i;?>">
                                    <?php } ?>
                                    <th scope="row" class="person-id"><?php echo $i;?></th>
                                    <td class="text-start col-3">
                                        <div class="mb-2">
                                            <input type="text" id="person_name_<?php echo $i;?>" name="person_name[]" class="form-control" placeholder="Enter person name" required value="<?php echo $person_data->person_name;?>" />
                                            <div class="invalid-tooltip">Please enter Person name</div>
                                        </div>
                                    </td>
                                    
                                    <td class="text-start col-3">
                                        <div class="mb-2">
                                            <?php
                                                $designation_id = array('name' => 'designation_id[]', 'id' => 'designation_id_'.$i, 'class' => "js-example-basic-single product designation");
                                                echo form_dropdown('designation_id[]', $Designations,$person_data->person_designation, $designation_id);
                                            ?>
                                            <div class="invalid-feedback">Please enter a designation</div>
                                        </div>
                                    </td>
                                    <td class="text-start col-2">
                                        <div class="mb-2">
                                            <input type="text" id="person_email_<?php echo $i;?>" name="person_email[]" class="form-control" placeholder="Enter email" required value="<?php echo $person_data->person_email;?>" />
                                            <div class="invalid-tooltip">Please enter person email</div>
                                        </div>
                                    </td>
                                    <td class="text-start col-2">
                                        <div class="mb-2">
                                            <input type="text" id="person_mobile_<?php echo $i;?>" name="person_mobile[]" class="form-control" placeholder="Enter mobile" required value="<?php echo $person_data->person_mobile;?>" />
                                            <div class="invalid-tooltip">Please enter person mobile</div>
                                        </div>
                                    </td>
                                    
                                    <td class="text-start col-2">
                                        <div class="mb-2">
                                            <div class="form-check form-checkbox-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="is_send_mail[]" id="send_mail1" value="1" <?php echo ($person_data->is_send_mail == 1) ? "checked" : "";?>>
                                                <label class="form-check-label" for="formradioRight5">
                                                    Send Mail
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <?php if($i != 1) { ?>
                                    <td class="person-removal"><a class="btn btn-success">Delete</a></td>
                                    <?php } ?>
                                </tr>
                                <?php $i++; }
                                } else {
                                
                                
                                ?>
                                <tr id="1" class="product">
                                    <input type="hidden" id="row-count" value="1">
                                    <th scope="row" class="person-id">1</th>
                                    <td class="text-start col-3">
                                        <div class="mb-2">
                                            <input type="text" id="person_name_1" name="person_name[]" class="form-control" placeholder="Enter person name" required />
                                            <div class="invalid-tooltip">Please enter Person name</div>
                                        </div>
                                    </td>
                                    <td class="text-start col-3">
                                        <div class="mb-2">
                                            <?php
                                                echo form_dropdown('designation_id', $Designations, set_value('designation_id'), $designation_id);
                                            ?>
                                        </div>
                                    </td>
                                    <td class="text-start col-2">
                                        <div class="mb-2">
                                            <input type="text" id="person_email_1" name="person_email[]" class="form-control" placeholder="Enter email" required />
                                            <div class="invalid-tooltip">Please enter person email</div>
                                        </div>
                                    </td>
                                    <td class="text-start col-2">
                                        <div class="mb-2">
                                            <input type="text" id="person_mobile_1" name="person_mobile[]" class="form-control" placeholder="Enter mobile" required />
                                            <div class="invalid-tooltip">Please enter person mobile</div>
                                        </div>
                                    </td>
                                    <td class="text-start col-2">
                                        <div class="mb-2">
                                            <div class="form-check form-checkbox-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="is_send_mail[]" id="send_mail1" checked="" value="1">
                                                <label class="form-check-label" for="formradioRight5">
                                                    Send Mail
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tbody>
                                <tr id="newForm" style="display: none;"><td class="d-none" colspan="5"><p>Add New Form</p></td></tr>
                                <tr>
                                    <td colspan="5">
                                        <a href="javascript:add_person()" id="add-item" class="btn btn-soft-secondary fw-medium"><i class="ri-add-fill me-1 align-bottom"></i> Add Item</a>
                                        <button id="addRow" class="btn btn-primary open_master_popup" data-control="designation" method=""><i class="ri-add-fill me-1 align-bottom"></i> Add Designation</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--end table-->
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