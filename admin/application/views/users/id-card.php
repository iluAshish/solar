<style type="text/css">
   /*.row{ page-break-inside:avoid; page-break-after:auto } */
   @media print {
        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    }
    .row {
      overflow: hidden;
      position: relative;
    }
    
    .demo-bg {
      opacity: 0.2;
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      padding: 0;
    }    

</style>


	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<!--begin::Container-->
			<div id="kt_content_container" class="container-xxl">
				<!--begin::Home card-->
				<div class="card" style="border:none;box-shadow: none;">
					<!--begin::Body-->
					<div class="card-body p-lg-20">
						<!--begin::Section-->
						<div class="mb-17">
							<!--begin::Row-->
							<div class="row px-4" style="border: 1px solid var(--bs-card-border-color);border-radius: 15px;">
							    <img class="demo-bg" src="<?php echo base_url()?>assets/media/visiting-card-bg.png" alt="">
								<!--begin::Col-->
								<div class="col-4" style="border-right: #1B84FF 15px solid;">
									<!--begin::Feature post-->
									<div class="h-100 d-flex flex-column pe-lg-6 mb-16 mt-10">
										<!--begin::Video-->
										<img alt="Logo" src="<?php echo base_url();?>assets/media/logos/scopnixlo.png?v=2" class="w-200px mb-10" style="margin-top:-15px;" />
										<div class="symbol symbol-200px">
                                            <img src="<?php echo BASE_URL.'uploads/profile/'.$data_info->fullname.'.jpg';?>" alt=""/>
                                        </div>
                                        
										<!--end::Video-->
									</div>
									<!--end::Feature post-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-8">
									<!--begin::Post-->
									<div class="ps-lg-6 mb-16 mt-10">
										<!--begin::Body-->
										<div class="mb-6 text-center">
											<!--begin::Title-->
											<h1 class="fs-1 text-gray-900 fw-bold text-gray-900 lh-base">Solar Energy & EV Charging Station</h1>
											<h3>Franchisee ID card</h3>
											<!--end::Title-->
										</div>
										<div class="separator mb-5"></div
										<!--end::Body-->
										<!--begin::Footer-->
									    <div class="text-center">
										    <h1 class="fs-1 text-gray-900 fw-bold text-gray-900 lh-base"><?php echo $aadhar_info->name;?></h1>
									    </div>
										<div class="d-flex flex-stack flex-wrap">
											<!--begin::Item-->
											<div class="d-flex align-items-center pe-2">
											    <table class="table">
											        <tr>
											            <th class="fw-bold fs-2" style="width:35%;font-size: 1.55rem !important;">Franchisee Code:</th>
											            <td style="font-size: 1.55rem !important;"><?php echo $data_info->franchisee_code;?></td>
											        </tr>
											        <tr>
											            <th class="fw-bold fs-2" style="font-size: 1.55rem !important;">Date:</th>
											            <td style="font-size: 1.55rem !important;"><?php echo date('F, Y',strtotime($data_info->created));?></td>
											        </tr>
											        <tr>
											            <th class="fw-bold fs-2" style="font-size: 1.55rem !important;">Address:</th>
											            <td style="font-size: 1.55rem !important;"><?php echo $aadhar_info->address;?></td>
											        </tr>
											    </table>
											</div>
											<!--end::Item-->
										</div>
										<!--end::Footer-->
									</div>
									<!--end::Post-->
								</div>
								<!--end::Col-->
							</div>
							<!--begin::Row-->
							<!--begin::Row-->
							<div class="row pagebreak px-4" style="border: 1px solid var(--bs-card-border-color);border-radius: 15px;">
								<img class="demo-bg" src="<?php echo base_url()?>assets/media/visiting-card-bg.png" alt="">
								<!--begin::Col-->
								<div class="col-4" style="border-right: #1B84FF 15px solid;">
									<!--begin::Feature post-->
									<div class="h-100 d-flex flex-column pe-lg-6 mt-10 mb-14">
										<!--begin::Video-->
										<img alt="Logo" src="<?php echo base_url();?>assets/media/logos/scopnixlo.png?v=2" class="w-200px mb-10" style="margin-top:-15px;" />
										<div class="symbol symbol-200px">
                                            <img src="<?php echo base_url();?>assets/media/logos/qrcode.png" alt=""/>
                                        </div>
                                        
										<!--end::Video-->
									</div>
									<!--end::Feature post-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-8">
									<!--begin::Post-->
									<div class="ps-lg-6 mb-14 mt-10">
										<!--begin::Body-->
										<div class="mb-6 text-center">
											<!--begin::Title-->
											<h1 class="fs-1 text-gray-900 fw-bold text-gray-900 lh-base">Solar Energy & EV Charging Station</h1>
										</div>
										<div class="separator mb-5"></div>
										<!--end::Body-->
										<!--begin::Footer-->
										<div class="d-flex flex-stack flex-wrap">
											<!--begin::Item-->
											<div class="d-flex align-items-center pe-2">
											    <table class="table">
											        <tr>
											            <th ><i  class="fs-2x fas fa-mobile-screen-button mr-2"></i></th>
											            <th class="fw-bold fs-2" style="font-size: 1.55rem !important;">Phone:</th>
											            <td style="font-size: 1.55rem !important;"><?php echo $data_info->mobile;?></td>
											        </tr>
											        <tr>
											            <th ><i  class="fs-2x fas fa-envelope mr-2"></i></th>
											            <th class="fw-bold fs-2" style="font-size: 1.55rem !important;">Emil:</th>
											            <td style="font-size: 1.55rem !important;"><?php echo $data_info->email;?></td>
											        </tr>
											        <tr>
											            <th ><i  class="fs-2x fas fa-globe mr-2"></i></th>
											            <th class="fw-bold fs-2" style="font-size: 1.55rem !important;">Website:</th>
											            <td style="font-size: 1.55rem !important;"><?php echo $settings->website;?></td>
											        </tr>
											    </table>
											</div>
											<!--end::Item-->
										</div>
										<!--end::Footer-->
									</div>
									<!--end::Post-->
								</div>
								<!--end::Col-->
							</div>
							<!--begin::Row-->
							<!-- begin::Footer-->
        					<div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
        						<!-- begin::Actions-->
        						<div class="my-1 me-5">
        							<!-- begin::Pint-->
        							<button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Invoice</button>
        							<!-- end::Pint-->
        							<!-- begin::Download-->
        							<button type="button" class="btn btn-light-success my-1">Download</button>
        							<!-- end::Download-->
        						</div>
        						<!-- end::Actions-->
        					</div>
        					<!-- end::Footer-->

						</div>
						<!--end::Section-->
					</div>
					<!--end::Body-->
					
				</div>
				<!--end::Home card-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Post-->
	</div>
	<!--end::Content-->