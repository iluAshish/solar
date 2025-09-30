<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Row-->
			<div class="row gy-5 gx-xl-10">
				<!--begin::Col-->
				<div class="col-xl-12 mb-5 mb-xl-10">
					<!--begin::Row-->
					<div class="row g-lg-5 g-xl-10">
						<!--begin::Col-->
						<div class="col-md-4 col-xl-4 mb-5 mb-xl-10">
						    <!--begin::Card widget 10-->
							<div class="card card-flush h-md-50 mb-lg-10">
								<!--begin::Header-->
								<div class="card-header pt-5">
									<!--begin::Title-->
									<div class="card-title d-flex flex-column">
										<!--begin::Amount-->
										<span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2"><?php echo $franchisee;?></span>
										<!--end::Amount-->
										<!--begin::Subtitle-->
										<span class="text-gray-500 pt-1 fw-semibold fs-6">Total Franchisee</span>
										<!--end::Subtitle-->
									</div>
									<!--end::Title-->
								</div>
								<!--end::Header-->
								<!--begin::Card body-->
								<div class="card-body d-flex align-items-end pt-0">
									<!--begin::Wrapper-->
									<div class="d-flex align-items-center flex-wrap">
										<!--begin::Labels-->
										<div class="d-flex flex-column content-justify-center flex-grow-1">
											<!--begin::Label-->
											<div class="d-flex fs-6 fw-semibold align-items-center">
												<!--begin::Bullet-->
												<div class="bullet w-8px h-6px rounded-2 bg-success me-3"></div>
												<!--end::Bullet-->
												<!--begin::Label-->
												<div class="fs-6 fw-semibold text-gray-500 flex-shrink-0">Verified Franchisee</div>
												<!--end::Label-->
												<!--begin::Separator-->
												<div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
												<!--end::Separator-->
												<!--begin::Stats-->
												<div class="ms-auto fw-bolder text-gray-700 text-end"><?php echo $franchisee - $unverified_franchisee;?></div>
												<!--end::Stats-->
											</div>
											<!--end::Label-->
											<!--begin::Label-->
											<div class="d-flex fs-6 fw-semibold align-items-center my-1">
												<!--begin::Bullet-->
												<div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
												<!--end::Bullet-->
												<!--begin::Label-->
												<div class="fs-6 fw-semibold text-gray-500 flex-shrink-0">Unverified Franchisee</div>
												<!--end::Label-->
												<!--begin::Separator-->
												<div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
												<!--end::Separator-->
												<!--begin::Stats-->
												<div class="ms-auto fw-bolder text-gray-700 text-end"><?php echo $unverified_franchisee;?></div>
												<!--end::Stats-->
											</div>
											<!--end::Label-->
										</div>
										<!--end::Labels-->
									</div>
									<!--end::Wrapper-->
								</div>
								<!--end::Card body-->
							</div>
							<!--end::Card widget 10-->

						    
						    
							<!--begin::Card widget 12-->
							<div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
								<!--begin::Card body-->
								<div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
									<!--begin::Statistics-->
									<div class="mb-4 px-9">
										<!--begin::Info-->
										<div class="d-flex align-items-center mb-2">
											<!--begin::Value-->
											<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2"><?php echo $products;?></span>
											<!--end::Value-->
											<!--begin::Label-->
											<span class="d-flex align-items-end text-gray-500 fs-6 fw-semibold">Products</span>
											<!--end::Label-->
										</div>
										<!--end::Info-->
										<!--begin::Description-->
										<span class="fs-6 fw-semibold text-gray-500">Number of products</span>
										<!--end::Description-->
									</div>
									<!--end::Statistics-->
								</div>
								<!--end::Card body-->
							</div>
							<!--end::Card widget 12-->
							
							
							
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-md-4 col-xl-4 mb-md-5 mb-xl-10">
							<!--begin::Card widget 12-->
							<div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
								<!--begin::Card body-->
								<div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
									<!--begin::Statistics-->
									<div class="mb-4 px-9">
										<!--begin::Info-->
										<div class="d-flex align-items-center mb-2">
											<!--begin::Value-->
											<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2"><?php echo $clients;?></span>
											<!--end::Value-->
											<!--begin::Label-->
											<span class="d-flex align-items-end text-gray-500 fs-6 fw-semibold">Clients</span>
											<!--end::Label-->
										</div>
										<!--end::Info-->
										<!--begin::Description-->
										<span class="fs-6 fw-semibold text-gray-500">Number of clients</span>
										<!--end::Description-->
									</div>
									<!--end::Statistics-->
								</div>
								<!--end::Card body-->
							</div>
							<!--end::Card widget 12-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-md-4 col-xl-4 mb-md-5 mb-xl-10">
						    <!--begin::Card widget 10-->
							<div class="card card-flush h-md-50 mb-lg-10">
								<!--begin::Header-->
								<div class="card-header pt-5">
									<!--begin::Title-->
									<div class="card-title d-flex flex-column">
										<!--begin::Amount-->
										<span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2"><?php echo $projects;?></span>
										<!--end::Amount-->
										<!--begin::Subtitle-->
										<span class="text-gray-500 pt-1 fw-semibold fs-6">Total Projects</span>
										<!--end::Subtitle-->
									</div>
									<!--end::Title-->
								</div>
								<!--end::Header-->
								<!--begin::Card body-->
								<div class="card-body d-flex align-items-end pt-0">
									<!--begin::Wrapper-->
									<div class="d-flex align-items-center flex-wrap">
										<!--begin::Labels-->
										<div class="d-flex flex-column content-justify-center flex-grow-1">
											<!--begin::Label-->
											<div class="d-flex fs-6 fw-semibold align-items-center">
												<!--begin::Bullet-->
												<div class="bullet w-8px h-6px rounded-2 bg-success me-3"></div>
												<!--end::Bullet-->
												<!--begin::Label-->
												<div class="fs-6 fw-semibold text-gray-500 flex-shrink-0">Completed Projects</div>
												<!--end::Label-->
												<!--begin::Separator-->
												<div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
												<!--end::Separator-->
												<!--begin::Stats-->
												<div class="ms-auto fw-bolder text-gray-700 text-end"><?php echo $com_projects;?></div>
												<!--end::Stats-->
											</div>
											<!--end::Label-->
											<!--begin::Label-->
											<div class="d-flex fs-6 fw-semibold align-items-center my-1">
												<!--begin::Bullet-->
												<div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
												<!--end::Bullet-->
												<!--begin::Label-->
												<div class="fs-6 fw-semibold text-gray-500 flex-shrink-0">Running Projects</div>
												<!--end::Label-->
												<!--begin::Separator-->
												<div class="separator separator-dashed min-w-10px flex-grow-1 mx-2"></div>
												<!--end::Separator-->
												<!--begin::Stats-->
												<div class="ms-auto fw-bolder text-gray-700 text-end"><?php echo $projects - $com_projects;?></div>
												<!--end::Stats-->
											</div>
											<!--end::Label-->
										</div>
										<!--end::Labels-->
									</div>
									<!--end::Wrapper-->
								</div>
								<!--end::Card body-->
							</div>
							<!--end::Card widget 10-->
						</div>
						<!--end::Col-->
					</div>
					<!--end::Row-->
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
