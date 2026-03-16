<?php
// view: quotation_form.php (replace your existing form view with this)
?>
<script>
var Products = [];
Products = '<?php echo json_encode($products);?>';
Products = JSON.parse(Products);
var base_url = '<?php echo base_url(); ?>';
</script>

<?php
$DataID = $this->PrimaryKey;
$Products = array("" => "Select Product") + $products;

$projectsizes = array(""=> "Select Project size") + $projectsizes;
// NOTE: we use array names with [] for multi-row fields in the table

if (isset($data_info) && !empty($data_info->$DataID)) {
    $data_id = array(
        'name' => $DataID,
        'id'   => $DataID,
        'value'=> $data_info->$DataID,
        'type' => 'hidden',
    );
}

$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Save', 'class' => 'btn btn-success',);
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
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<div class="card-title">
					    <h2>Add Quotation</h2>
					</div>
				</div>
				<!--begin::Card body-->
                <?php echo form_open_multipart(base_url($this->controllers.'/submit_form'), $form_attr); ?>
				<div class="card-body py-4">
                <?php
                    if (isset($data_id)) {
                        echo form_input($data_id);
                    }
                ?>
                    <!-- block 1 -->
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="qauote_date" class="form-label">Date</label>
                                <input type="text" id="qauote_date" name="qauote_date" class="form-control date-field" placeholder="Enter date" value="<?php echo (isset($data_info) && $data_info->qauote_date != '') ? date('d-m-Y', strtotime($data_info->qauote_date)) : ''; ?>" required data-provider="flatpickr" data-date-format="d-m-Y" readonly/>
                                <div class="invalid-tooltip">Please enter date</div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div>
                                <label for="reference_no" class="form-label">Reference Number</label>
                                <input type="text" id="reference_no" name="reference_no" class="form-control" placeholder="Enter reference number" value = '<?php echo (isset($data_info) && $data_info->reference_no != "") ? $data_info->reference_no : $ref_no; ?>' required  />
                                <div class="invalid-tooltip">Please enter refrence no</div>
                            </div>
                        </div>

                        <?php if($role == 1 or $role == 2 or $role == 5) { ?>
                        <div class="col-lg-6">
                            <div>
                                <label for="franchisee_id" class="form-label">Franchisee</label>
                                <select class="form-select select-change" name="franchisee_id" id="franchisee_id" data-control="user" data-name="client">
                                    <option value="">Select franchisee</option>
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
                                    <option value="0">Select Client</option>
                                    <?php if(isset($data_info)) {
                                        foreach($clients as $key=>$value) { ?>
                                    <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->client_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-6">
                            <div>
                                <label for="client_id" class="form-label">Client</label>
                                <select class="form-select" name="client_id" id="client_id">
                                    <option value="0">Select Client</option>
                                    <?php if(isset($data_info) or isset($clients)) {
                                        foreach($clients as $key=>$value) { ?>
                                    <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->client_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="col-lg-6">
                            <div>
                                <label for="vendor_id" class="form-label">Vendors</label>
                                <select class="form-select" name="vendor_id" id="vendor_id">
                                    <option value="0">Select Vendor</option>
                                    <?php  foreach($vendors as $key=>$value) { ?>
                                    <option value="<?php echo $key;?>" <?php echo (isset($data_info) && $data_info->vendor_id == $key) ? 'selected' : ''; ?>><?php echo $value;?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!--end block 1 -->

                    <div class="row g-3 mt-4">
                        <div class="table-responsive">
                        <table class="quotation-table table table-nowrap mb-0">
                            <thead class="align-middle">
                                <tr>
                                    <th scope="col" style="width: 250px;">Project Name</th>
                                    <th scope="col" style="width: 100px;">Size Range</th>
                                    <th scope="col" style="width: 150px;">Rate / KW</th>
                                    <th scope="col" style="width: 100px;">Quantity</th>
                                    <th scope="col" style="width: 100px;">Amount</th>
                                </tr>
                            </thead>
                            <tbody id="newlink">
                                <?php
                                if (isset($quote_prod) && count($quote_prod) > 0) {
                                    $i = 1;
                                    foreach ($quote_prod as $prod_data) {
                                ?>
                                    <tr data-row="<?php echo $i;?>" class="product-row">
                                        <!-- existing row hidden id so backend updates by PK -->
                                        <input type="hidden" name="row_id[]" value="<?php echo isset($prod_data->id) ? $prod_data->id : ''; ?>">

                                        <td style="padding-left:0px;">
                                            <select class="form-select" name="project_id[]" id="project_id" data-control="Projectproducts">
                                                <option value="">Select Project</option>
                                                <?php
                                                if (isset($projects) && is_array($projects)) {
                                                    foreach ($projects as $key => $value) {
                                                        $sel = (isset($prod_data->project_id) && (int)$prod_data->project_id === (int)$key) ? ' selected' : '';
                                                        echo '<option value="'.htmlspecialchars($key).'"'. $sel . '>'.htmlspecialchars($value).'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>

                                        <td>
                                            <?php
                                                $selected_size = isset($prod_data->size_id) ? $prod_data->size_id : set_value('size_id');

                                                // IMPORTANT: convert attributes to proper format for multi rows
                                                $attr = array(
                                                    'name'  => 'size_id[]',
                                                    'class' => 'form-select size-ranges-qutation',
                                                    'data-control'=>'Projectproducts'

                                                );

                                                echo form_dropdown('size_id[]', $projectsizes, $selected_size, $attr);
                                            ?>
                                        </td>


                                        <td>
                                            <input type="text" class="form-control mb-2 mb-md-0 rate" placeholder="Enter rate" name="rate[]" value="<?php echo isset($prod_data->basic_rate) ? $prod_data->basic_rate : ''; ?>" readonly />
                                        </td>

                                        <td>
                                            <input type="number" step="1" class="form-control mb-2 mb-md-0 quantity" value="<?php echo isset($prod_data->qty) ? $prod_data->qty : '1'; ?>" placeholder="Enter quantity" name="qty[]" min="0" readonly/>
                                            <span class="qty_error text-error"></span>
                                        </td>

                                        <td>
                                            <input type="text" name="amount[]" class="form-control amount" placeholder="Enter amount" value="<?php echo isset($prod_data->amount) ? $prod_data->amount : ''; ?>" readonly />
                                        </td>
                                    </tr>
                                <?php
                                        $i++;
                                    } // end foreach existing
                                } else {
                                    // single blank row for create
                                ?>
                                    <tr data-row="1" class="product-row">
                                        <input type="hidden" name="row_id[]" value="">
                                        <td style="padding-left:0px;">
                                            <select class="form-select" name="project_id[]" id="project_id" data-control="Projectproducts">
                                                <option value="">Select Project</option>
                                                <?php foreach ($projects as $key => $value) {
                                                    echo '<option value="'.htmlspecialchars($key).'">'.htmlspecialchars($value).'</option>';
                                                } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                                $selected_size = isset($prod_data->size_id) ? $prod_data->size_id : set_value('size_id');

                                                // IMPORTANT: convert attributes to proper format for multi rows
                                                $attr = array(
                                                    'name'  => 'size_id[]',
                                                    'class' => 'form-select size-ranges-qutation',
                                                    'data-control'=>'Projectproducts'
                                                );

                                                echo form_dropdown('size_id[]', $projectsizes, $selected_size, $attr);
                                            ?>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control mb-2 mb-md-0 rate" placeholder="Enter rate" name="rate[]" value="" readonly />
                                            <span class="rate_error text-error"></span>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control mb-2 mb-md-0 quantity" value="1" placeholder="Enter quantity" name="qty[]" mix="99999" min="1" readonly/>
                                        <span class="qty_error text-error"></span>
                                        </td>
                                        <td>
                                            <input type="text" name="amount[]" class="form-control amount" placeholder="Enter amount" value = '' readonly />
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- notes -->
                <div class="mt-4">
                    <label for="quote_note" class="form-label text-muted text-uppercase fw-semibold">NOTES</label>
                    <textarea id="quote_note" name="quote_note" class="form-control alert alert-info ckeditor-classic" placeholder="Enter quotation note" ><?php echo (isset($data_info) && $data_info->quote_notes != "") ? $data_info->quote_notes : $settings->quote_note; ?></textarea>
                </div>

                <div class="mt-4">
                    <label for="quote_terms" class="form-label text-muted text-uppercase fw-semibold">Terms and Conditions</label>
                    <textarea id="quote_terms" name="quote_terms" class="form-control alert alert-info ckeditor-classic" placeholder="Enter quotation note" ><?php echo (isset($data_info) && $data_info->quote_terms != "") ? $data_info->quote_terms : $settings->quote_terms; ?></textarea>
                </div>

                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light">Cancel</button>
                        <?php echo form_submit($submit_btn); ?>
                    </div>
                </div>

                </form>
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
<!--end::Content-->

<!-- ======= JS: triggers & calc ======= -->
<script>
/*
  1) When either project_id[] or project_prices[] changes -> call get_size_price(project_id, size_id)
     endpoint must return JSON { status: 'ok', price: <number>, from_size, to_size }
  2) When .quantity changes -> recalc .amount = qty * rate
  3) Works per-row (closest tr)
*/



// qty change -> recalc
$(document).on("keyup change", ".quantity", function() {
    var $row = $(this).closest("tr");
    var qty = parseFloat($(this).val()) || 0;
    var rate = parseFloat($row.find(".rate").val()) || 0;
    $row.find(".amount").val((qty * rate).toFixed(2));
});

// If you dynamically add rows via your existing new_link_product() or other code,
// make sure new row contains:
//   <input type="hidden" name="row_id[]" value="">
//   <select name="project_id[]">...</select>
//   <select name="project_prices[]">...</select>
//   <input name="rate[]" class="rate" readonly>
//   <input name="qty[]" class="quantity">
//   <input name="amount[]" class="amount" readonly>
//
// The above event handlers are delegated, so they work for dynamic rows as well.
</script>
