<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">

            <div class="row g-4 gx-xl-6 mb-20">
                <!--begin::Col-->
                <div class="col-md-4">
                    <!--begin::Card widget 11-->
                    <div style="background-color: #F6E5CA" class="card card-flush h-xl-80">  
                        <!--begin::Header-->
                        <div class="card-header flex-nowrap pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">            
                                <span class="card-label fw-bold fs-4 text-gray-800">Balance</span>
                                <span class="mt-1 fw-semibold fs-7" style="color: ">36,668</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                    
                        <!--begin::Body-->
                        <div class="card-body text-center pt-5">     
                            <!--begin::Image-->                         
                            <img src="/metronic8/demo1/assets/media/svg/shapes/bitcoin.svg" alt="" class="h-80x mb-5">                  
                            <!--end::Image-->
                                        
                            <!--begin::Section-->
                            <div class="text-start">            
                                <span class="d-block fw-bold fs-1 text-gray-800">0.44554576 Debit</span>
                                <span class="mt-1 fw-semibold fs-3" style="color: ">19,335,45 Credit</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 11-->
                 </div>
                <!--end::Col-->   
            
                <!--begin::Col-->
                <div class="col-md-4">
                    <!--begin::Card widget 11-->
                    <div class="card card-flush h-xl-80" style="background-color: #F3D6EF">  
                    <!--begin::Header-->
                    <div class="card-header flex-nowrap pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">            
                            <span class="card-label fw-bold fs-4 text-gray-800">Withdraw</span>
                            <span class="mt-1 fw-semibold fs-7" style="color: ">325,035 USD for 1 ETH</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body text-center pt-5">     
                        <!--begin::Image-->                         
                        <img src="/metronic8/demo1/assets/media/svg/shapes/ethereum.svg" class="h-80x mb-5" alt="">                  
                        <!--end::Image-->
                                    
                        <!--begin::Section-->
                        <div class="text-start">            
                            <span class="d-block fw-bold fs-1 text-gray-800">29.33460000 ETH</span>
                            <span class="mt-1 fw-semibold fs-3" style="color: ">7,336,00 USD</span>
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card widget 11-->
             </div>
                <!--end::Col-->  
            
                <!--begin::Col-->
                <div class="col-md-4">
                    <!--begin::Card widget 11-->
                    <div class="card card-flush h-xl-80" style="background-color: #BFDDE3">  
                    <!--begin::Header-->
                    <div class="card-header flex-nowrap pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">            
                            <span class="card-label fw-bold fs-4 text-gray-800">Purchase</span>
                            <span class="mt-1 fw-semibold fs-7" style="color: ">0.12,045 USD for 1 DOGE</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
    
                    <!--begin::Body-->
                    <div class="card-body text-center pt-5">     
                        <!--begin::Image-->                         
                        <img src="/metronic8/demo1/assets/media/svg/shapes/dogecoin.svg" class="h-80x mb-5" alt="">                  
                        <!--end::Image-->
                                    
                        <!--begin::Section-->
                        <div class="text-start">            
                            <span class="d-block fw-bold fs-1 text-gray-800">4703.7589 DOGE</span>
                            <span class="mt-1 fw-semibold fs-3" style="color: ">503,005,56 USD</span>
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card widget 11-->
                 </div>
                <!--end::Col-->         
            </div>		    
		    
		    <?php
                add_edit_form();
            ?>
		    
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
					    <h2>Manage Wallet</h2>
					</div>    
				    <div class="card-toolbar">
						<!--begin::Toolbar-->
						<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
							<a href="javascript:;" class="withdraw-btn btn btn-light-success mr-4" style="margin-right:1em !important">Withdraw</a>
							<button type="button" class="btn btn-light-primary open_my_form_form" data-control="wallet"><i class="ki-duotone ki-plus-square fs-3">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>Add Money</button>
							<!--end::Add customer-->
						</div>
						<!--end::Toolbar-->
					</div>
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body py-4">
					<!--begin::Table-->
					<table class="table align-middle table-row-dashed fs-6 gy-5 common_datatable" data-control="payments" data-mathod="manage">
						<thead>
							<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
								<th class="min-w-125px">Franchisee</th>
								<th class="min-w-125px">Client</th>
								<th class="min-w-125px">Quotation</th>
								<th class="min-w-125px">Payment Mode</th>
								<th class="min-w-125px">Amount</th>
								<th class="text-end min-w-100px">Actions</th>
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-semibold">
						</tbody>
					</table>
					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
<!--end::Content-->