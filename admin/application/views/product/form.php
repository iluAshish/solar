<?php
$DataID = $this->PrimaryKey;
$categories = array("" => "Select Category") + $categories;
$category = array('name' => 'category_id', 'id' => 'category_id', 'class' => "form-select");

$brands = array("" => "Select Brand") + $brands;
$brand = array('name' => 'brand_id', 'id' => 'brand_id', 'class' => "form-select");


$old_Image = array('name' => 'old_Image', 'id' => 'old_Image', 'value' => (isset($data_info) && $data_info->product_image != "") ? $data_info->product_image : '', 'type' => "hidden",);

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
                <h5 class="card-title mb-0">Add Product</h5>
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
                                    <input class="form-control d-none" value="" name="Image" id="company-logo-input" type="file" accept="image/png, image/gif, image/jpeg">
                                </div>
                                <div class="avatar-lg p-1">
                                    <div class="avatar-title bg-light rounded-circle">
                                        <?php
                                        /*if (!empty($data_info->product_image)) {
                                            echo '<img src="' . UPLOAD_DIR . PRODUCT_DIR . $data_info->product_image . '" class="avatar-md rounded-circle object-fit-cover remove_image1" data-id="' . $data_info->product_image . '"/ >';
                                            echo form_input($old_Image);
                                        } else {
                                        ?>
                                            <img src="assets/images/users/multi-user.jpg" id="companylogo-img" class="avatar-md rounded-circle object-fit-cover" />
                                        <?php } */ ?>
                                    </div>
                                </div>
                            </div>
                            <h5 class="fs-13 mt-3">Product Image</h5>
                        </div>
                    </div> -->
                    <div class="col-lg-6">
                        <div>
                            <label for="industry_type-field" class="form-label">Category</label>
                            <?php
                                echo form_dropdown('category_id', $categories, (isset($data_info) && $data_info->category_id != "") ? $data_info->category_id : set_value('category_id'), $category);
                            ?>
                            <!--<div class="col-lg-11" style="display:inline-block">
                            </div>
                            <div class="col-lg-1" style="display:inline;"><button id="addRow" class="btn btn-sm btn-primary open_master_popup" data-control="brand" method=""><i class="ri-add-fill me-1 align-bottom"></i></button></div>-->
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div>
                            <label for="industry_type-field" class="form-label">Brand</label>
                            <?php
                                echo form_dropdown('brand_id', $brands, (isset($data_info) && $data_info->brand_id != "") ? $data_info->brand_id : set_value('brand_id'), $brand);
                            ?>
                            <!--<div class="col-lg-11" style="display:inline-block">
                            </div>
                            <div class="col-lg-1" style="display:inline;"><button id="addRow" class="btn btn-sm btn-primary open_master_popup" data-control="brand" method=""><i class="ri-add-fill me-1 align-bottom"></i></button></div>-->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Enter product name" value = '<?php echo (isset($data_info) && $data_info->product_name != "") ? $data_info->product_name : set_value('product_name') ?>' required />
                        </div>
                    </div>  
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="price" class="form-label">Price</label>
                            <input type="text" id="price" name="price" class="form-control" placeholder="Enter price" value = '<?php echo (isset($data_info) && $data_info->price != "") ? $data_info->price : set_value('price') ?>' />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="franchisee_price" class="form-label">Franchisee Price</label>
                            <input type="text" id="franchisee_price" name="franchisee_price" class="form-control" placeholder="Enter Franchisee Price" value = '<?php echo (isset($data_info) && $data_info->franchisee_price != "") ? $data_info->franchisee_price : set_value('franchisee_price') ?>' required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="warranty" class="form-label">Warranty</label>
                            <input type="text" id="warranty" name="warranty" class="form-control minVal" placeholder="Enter Warranty" value = '<?php echo (isset($data_info) && $data_info->warranty_years != "") ? $data_info->warranty_years : set_value('warranty') ?>'  />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="availability" class="form-label">Availability</label>
                            <select class="form-select" name="availability" id="availability">
                                <option>Select franchisee</option>
                                <option value="IN STOCK" <?php echo (isset($data_info) && $data_info->availability == 'IN STOCK') ? 'selected' : ''; ?>>IN STOCK</option>
                                <option value="OUT OF STOCK" <?php echo (isset($data_info) && $data_info->availability == 'OUT OF STOCK') ? 'selected' : ''; ?> >OUT OF STOCK</option>
                                <option value="DISCONTINUED" <?php echo (isset($data_info) && $data_info->availability == 'DISCONTINUED') ? 'selected' : ''; ?> >DISCONTINUED</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="making" class="form-label">Making</label>
                            <input type="text" id="making" name="making" class="form-control minVal" placeholder="Enter making" value = '<?php echo (isset($data_info) && $data_info->making != "") ? $data_info->making : set_value('making') ?>'  />
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="quantity" class="form-label">Quantity / Size</label>
                            <input type="text" id="quantity" name="quantity" class="form-control minVal" placeholder="Enter quantity" value = '<?php echo (isset($data_info) && $data_info->quantity != "") ? $data_info->quantity : set_value('quantity') ?>'  />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div>
                            <label for="description" class="form-label">Details</label>
                            <input type="text" id="description" name="description" class="form-control ckeditor-classic" placeholder="Enter description" value = '<?php echo (isset($data_info) && $data_info->description != "") ? $data_info->description : set_value('description') ?>' />
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