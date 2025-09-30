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
					    <h2>Manage Role</h2>
					</div>    
				    <div class="card-toolbar">
						<!--begin::Toolbar-->
						<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
							<!--begin::Add customer
							<button type="button" class="btn btn-light-primary open_my_form_form" data-control="user"><i class="ki-duotone ki-plus-square fs-3">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>Add User</button>
							<!--end::Add customer-->
						</div>
						<!--end::Toolbar-->
					</div>
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body py-4" style="overflow-x:scroll;">
					<!--begin::Table-->
					<table class="table align-middle table-row-dashed fs-6 gy-5">
						<thead>
							<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
								<th class="min-w-100px">ID</th>
								<th class="min-w-125px">Role</th>
								<th class="min-w-125px">Commision</th>
								<!--<th class="text-right min-w-80px max-w-100px">Actions</th>-->
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-semibold">
						    <?php 
						    $i=1;
						    foreach($roles as $role) { 
						    ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $role->role_name;?></td>
                                    <td><?php echo $role->commision;?></td>
                                    
                                    <!--<td class="text-right"><a href="<?php echo base_url();?>user/permission/<?php echo $role->role_id;?>" class="btn btn-primary" style="margin-left:20px;">Permission</a></td> -->
                                </tr>
                            <?php $i++; } 
                            ?>
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