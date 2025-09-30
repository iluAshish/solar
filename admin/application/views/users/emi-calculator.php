<?php
$submit_btn = array('name' => 'submit_btn', 'id' => 'submit_btn', 'value' => 'Add', 'class' => 'btn btn-success',);
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
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
					    <h2>EMI Calculator</h2>
					</div>    
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
                <?php echo form_open_multipart(base_url($this->controllers.'/submit-form'), $form_attr); ?>
				<div class="card-body py-4">
                <?php
                    if (isset($data_info) && $data_info->$DataID > 0) {
                        echo form_input($data_id);
                    }
                ?>
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter amount" required />
                            </div>
                        </div>  
                        
                        <div class="col-lg-6">
                            <div>
                                <label for="rate" class="form-label">Interest Rate</label>
                                <input type="number" id="rate" name="rate" class="form-control" placeholder="Enter rate" required  />
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div>
                                <label for="tenture" class="form-label">Tenture</label>
                                <input type="number" id="tenture" name="tenture" class="form-control" placeholder="Enter tenture in months" required  />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="emi_amount" class="form-label">EMI Amount</label>
                                <input type="number" id="emi_amount" name="emi_amount" class="form-control" placeholder="Enter emi amount" required readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light">Cancel</button>
                        <button type="button" class="btn btn-success" id="calculate-emi-btn">Calculate</button>
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