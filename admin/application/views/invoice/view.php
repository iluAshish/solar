					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">
								<!-- begin::Invoice 3-->
								<div class="card">
									<!-- begin::Body-->
									<div class="card-body py-5">
										<!-- begin::Wrapper-->
										<div class="mw-lg-950px mx-auto w-100">
											<!-- begin::Header-->
											<div class="d-flex justify-content-between flex-column flex-sm-row mb-8">
												<!--end::Logo-->
												<div class="text-sm col-7">
													<!--begin::Logo-->
													<a href="#" class="d-block mw-150px">
														<img alt="Logo" src="<?php echo base_url()?>assets/media/logos/scopnixlo.png" class="w-100" />
													</a>
													<!--end::Logo-->
													<!--begin::Text-->
													<div class="text-sm fw-semibold fs-4 text-muted mt-7">
														<table class="text-muted">
														    <tr><th class="min-w-100px"><span class="fw-bold text-gray-800">CIN:-</span></th> <td><?php echo $settings->cin_no;?></td></tr>
														    <tr><th><span class="fw-bold text-gray-800">GST:-</span></th> <td><?php echo $settings->gst_no;?></td></tr>
														    <tr><th><span class="fw-bold text-gray-800">Mobile:-</span></th> <td><?php echo $settings->mobile1;?></td></tr>
														    <tr><th><span class="fw-bold text-gray-800">Address:-</span></th> <td><?php echo $settings->address;?></td></tr>
														</table>    
													</div>
													<!--end::Text-->
												</div>
												
												<div class="text-sm-end col-5">
													<!--begin::Text-->
													<div class="text-sm text-muted fw-semibold fs-4 mt-7">
													    <h2 style="text-align:left;">To,</h2>
														<table class="text-muted">
														    <tr><th class="min-w-100px"><span class="fw-bold text-gray-800">Name:-</span></th> <td><?php echo $client->client_name;?></td></tr>
														    <tr><th><span class="fw-bold text-gray-800">Mobile:-</span></th> <td><?php echo $client->phone;?></td></tr>
														    <tr><th><span class="fw-bold text-gray-800">Address:-</span></th> <td><?php echo $client->address;?></td></tr>
														</table>    
													</div>
													<!--end::Text-->
												</div>
											</div>
											<!--end::Header-->
											<div class="d-flex justify-content-between flex-column flex-sm-row">
												<div class="fw-muted fs-3 text-sm">
												    <span class="fw-bold text-gray-800">Invoice </span> : <?php echo $data_info->invoice_no;?></div>
												<div class="fw-muted fs-3 text-sm-end"><span class="fw-bold text-gray-800">Date :</span> <?php echo date('d-m-Y',strtotime($data_info->invoice_date));?></div>
											</div>	
											<!--begin::Body-->
											<div class="pb-4">
												<!--begin::Wrapper-->
												<div class="d-flex flex-column gap-7">
													<!--begin::Separator-->
													<div class="separator"></div>
													<!--begin::Separator-->
													<!--begin::Message-->
													<div class="fw-bold fs-4 text-sm text-muted">
												        <span class="fw-bold text-gray-800">Project:</span> <?php echo $project->project_name;?><br>
												        <span style="margin-right:30px;"><span class="fw-bold text-gray-800">Project Size:</span> <?php echo $project->qty;?> KW</span>
												        <span class="fw-bold text-gray-800">Project Type:</span> <?php echo $project->project_type;?><br><br>
												    
												        <span class="fw-bold text-gray-800">Price:</span> &#8377;. <?php echo $project->basic_rate;?> /KW<br>
												        <span class="fw-bold text-gray-800">Total Price:</span> &#8377;. <?php echo $project->amount;?> <br>
													    
													    <br><span class="fw-bold text-gray-800">Scope of Work:</span> <?php echo $data_info->work_scope;?>
													    <br><span class="fw-bold text-gray-800">Specification:</span> <?php echo $data_info->specification;?><br>
													</div>
													<!--begin::Message-->
													<!--begin::Separator-->
													<div class="separator"></div>
													<!--begin::Separator-->
                                                    <div class="fw-bold fs-2">Payment Details:
													    <span class="text-muted fs-5"><?php echo $settings->bank_details;?></span>
													</div>
													<!--begin::Separator-->
													<div class="separator"></div>
													<!--begin::Separator-->
                                                    <div class="fw-bold fs-2">Terms & Conditions:
													    <span class="text-muted fs-5"><?php echo $settings->quote_terms;?></span>
													</div>
													<div class="separator border-5 border-info my-5"></div>
													<!--begin:Order summary-->
													<div class="d-flex justify-content-between flex-column">
														<!--begin::Table-->
														<div class="table-responsive mb-3">
														    <table>
														        <tr>
        														    <td style="width:75%;"><span class="text-muted fs-5"><?php echo $settings->quote_footer?></span></td>
        														    <td class="text-sm-end">
            														    <span class="fw-bold fs-3">Visit US</span><br>
            														    <span class="text-muted fs-5"><?php echo $settings->website?></span>
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
									<!-- end::Body-->
								</div>
								<!-- end::Invoice 1-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->
