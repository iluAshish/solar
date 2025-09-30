		<!--begin::Javascript-->
		<script>var BASE_URL = "<?php echo base_url()?>";</script>
		<script>var hostUrl = "<?php echo base_url()?>assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?php echo base_url()?>assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo base_url()?>assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="<?php echo base_url()?>assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="<?php echo base_url()?>assets/js/widgets.bundle.js"></script>
		<script src="<?php echo base_url()?>assets/js/custom/widgets.js"></script>
		<script src="<?php echo base_url()?>assets/js/custom/apps/chat/chat.js"></script>
		<!--end::Custom Javascript-->
		<!--begin::Vendors Javascript(used for this page only)-->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <!--<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
		<!--end::Vendors Javascript-->
		<script src="https://sdk.cashfree.com/js/ui/2.0.0/cashfree.sandbox.js"></script>
        <script src="<?php echo base_url()?>assets/custom/js/custom-for-all.js?v=69"></script>
        <script src="<?php echo base_url()?>assets/custom/js/invoice.js?v=56"></script>
        <script src="<?php echo base_url()?>assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
        
        <script>
            <?php if (isset($paymentResponse[0]['payment_status']) && $paymentResponse[0]['payment_status'] === 'SUCCESS') { ?>
                toastr.success('Payment Successful');
                // Update your database, send confirmation email, etc.
            <?php } else if (isset($paymentResponse[0]['payment_status']) && $paymentResponse[0]['payment_status'] !== 'SUCCESS') { ?>
                toastr.success('Payment Failed');
            <?php } ?>
            
            $('.ckeditor-classic').each(function(){
                var id = $(this).attr("id");
                ClassicEditor.create(document.querySelector( '#' + id ))
                .then(function (editor) {
                    editor.ui.view.editable.element.style.height = '200px';
                })
                .catch(function (error) {
                    console.error(error);
                });
            });
            
            var start = moment().subtract(29, "days");
            var end = moment();
            
            function cb(start, end) {
                $("#kt_daterangepicker_1").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
            }
            
            $("#kt_daterangepicker_1").daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, cb);
            
            cb(start, end);
            

        </script>
		<!--end::Javascript-->
	</body>
	
	<!-- Default Modals -->
    <div id="price_details" class="modal fade modal-lg" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Price Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body" id="price-data">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
    
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->   



    <div class="modal fade" id="payment_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    	<!--begin::Modal dialog-->
    	<div class="modal-dialog modal-dialog-centered mw-750px">
    		<!--begin::Modal content-->
    		<div class="modal-content">
    			<!--begin::Modal header-->
    			<div class="modal-header">
    				<!--begin::Modal title-->
    				<h2 class="fw-bold">Payment</h2>
    				<!--end::Modal title-->
    				<!--begin::Close-->
    				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
    					<i class="ki-duotone ki-cross fs-1">
    						<span class="path1"></span>
    						<span class="path2"></span>
    					</i>
    				</div>
    				<!--end::Close-->
    			</div>
    			<!--end::Modal header-->
    			<!--begin::Modal body-->
    			<div class="modal-body scroll-y mx-3 my-4">
    				<!--begin::Form-->
    				<form id="payment_form" class="form fv-plugins-bootstrap5 fv-plugins-framework payment_form" action="<?php echo base_url().'payments/submitOrder';?>">
    					<input type="hidden" id="pf_order_id" name="pf_order_id" class="form-control" required />
    					<div class="row g-3">
                            <div class="col-lg-7">
                                <div>
                                    <label for="pf_total_amount" class="form-label">Pending Amount</label>
                                    <div class="input-group">
                                        <input type="text" id="pf_total_amount" name="pf_total_amount" class="form-control" readonly required />
                                    </div>    
                                </div>
                            </div>  
                            <div class="col-lg-5">
                                <div>
                                    <label for="pf_amount" class="form-label">Amount</label>
                                    <input type="text" id="pf_amount" name="pf_amount" class="form-control" placeholder="Enter Amount" required />
                                </div>
                            </div>
                        </div>
    					<!--begin::Actions-->
    					<div class="text-center pt-15">
    						<button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
    						<button type="submit" class="btn btn-primary">
    							<span class="indicator-label">Pay now</span>
    							<span class="indicator-progress">Please wait... 
    							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    						</button>
    					</div>
    					<!--end::Actions-->
    				</form>
    				<!--end::Form-->
    			</div>
    			<!--end::Modal body-->
    		</div>
    		<!--end::Modal content-->
    	</div>
    	<!--end::Modal dialog-->
    </div>
    
    <div class="modal fade" id="withdraw_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    	<!--begin::Modal dialog-->
    	<div class="modal-dialog modal-dialog-centered mw-750px">
    		<!--begin::Modal content-->
    		<div class="modal-content">
    			<!--begin::Modal header-->
    			<div class="modal-header">
    				<!--begin::Modal title-->
    				<h2 class="fw-bold">Payment</h2>
    				<!--end::Modal title-->
    				<!--begin::Close-->
    				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
    					<i class="ki-duotone ki-cross fs-1">
    						<span class="path1"></span>
    						<span class="path2"></span>
    					</i>
    				</div>
    				<!--end::Close-->
    			</div>
    			<!--end::Modal header-->
    			<!--begin::Modal body-->
    			<div class="modal-body scroll-y mx-3 my-4">
    				<!--begin::Form-->
    				<form id="payment_form" class="form fv-plugins-bootstrap5 fv-plugins-framework withdraw_form" action="<?php echo base_url().'payments/submitOrder';?>">
    					<div class="row g-3">
                            <div class="col-lg-7">
                                <div>
                                    <label for="wallet_amount" class="form-label">Wallet Amount</label>
                                    <div class="input-group">
                                        <input type="text" id="wallet_amount" name="wallet_amount" class="form-control" readonly required />
                                    </div>    
                                </div>
                            </div>  
                            <div class="col-lg-5">
                                <div>
                                    <label for="withdraw_amount" class="form-label">Amount</label>
                                    <input type="text" id="withdraw_amount" name="withdraw_amount" class="form-control" placeholder="Enter Amount" required />
                                </div>
                            </div>
                        </div>
    					<!--begin::Actions-->
    					<div class="text-center pt-15">
    						<button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
    						<button type="submit" class="btn btn-primary">
    							<span class="indicator-label">Widthdraw</span>
    							<span class="indicator-progress">Please wait... 
    							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    						</button>
    					</div>
    					<!--end::Actions-->
    				</form>
    				<!--end::Form-->
    			</div>
    			<!--end::Modal body-->
    		</div>
    		<!--end::Modal content-->
    	</div>
    	<!--end::Modal dialog-->
    </div>
    
    
	
	<!--end::Body-->
</html>