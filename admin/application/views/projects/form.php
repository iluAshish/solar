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
                <h5 class="card-title mb-0">Add Project</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!--<div class="col-lg-6">
                        <div>
                            <label for="franchisee_id" class="form-label">Franchisee</label>
                            <select class="form-select select-change" name="franchisee_id" id="franchisee_id" data-control="franchisee" data-name="client">
                                <option>Select franchisee</option>
                                <?php foreach($franchisees as $key=>$value) { ?>
                                <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->franchisee_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="client_id" class="form-label">Client</label>
                            <select class="form-select" name="client_id" id="client_id">
                                <option>Select Client</option>
                                <?php if(isset($data_info)) { 
                                    foreach($clients as $key=>$value) { ?>
                                <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->client_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                <?php } 
                                } ?>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-lg-6">
                        <div>
                            <label for="project_name" class="form-label">Project Name</label>
                            <input type="text" id="project_name" name="project_name" class="form-control" placeholder="Enter Project name" required value = '<?php echo (isset($data_info) && $data_info->project_name != "") ? $data_info->project_name : set_value('project_name') ?>'/>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div>
                            <label for="project_type" class="form-label">Project Type</label>
                            <select class="form-select" name="project_type" id="project_type">
                                <option>Select Type</option>
                                <option value="RESIDENTIAL" <?php echo (isset($data_info) && $data_info->project_type == "RESIDENTIAL") ? 'selected' : ''; ?> >RESIDENTIAL</option>
                                <option value="COMMERCIAL" <?php echo (isset($data_info) && $data_info->project_type == "COMMERCIAL") ? 'selected' : ''; ?>>COMMERCIAL</option>
                            </select>
                        </div>
                    </div> -->
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" name="description" class="form-control" placeholder="Enter description" required  value = '<?php echo (isset($data_info) && $data_info->description != "") ? $data_info->description : set_value('description') ?>'/>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div>
                            <label for="project_status" class="form-label">Project Status</label>
                            <select class="form-select" name="project_status" id="project_status">
                                <option>Select Status</option>
                                <option value="Completed" <?php echo (isset($data_info) && $data_info->project_status == "Completed") ? 'selected' : ''; ?> >Completed</option>
                                <option value="Running" <?php echo (isset($data_info) && $data_info->project_status == "Running") ? 'selected' : ''; ?>>Running</option>
                            </select>
                        </div>
                    </div> -->
                    
                    <div class="table-responsive">
                        <table class="quotation-table table table-nowrap mb-0">
                            <thead class="align-middle">
                                <tr>
                                    <th scope="col" style="width: 80px;">Size</th>
                                    <th scope="col" style="width: 50px;">Price</th>
                                    <th scope="col" style="width: 250px;">Specification</th>
                                    <th scope="col" style="width: 50px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="newlink">
                                <?php if(isset($price_data) && count($price_data) > 0) {
                                $i=1;    
                                foreach($price_data as $price) { 
                                ?>
                                    <tr id="<?php echo $i;?>" class="product"> 
                                    <?php if(count($price_data) == $i) { ?>
                                    <input type="hidden" id="row-count" class="row-count" value="<?php echo $i;?>">
                                    <?php } ?>
                                    <td style="padding-left:0px;">
                                        <input type="text" class="form-control mb-2 mb-md-0 quantity" placeholder="Enter Size" name="size[]" value="<?php echo $price->size_range;?>" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control mb-2 mb-md-0 rate" placeholder="Enter rate" name="price[]" value="<?php echo $price->price;?>" readonly  />
                                    </td>
                                    <td>
                                        <input type="text" id="specification" name="specification[]" class="form-control" placeholder="Enter specification" value="<?php echo $price->description;?>" required readonly />
                                    </td>    
                                    
                                <?php $i++; }
                                } else {
                                ?>                                    
                                <tr>
                                    <input type="hidden" id="row-count" value="1">
                                    <td style="padding-left:0px;">
                                        <input type="text" class="form-control mb-2 mb-md-0 size" placeholder="Enter Size" name="size[]" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control mb-2 mb-md-0 price" placeholder="Enter rate" name="price[]"  />
                                    </td>
                                    <td>
                                        <input type="text" id="specification" name="specification[]" class="form-control" placeholder="Enter specification" />
                                    </td>    
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr id="newForm" style="display: none;"><td class="d-none" colspan="5"><p>Add New Form</p></td></tr>
                                <tr>
                                    <td colspan="5">
                                        <a href="javascript:new_link()" id="add-item" class="btn btn-primary"><i class="ki-duotone ki-plus-square fs-3">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i> Add Price</a>
                                    </td>
                                </tr>
                            </tfoot>
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
        </div>
        </form>
    </div>
</div>    