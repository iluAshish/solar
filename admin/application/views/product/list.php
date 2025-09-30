<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
		    
		    <?php
                add_edit_form();
            ?>
		    
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
					    <h2>Manage Products</h2>
					</div>  
					<?php if($role_id == 1) { ?>
				    <div class="card-toolbar">
						<!--begin::Toolbar-->
						<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
							<!--begin::Add customer-->
							<button type="button" class="btn btn-light-primary open_my_form_form" data-control="products"><i class="ki-duotone ki-plus-square fs-3">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>Add Product</button>
							<!--end::Add customer-->
						</div>
						<!--end::Toolbar-->
					</div>
					<?php } ?>
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body py-4">
					<!--begin::Table-->
					<table class="table align-middle table-row-dashed fs-6 gy-5 common_datatable" data-control="products" data-mathod="manage">
						<thead>
							<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
								<th class="min-w-125px">Name</th>
								<th class="min-w-125px">Category</th>
								<th class="min-w-125px">Warranty</th>
								<?php if($role_id == 1) { ?>
								<th class="min-w-125px">Price</th>
								<th class="min-w-125px">Franchisee Price</th>
								<th class="min-w-125px">Status</th>
								<th class="text-end min-w-100px">Actions</th>
								<?php } ?>
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