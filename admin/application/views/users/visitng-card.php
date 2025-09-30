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
				<div class="card" style="border:none;">
					<!--begin::Body-->
					<div class="card-body p-lg-10" style="padding-top:0 !important;padding-bottom: 0 !important;">
						<!--begin::Section-->
						<div class="mb-17">
							<!--begin::Row-->
							<div class="row" style="border: 1px solid var(--bs-card-border-color);border-radius: 15px;">
							    <img class="demo-bg" src="<?php echo base_url()?>assets/media/visiting-card-bg.png" alt="">
								<!--begin::Col-->
								<div class="col-5">
									<!--begin::Feature post-->
									<div class="h-100 d-flex flex-column pe-lg-6 mb-lg-0 mb-10" style="border-right: #1B84FF 15px solid;">
										<!--begin::Video-->
										<div class="symbol symbol-200px" style="padding: 8rem 0 2rem 0;">
                                            <img src="<?php echo base_url();?>assets/media/logo-c-bg.png" alt=""/>
                                        </div>
                                        
										<!--end::Video-->
									</div>
									<!--end::Feature post-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-7">
									<!--begin::Post-->
									<div class="mb-16 mt-md-5 mt-17">
										<!--begin::Body-->
										<div class="mb-6 text-center">
											<!--begin::Title-->
											<a href="#" style="font-size:2.25rem;" class="fw-bold text-danger lh-base mb-15">Solar Energy & EV Charging Station</a><br>
											<h2 class="fs-1 text-center text-gray-900 mb-4 fw-bold text-hover-primary lh-base" style="border-bottom:black thick solid;padding:5px 0 15px 0px;"><?php echo $aadhar_info->name;?></h2>
											<span style="font-size: 1.55rem !important;">Franchisee Partner</span>
											<!--end::Title-->
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
											            <th class="fw-bold fs-2" style="font-size: 1.55rem !important;width:25%;padding-left: 0px;">Phone</th>
											            <td style="font-size: 1.55rem !important;"><?php echo $data_info->mobile;?></td>
											        </tr>
											        <tr>
											            <th><i  class="fs-2x fas fa-envelope mr-2"></i></th>
											            <th class="fw-bold fs-2" style="font-size: 1.55rem !important;width:25%;padding-left: 0px;">Email</th>
											            <td style="font-size: 1.55rem !important;"><?php echo $data_info->email;?></td>
											        </tr>
											        <tr>
											            <th><i  class="fs-2x fas fa-globe mr-2"></i></th>
											            <th class="fw-bold fs-2" style="font-size: 1.55rem !important;width:25%;padding-left: 0px;">Website</th>
											            <td style="font-size: 1.55rem !important;"><?php echo $settings->website;?></td>
											        </tr>
											        <tr>
											            <th><i  class="fs-2x fas fa-address-card mr-2"></i></th>
											            <th class="fw-bold fs-2" style="font-size: 1.55rem !important;width:25%;padding-left: 0px;">Address</th>
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
							<div class="row pagebreak" style="border: 1px solid var(--bs-card-border-color);border-radius: 15px;">
								<!--begin::Col-->
								<div class="col-12" >
								    <img src="<?php echo base_url();?>assets/media/logos/visiting-card.png?v=2" style="width: inherit;">
								</div>
								<!--end::Col-->
							</div>
							<!--begin::Row-->
							<!-- begin::Footer-->
        					<div class="d-flex flex-stack flex-wrap pt-13">
        						<!-- begin::Actions-->
        						<div class="my-1 me-5">
        							<!-- begin::Pint-->
        							<button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print</button>
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