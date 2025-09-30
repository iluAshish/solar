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
											<div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
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
														<?php echo $settings->address;?><br>
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
													<div class="fw-bold fs-2">To <?php echo $client->client_name;?></span>,
													<br />
													<span class="text-muted fs-5"><span class="fw-bold text-gray-800">Project Size:</span> <?php echo $project->project_name;?><br>
													<br>We provide exceptional customer service. We offer a diverse range of products. Our goal is to ensure
customer satisfaction.</span></div>
													<!--begin::Message-->
													<!--begin::Separator-->
													<div class="separator"></div>
													<!--begin::Separator-->

													<!--begin:Order summary-->
													<div class="d-flex justify-content-between flex-column">
														<!--begin::Table-->
														<div class="table-responsive border-bottom mb-9">
															<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
																<thead>
																	<tr class="border-bottom fs-6 fw-bold text-muted">
																		<th class="min-w-50px pb-2">SR No</th>
																		<th class="min-w-175px pb-2">Products</th>
																		<th class="min-w-200px pb-2">Specification</th>
																		<th class="min-w-80px pb-2">Making</th>
																		<th class="min-w-80px pb-2">Quantity</th>
																		<th class="min-w-80px pb-2">Rate / KW</th>
																		<th class="min-w-80px pb-2">Amount</th>
																	</tr>
																</thead>
																<tbody class="fw-semibold text-gray-600">
																	<?php 
																	$i = 1;
																	foreach($quote_prod as $product) { ?>
																	<tr>
																		<td><?php echo $i; ?></td>
																		<td><?php echo $product->product_name; ?></td>
																		<td><?php echo $product->description; ?></td>
																		<td><?php echo $product->making; ?></td>
																		<td><?php echo $product->qty; ?> KW</td>
																		<td>&#8377;<?php echo $product->basic_rate; ?> /KW</td>
																		<td>&#8377;<?php echo $product->amount; ?></td>
																	</tr>
																	<?php 
																	$i++;
																	} ?>
																</tbody>
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
