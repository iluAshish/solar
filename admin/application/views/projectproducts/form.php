<?php
$DataID = $this->PrimaryKey;

$projects = array("" => "Select Project") + $projects;
$project = array('name' => 'project_id', 'id' => 'project_id', 'class' => "form-select");

$projectsizes = array(""=> "Select Project size") + $projectsizes;
$projectsize = array('name' => 'size_id', 'id' => 'size_id', 'class' => "form-select");

$products = array("" => "Select Product") + $products;
$product = array('class' => "form-select");


// Only set $data_id if $data_info contains the primary key property
if (!empty($data_info) && !empty($data_info->id)) {

// if (isset($data_info) && $data_info->$DataID > 0) {
    $data_id = array('name' => $DataID, 'id' => $DataID, 'value' => (isset($data_info) && $data_info->$DataID > 0) ? $data_info->$DataID : "", 'type' => 'hidden',);
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Add', 'class' => 'btn btn-success',);
$reset_btn = array('name' => 'cancel_btn', 'id' => 'cancel_btn', 'content' => 'Cancel', 'type' => 'reset', 'class' => 'btn btn-default',);
$form_attr = array('class' => 'default_form needs-validation', 'id' => 'course_frm', 'name' => 'course_frm' , 'novalidate' => '');

?>

<style>
/* Keep table layout stable and enforce select/select2 widths */
.quotation-table { table-layout: fixed; width: 100%; }
.quotation-table td, .quotation-table th { vertical-align: middle; }
.quotation-table .form-select { width: 100% !important; min-width: 120px; }
.quotation-table .select2-container { width: 100% !important; }
.quotation-table .select2-container .select2-selection--single { height: calc(1.5em + 0.75rem + 2px) !important; }
</style>

<div class="row">
    <div class="col-lg-12">
        <?php echo form_open_multipart(base_url($this->controllers.'/submit_form'), $form_attr); ?>
        <?php
            // Only output the hidden primary key input when we actually prepared it above
            if (isset($data_id)) {
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
                            <label for="size_id-field" class="form-label">Project Size</label>
                            <?php
                                echo form_dropdown('size_id', $projectsizes, (isset($data_info) && $data_info->size_id != "") ? $data_info->size_id : set_value('size_id'), $projectsize);
                            ?>
                            
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="quotation-table table table-nowrap mb-0" style="table-layout:fixed;width:100%;">
                            <thead class="align-middle">
                                <tr>
                                    <th scope="col" style="width: 100px;">Product</th>
                                    <th scope="col" style="width: 50px;">Warranty</th>
                                    <th scope="col" style="width: 50px;">Quantity</th>
                                    <th scope="col" style="width: 50px;">Watt/volt</th>
                                    <th scope="col" style="width: 50px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="newlink">
                                <?php 
                                if (isset($price_data) && count($price_data) > 0) {
                                    $i = 1;    
                                    foreach ($price_data as $price) { 
                                ?>
                                    <tr id="<?php echo $i; ?>" class="product">

                                        <input type="hidden" name="row_id[]" value="<?php echo isset($price->id) ? $price->id : ''; ?>">

                                        <td>
                                            <?php
                                                // Render dropdown with explicit attribute string so name stays as product_id[]
                                                $product_attr = 'class="form-select" data-control="select2" style="width:100%;"';
                                                echo form_dropdown(
                                                    'product_id[]',
                                                    $products,
                                                    (isset($price->product_id) && $price->product_id != "") ? $price->product_id : set_value('product_id'),
                                                    $product_attr
                                                );
                                            ?>
                                        </td>

                                        <td>
                                            <input type="text" id="warranty_<?php echo $i; ?>" name="warranty[]" class="form-control"
                                                placeholder="Enter Warranty"
                                                value="<?php echo isset($price->warranty) ? $price->warranty : set_value('warranty'); ?>" />
                                        </td>

                                        <td>
                                            <input type="text" id="quantity_<?php echo $i; ?>" name="quantity[]" class="form-control"
                                                placeholder="Enter Quantity"
                                                value="<?php echo isset($price->quantity) ? $price->quantity : set_value('quantity'); ?>" />
                                        </td>

                                        <td>
                                            <input type="text" id="watt_volt_<?php echo $i; ?>" name="watt_volt[]" class="form-control"
                                                placeholder="Enter Watt/Volt"
                                                value="<?php echo isset($price->watt_volt) ? $price->watt_volt : set_value('watt_volt'); ?>" />
                                        </td>

                                        <td class="text-center">
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm remove-row">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php 
                                    $i++; 
                                    } 
                                } else { 
                                ?>
                                    <tr>
                                        <td>
                                            <?php $product_attr = 'class="form-select" data-control="select2" style="width:100%;"'; echo form_dropdown('product_id[]', $products, set_value('product_id'), $product_attr); ?>
                                        </td>

                                        <td>
                                            <input type="text" name="warranty[]" class="form-control" placeholder="Enter Warranty" />
                                        </td>

                                        <td>
                                            <input type="text" name="quantity[]" class="form-control" placeholder="Enter Quantity" />
                                        </td>

                                        <td>
                                            <input type="text" name="watt_volt[]" class="form-control" placeholder="Enter Watt/Volt" />
                                        </td>

                                        <td class="text-center">
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm remove-row">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>


                            <tfoot>
                                <tr id="newForm" style="display: none;"><td class="d-none" colspan="5"><p>Add New Form</p></td></tr>
                                <tr>
                                    <td colspan="5">
                                        <a href="javascript:new_link_product()" id="add-item" class="btn btn-primary"><i class="ki-duotone ki-plus-square fs-3">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
                                                <span class="path3"></span>
                                                <span class="path3"></span>
											</i> Add Product</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- row count (kept outside table to avoid breaking table layout) -->
                        <input type="hidden" id="row-count" value="<?php echo isset($price_data) && count($price_data) > 0 ? count($price_data) : 1; ?>">

                        <!-- Hidden Product Row Template (use <template> so cloning preserves nodes and avoids layout glitches) -->
                        <template id="product-row-template">
                            <tr class="product-row">
                                <input type="hidden" name="row_id[]" value="">

                                <td>
                                    <?php $product_attr = 'class="form-select product-select" data-control="select2" style="width:100%;"'; echo form_dropdown('product_id[]', $products, '', $product_attr); ?>
                                </td>
                                <td>
                                    <input type="text" name="warranty[]" class="form-control" placeholder="Enter Warranty" />
                                </td>
                                <td>
                                    <input type="text" name="quantity[]" class="form-control" placeholder="Enter Quantity" />
                                </td>
                                <td>
                                    <input type="text" name="watt_volt[]" class="form-control" placeholder="Enter Watt/Volt" />
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm remove-row">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </template>
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