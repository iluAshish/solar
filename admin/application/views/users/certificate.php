<style>
    .watermark {
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
								<!-- begin::Invoice 3-->
								<div class="card" style="border:none;box-shadow: none;">
									<!-- begin::Body-->
									<div class="card-body py-5 watermark" style="border: 1px solid var(--bs-card-border-color);border-radius: 15px;">
									    <img class="demo-bg" src="<?php echo base_url()?>assets/media/certificate-background.jpg?v=12" alt="">
										<!-- begin::Wrapper-->
										<div class="mw-lg-900px w-100">
											<!-- begin::Header-->
											<div class="d-flex justify-content-between flex-column flex-sm-row mb-8">
												<!--end::Logo-->
												<div class="text-sm  col-5">
													<!--begin::Logo-->
													<a href="#" class="d-block mw-175px">
														<img alt="Logo" src="<?php echo base_url()?>assets/media/logos/scopnixlo.png" class="w-100" />
													</a>
													<!--end::Logo-->
												</div>
												<div class="text-sm col-4 text-center">
													<!--begin::Logo-->
													<a href="#" class="d-block mw-150px">
														<img alt="Logo" src="<?php echo base_url()?>assets/media/logos/medal.png" class="w-50" />
													</a>
													<!--end::Logo-->
												</div>
												
												<div class="text-sm-end col-3">
													<!--begin::Logo-->
													<a href="#" class="d-block mw-150px" style="float:right;">
														<img alt="Logo" src="<?php echo base_url()?>assets/media/logos/qrcode.png" class="w-50" />
													</a>
													<!--end::Logo-->
												</div>
											</div>
											<!--end::Header-->
											<div class="row text-center">
												<h2 class="fs-2tx fw-bold text-danger">CERTIFICATE OF FRANCHISE PARTNER</h2>
												<h2 class="fs-3 fw-bold">This certificate is proudly presented</h2>
												<h2 class="fs-2tx fw-bold text-primary"><?php echo $data_info->franchisee_name;?></h2>
												<h2 class="fs-2 fw-bold text-primary">(<?php echo $aadhar_info->name;?>)</h2>
												<div class="text-center mt-8">
												    <a class="mt-8 btn-primary btn-lg btn-round" style="border-radius:5px;background-color: #0071c7;padding: calc(.825rem + 1px) calc(1.75rem + 1px);color: #fff;border-color:#0071c7;font-size: 1.5rem;font-style: italic;">Franchisee Code: <?php echo $data_info->franchisee_code;?></a>
    												<div class="fs-4 mt-8 text-grey-800" style="padding:0 4rem 0 4rem;">This certificate is issued in recognition of the partnership with <b>Scopnix Solar & EV</b> and our shared vision of driving a cleaner, greener, and more sustainable future through renewable solar energy solutions.
    												    <br><span class="fw-bold text-gray-800">Address:</span> <?php echo $data_info->address;?>
    												    <br><span class="fw-bold text-gray-800">Date:</span> <?php echo date('d,M, Y',strtotime($data_info->created));?><br>
    												</div>
                                                </div>    												
											</div>	
											<!--begin::Body-->
											<div class="">
												<!--begin::Wrapper-->
												<div class="separator mb-6 mt-8"></div>
												<div class="d-flex flex-column gap-7">
													<!--begin:Order summary-->
													<div class="d-flex justify-content-between flex-column">
														<!--begin::Table-->
														<div class="table-responsive">
														    <table>
														        <tr>
        														    <td style="width:72%;">
        														        <span class="text-muted fw-bold fs-5" style="border-bottom: black 2px solid;width: 150px;display: block;"><img alt="Logo" src="<?php echo base_url()?>assets/media/logos/stamp.jpeg" class="w-50" /></span>
        														        <span style="padding-left: 50px;" class="text-center fs-4 fw-bold">Stamp</span>
        														    <td class="text-sm-end">
            														    <span class="text-muted fw-bold fs-5" style="border-bottom: black 2px solid;width: 300px;display: block;"><img alt="Logo" src="<?php echo base_url()?>assets/media/logos/sign.jpeg" class="w-50" /></span>
            														    <span class="text-center fs-4 fw-bold"><?php echo $settings->company_name?></span>
            														</td>    
        														</tr>    
    														</table>    
														</div>
														<!--end::Table-->
													</div>
													<!--end:Order summary-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Body-->
										</div>
									</div>	
									<div class="card-footer" style="border: none;">
										<!-- begin::Footer-->
										<div class="d-flex flex-stack flex-wrap mt-lg-20 pt-8">
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
									<!-- end::Wrapper-->
								</div>
								<!-- end::Invoice 1-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->
