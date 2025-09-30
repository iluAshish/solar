<style type="text/css">
.pull-right.buttom_rights.pos_btn {
    float: none !important;
    display: block;
    position: absolute;
    z-index: 111;
    top: 27px;
    left: 15px;
}
#DataTables_Table_0 {
    width: 100% !important;
}
.content.modal-content .span12 {
    position: relative;
}
</style>


                <div class="row g-3">
                    <div class="col-lg-6">
                        <div>
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Enter product name" value = '<?php echo (isset($data_info) && $data_info->product_name != "") ? $data_info->product_name : '' ?>' readonly />
                        </div>
                    </div>  
                    <div class="col-lg-6">
                        <div>
                            <label for="industry_type-field" class="form-label">Brand</label>
                            <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Enter product name" value = '<?php echo (isset($data_info) && $data_info->product_name != "") ? $data_info->brand_name : '' ?>' readonly />
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="model_number" class="form-label">Model Number</label>
                            <input type="text" id="model_number" name="model_number" class="form-control" placeholder="Enter model number" value = '<?php echo (isset($data_info) && $data_info->model_number != "") ? $data_info->model_number : '' ?>' readonly />
                            <div class="invalid-tooltip">Please enter modal number</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="hsn_code" class="form-label">HSN Code</label>
                            <input type="text" id="hsn_code" name="hsn_code" class="form-control" placeholder="Enter hsn code" value = '<?php echo (isset($data_info) && $data_info->hsn_code != "") ? $data_info->hsn_code : '' ?>' readonly />
                            <div class="invalid-tooltip">Please enter hsn code</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="basic_rate" class="form-label">Basic Rate</label>
                            <input type="text" id="basic_rate" name="basic_rate" class="form-control minVal" placeholder="Enter Rate" value = '<?php echo (isset($data_info) && $data_info->basic_rate != "") ? $data_info->basic_rate : '' ?>' readonly />
                            <div class="invalid-tooltip">Please enter basic rate</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="net_rate" class="form-label">Net Rate</label>
                            <input type="text" id="net_rate" name="net_rate" class="form-control" data-min="basic_rate" placeholder="Enter net rate" value = '<?php echo (isset($data_info) && $data_info->net_rate != "") ? $data_info->net_rate : '' ?>' readonly />
                            <div class="invalid-tooltip greter-tooltip">Please enter net rate</div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div>
                            <label for="gst" class="form-label">GST (%)</label>
                            <input type="text" id="gst" name="gst" class="form-control" placeholder="Enter gst" value = '<?php echo (isset($data_info) && $data_info->gst != "") ? $data_info->gst : '' ?>' readonly />
                            <div class="invalid-tooltip">Please enter gst</div>
                        </div>
                    </div>
                </div>

<!-- end table responsive -->



