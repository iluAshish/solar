  <?php
$DataID = $this->PrimaryKey;
if (isset($data_info) && $data_info->$DataID > 0) {
    $data_id = array('name' => $DataID, 'id' => $DataID, 'value' => (isset($data_info) && $data_info->$DataID > 0) ? $data_info->$DataID : "", 'type' => 'hidden',);
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Add', 'class' => 'btn btn-success btn-cons',);
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
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Set Permission</h5>
                </div>
                <?php echo form_open_multipart(base_url($this->controllers.'/submit-role-form'), $form_attr); ?>
                <input type="hidden" name="role" value="<?php echo $role_id;?>">
                <div class="card-body py-4">
                    <div class="row g-3">
                        <div class="col-lg-12 mt-5 table-responsive">
                            <!--<h5 class="card-title mt-5">Permissions</h5> !-->
                            <table class="quotation-table table table-row-dashed table-nowrap mb-0">
                                <thead class="align-middle">
                                    <tr class="text-start text-muted fw-bold fs-7 gs-0">
                                        <th scope="col" class="fs-4 min-w-200">Module Name</th>
                                        <th scope="col" colspan="4" class="min-w-200 text-center fs-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="newlink">
                                    <?php 
                                    $i=0;
                                    foreach($modules as $module) { 
                                        $key = ($permissions) ? array_search($module, array_column($permissions, 'module_name')) : '';
                                    ?>
                                        <tr>
                                            <td><label class="col-form-label fw-bold fs-6"><?php echo ucwords($module);?></label>
                                                <input type="hidden" name="module_name[<?php echo $i;?>]" value="<?php echo $module;?>">
                                            </td>
                                            <td style="width: 60px;">
                                                <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input type="hidden" value="0" name="view[<?php echo $i;?>]">
                                                    <input class="form-check-input" name="view[<?php echo $i;?>]" type="checkbox" value="1" data-gtm-form-interact-field-id="0" <?php echo (($key != '') && $permissions[$key]->is_view == 1) ? 'checked' : '' ; ?>>
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        View
                                                    </span>
                                                </label>
                                            </td>
                                            <td style="width: 60px;">
                                                <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input type="hidden" value="0" name="insert[<?php echo $i;?>]">
                                                    <input class="form-check-input" name="insert[<?php echo $i;?>]" type="checkbox" value="1" data-gtm-form-interact-field-id="0" <?php echo (($key != '') && $permissions[$key]->is_add == 1) ? 'checked' : '' ; ?>>
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        Insert
                                                    </span>
                                                </label>
                                            </td>
                                            <td style="width: 60px;">
                                                <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input type="hidden" value="0" name="update[<?php echo $i;?>]">
                                                    <input class="form-check-input" name="update[<?php echo $i;?>]" type="checkbox" value="1" data-gtm-form-interact-field-id="0" <?php echo (($key != '') && $permissions[$key]->is_edit == 1) ? 'checked' : '' ; ?>>
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        Update
                                                    </span>
                                                </label>
                                            </td>
                                            <td style="width: 60px;">
                                                <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                    <input type="hidden" value="0" name="delete[<?php echo $i;?>]">
                                                    <input class="form-check-input" name="delete[<?php echo $i;?>]" type="checkbox" value="1" data-gtm-form-interact-field-id="0" <?php echo (($key != '') && $permissions[$key]->is_delete == 1) ? 'checked' : '' ; ?>>
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        Delete
                                                    </span>
                                                </label>
                                            </td>
                                        </tr>
                                    <?php 
                                    $i++;
                                    } ?>
                                </tbody>
                            </table>    
                        </div>
                    </div>    
                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light">Cancel</button>
                        <?php echo form_submit($submit_btn); ?>
                    </div>
                </div>
                </form>
            </div>
        </div>    
    </div>
</div>    