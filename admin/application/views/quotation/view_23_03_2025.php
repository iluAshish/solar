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
											<div class="d-flex justify-content-between flex-column flex-sm-row mb-15">
												<!--end::Logo-->
												<div class="text-sm">
													<!--begin::Logo-->
													<a href="#" class="d-block mw-150px">
														<img alt="Logo" src="<?php echo base_url()?>assets/media/logos/scopnixlo.png" class="w-100" />
													</a>
													<!--end::Logo-->
													<!--begin::Text-->
													<div class="text-sm fw-semibold fs-4 text-muted mt-7">
														<div><span class="fw-bold text-gray-800">GST:</span> <?php echo $settings->gst_no;?><br>
														<?php echo $settings->address;?>
														<span class="fw-bold text-gray-800">Mobile:</span> <?php echo $settings->mobile1;?></div>
													</div>
													<!--end::Text-->
												</div>
												
												<div class="text-sm-end">
													<!--begin::Text-->
													<div class="text-sm text-muted fw-semibold fs-4 mt-7">
													    <div class="fw-bold"><?php echo $client->client_name;?></div>
														<div><?php echo $client->address;?><br>
														<span class="fw-bold text-gray-800">Mobile:</span> <?php echo $client->phone;?><br>
														<span class="fw-bold text-gray-800">Date:</span> <?php echo date('d-m-Y',strtotime($data_info->qauote_date));?>
														</div>
													</div>
													<!--end::Text-->
												</div>
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="pb-12">
												<!--begin::Wrapper-->
												<div class="d-flex flex-column gap-7 gap-md-10">
													<!--begin::Separator-->
													<div class="separator"></div>
													<!--begin::Separator-->
													<!--begin::Message-->
													<div class="fw-bold fs-2">To <?php echo $client->client_name;?>,
													    <br />
													    <span class="text-muted fs-5"><span class="fw-bold text-gray-800">Project Size:</span> <?php echo $project->project_name;?><br>
													    <br>We provide exceptional customer service. We offer a diverse range of products. Our goal is to ensure customer satisfaction.</span><br>
													    <br><span class="text-muted fs-5"><span class="text-muted fs-5"><span class="fw-bold text-gray-800">Scope of Work:</span>
													    <br>We propose the supply, and commissioning of <?php echo $project->project_name;?> <span class="fw-bold text-gray-800">(Per/KW  price <?php echo $quote_prod[0]->basic_rate;?> rs.)</span> with the follwing specification: <?php echo $quote_prod[0]->description;?></span>
													    <br><br><span class="text-muted fs-5"><span class="fw-bold text-gray-800">Total Quotation Amount:</span>
													    <br>Grand Total: <span class="fw-bold text-gray-800"><?php echo $quote_prod[0]->amount;?></span> Rs. Including / Excluding VAT</span>
													</div>
													<!--begin::Message-->
													<!--begin::Separator-->
													<div class="separator"></div>
													<!--begin::Separator-->
                                                    <div class="fw-bold fs-2">Payment Details:
													    <br />
													    <span class="text-muted fs-5"><?php echo $settings->bank_details;?></span>
													</div>
													<!--begin::Separator-->
													<div class="separator"></div>
													<!--begin::Separator-->
                                                    <div class="fw-bold fs-2">Terms & Conditions:
													    <br />
													    <span class="text-muted fs-5"><?php echo $settings->quote_terms;?></span>
													</div>
													<!--begin:Order summary-->
													<div class="d-flex justify-content-between flex-column">
														<!--begin::Table-->
														<div class="table-responsive border-bottom mb-5 mt-10">
														    <span class="text-muted fs-5">Acceptance & Signature</span>
														</div>
														<!--end::Table-->
													</div>
													<!--end:Order summary-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Body-->
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
												<!-- begin::Action-->
												<a href="apps/invoices/create.html" class="btn btn-primary my-1">Create Invoice</a>
												<!-- end::Action-->
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
