<?php
$DataID = $this->PrimaryKey;

$projects = array("" => "Select Project") + $projects;
$project = array('name' => 'project_id', 'id' => 'project_id', 'class' => "form-select");

$products = array("" => "Select Product") + $products;
$product = array('name' => 'product_id', 'id' => 'product_id', 'class' => "form-select");


if (isset($data_info) && $data_info->$DataID > 0) {
    $data_id = array('name' => $DataID, 'id' => $DataID, 'value' => (isset($data_info) && $data_info->$DataID > 0) ? $data_info->$DataID : "", 'type' => 'hidden',);
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Add', 'class' => 'btn btn-success',);
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
                <h5 class="card-title mb-0"><?php echo $page_title;?></h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div>
                            <label for="project_id-field" class="form-label">Project</label>
                            <?php
                                echo form_dropdown('project_id', $projects, (isset($data_info) && $data_info->project_id != "") ? $data_info->project_id : set_value('project_id'), $project);
                            ?>
                            
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div>
                            <label for="product_id-field" class="form-label">Product</label>
                            <?php
                                echo form_dropdown('product_id', $products, (isset($data_info) && $data_info->pro_product_id != "") ? $data_info->pro_product_id : set_value('product_id'), $product);
                            ?>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="warranty" class="form-label">Warranty</label>
                            <input type="text" id="warranty" name="warranty" class="form-control minVal" placeholder="Enter Warranty" value = '<?php echo (isset($data_info) && $data_info->warranty != "") ? $data_info->warranty : set_value('warranty') ?>'  />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div>
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" id="quantity" name="quantity" class="form-control minVal" placeholder="Enter quantity" value = '<?php echo (isset($data_info) && $data_info->quantity != "") ? $data_info->quantity : set_value('quantity') ?>'  />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div>
                            <label for="watt_volt" class="form-label">Watt/volt</label>
                            <input type="text" id="watt_volt" name="watt_volt" class="form-control minVal" placeholder="Enter watt_volt" value = '<?php echo (isset($data_info) && $data_info->watt_volt != "") ? $data_info->watt_volt : set_value('watt_volt') ?>'  />
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