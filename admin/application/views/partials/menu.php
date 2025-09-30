<?php
$CI =& get_instance();
$CI->load->model('Common');
$user_data = $CI->Common->get_info($user_id, TBL_USERS, 'id');
$role_id = $CI->session->userdata('role_id');
$user_img =  ($user_data->profilepic != '' && file_exists(UPLOAD_DIR.USERS.$user_data->profilepic)) ? base_url().UPLOAD.USERS.$user_data->profilepic : base_url().'assets/media/avatars/300-1.jpg';
?>
<!--begin::Aside-->
<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
	<!--begin::Aside Toolbarl-->
	<div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
		<!--begin::Aside user-->
		<!--begin::User-->
		<div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
			<!--begin::Symbol-->
			<div class="symbol symbol-50px">
				<img src="<?php echo $user_img;?>" alt="" />
			</div>
			<!--end::Symbol-->
			<!--begin::Wrapper-->
			<div class="aside-user-info flex-row-fluid flex-wrap ms-5">
				<!--begin::Section-->
				<div class="d-flex">
					<!--begin::Info-->
					<div class="flex-grow-1 me-2">
						<!--begin::Username-->
						<a href="#" class="text-white text-hover-primary fs-6 fw-bold"><?php echo ucwords($username);?></a>
						<!--end::Username-->
						<!--end::Label-->
					</div>
					<!--end::Info-->
					<!--begin::User menu-->
					<div class="me-n2">
						<!--begin::Action-->
						<a href="#" class="btn btn-icon btn-sm btn-active-color-primary mt-n2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
							<i class="ki-duotone ki-setting-2 text-muted fs-1">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</a>
						<!--begin::User account menu-->
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<div class="menu-content d-flex align-items-center px-3">
									<!--begin::Avatar-->
									<div class="symbol symbol-50px me-5">
										<img alt="Logo" src="<?php echo base_url()?>assets/media/avatars/300-1.jpg" />
									</div>
									<!--end::Avatar-->
									<!--begin::Username-->
									<div class="d-flex flex-column">
										<div class="fw-bold d-flex align-items-center fs-5"><?php echo ucwords($username);?> 
										<span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span></div>
										<a href="#" class="fw-semibold text-muted text-hover-primary fs-7">max@kt.com</a>
									</div>
									<!--end::Username-->
								</div>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator my-2"></div>
							<!--end::Menu separator-->
							<?php if($role_id != '1') { ?>
							<!--begin::Menu item-->
							<div class="menu-item px-5">
							    <?php if($user_data->is_aadhar_verified == 1 ) { ?>
							        <a href="javascript:void(0);" class="menu-link px-5 btn btn-sm btn-success">Aadhar No. Verified</a>
							    <?php } else { ?>
								<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#aadhar_verification_modal" class="menu-link px-5 btn btn-light btn-active-light-primary">Verify Aadhar No.</a>
							    <?php } ?>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">
							    <?php if($user_data->is_pan_verified == 1 ) { ?>
							        <a href="javascript:void(0);" class="menu-link px-5 btn btn-sm btn-success">Pan No. Verified</a>
							    <?php } else { ?>
    								<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#pan_verification_modal" class="menu-link px-5 btn btn-light btn-active-light-primary">Verify Pan Number</a>
							    <?php } ?>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">
							    <?php if($user_data->is_bank_verified == 1 ) { ?>
							        <a href="javascript:void(0);" class="menu-link px-5 btn btn-sm btn-success">Bank Verified</a>
							    <?php } else { ?>
								    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#bank_verification_modal" class="menu-link px-5 btn btn-light btn-active-light-primary">Verify Bank</a>
							    <?php } ?>
							</div>
							<!--end::Menu item-->
							<div class="separator my-2"></div>
							<?php } ?>
							<!--begin::Menu separator-->
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">
								<a href="<?php echo base_url().'user/profile'; ?>" class="menu-link px-5">My Profile</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-5 my-1">
								<a href="<?php echo base_url().'settings'; ?>" class="menu-link px-5">Settings</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">
								<a href="user/emiCalculator" class="menu-link px-5">EMI Calculator</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">
								<a href="<?php echo base_url().'auth/change-password'; ?>" class="menu-link px-5">Change Password</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator my-2"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-5">
								<a href="<?php echo base_url();?>/auth/logout" class="menu-link px-5">Sign Out</a>
							</div>
							<!--end::Menu item-->
						</div>
						<!--end::User account menu-->
						<!--end::Action-->
					</div>
					<!--end::User menu-->
				</div>
				<!--end::Section-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::User-->
	</div>
	<!--end::Aside Toolbarl-->
	<!--begin::Aside menu-->
	<div class="aside-menu flex-column-fluid">
		<!--begin::Aside Menu-->
		<div class="hover-scroll-overlay-y mx-3 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
			<!--begin::Menu-->
			<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
				<!--begin:Menu item-->
				<div class="menu-item here show">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>">
						<span class="menu-icon">
							<i class="ki-duotone ki-element-11 fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
								<span class="path4"></span>
							</i>
						</span>
						<span class="menu-title">Dashboards</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<div class="menu-item here show">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>/wallet">
						<span class="menu-icon">
							<i class="fas fa-solid fa-wallet fs-2"></i>    
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
							</i>
						</span>
						<span class="menu-title">Wallet</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->
				
				<!--begin:Menu item-->
				<div class="menu-item pt-5">
					<!--begin:Menu content-->
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Users</span>
					</div>
					<!--end:Menu content-->
				</div>
				<!--end:Menu item-->
				<?php  
				if($role_id == 1) { ?>

				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>user">
						<span class="menu-icon">
							<i class="fas fa-id-card fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
							</i>
						</span>
						<span class="menu-title">Manage Users</span>
					</a>
					<!--end:Menu link-->
				</div>
				
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>vendors">
						<span class="menu-icon">
							<i class="fas fa-id-card fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
							</i>
						</span>
						<span class="menu-title">Manage Vendors</span>
					</a>
					<!--end:Menu link-->
				</div>
				
				<?php } ?>
				<!--end:Menu item-->
                <!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>clients">
						<span class="menu-icon">
							<i class="fas fa-user fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
							</i>
						</span>
						<span class="menu-title">Manage Clients</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->				
                <!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>projects">
						<span class="menu-icon">
							<i class="fas fa-diagram-project fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
							</i>
						</span>
						<span class="menu-title">Manage Projects</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--begin:Menu item-->
				<div class="menu-item pt-5">
					<!--begin:Menu content-->
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Products</span>
					</div>
					<!--end:Menu content-->
				</div>
				<?php if($role_id == 1) { ?>
				<!--end:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>category">
						<span class="menu-icon">
							<i class="fas fa-table-list fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</span>
						<span class="menu-title">Categories</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>brand">
						<span class="menu-icon">
							<i class="fas fa-table-list fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</span>
						<span class="menu-title">Brand</span>
					</a>
					<!--end:Menu link-->
				</div>
				<?php } ?>
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>products">
						<span class="menu-icon">
							<i class="fas fa-cart-shopping fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</span>
						<span class="menu-title">Manage Products</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<div class="menu-item pt-5">
					<!--begin:Menu content-->
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Billings</span>
					</div>
					<!--end:Menu content-->
				</div>
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>quotation">
						<span class="menu-icon">
							<i class="fas fa-receipt fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</span>
						<span class="menu-title">Quotation</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->
				
                <!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>invoice">
						<span class="menu-icon">
							<i class="fas fa-file-invoice fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</span>
						<span class="menu-title">Invoices</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->

                <!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>payments">
						<span class="menu-icon">
							<i class="fas fa-money-bill fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</span>
						<span class="menu-title">Payments</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->

                <!--begin:Menu item-->
				<?php if($role_id == 1) { ?>
				<div class="menu-item pt-5">
					<!--begin:Menu content-->
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Location</span>
					</div>
					<!--end:Menu content-->
				</div>
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>states">
						<span class="menu-icon">
							<i class="fas fa-map-location-dot fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</span>
						<span class="menu-title">States</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link" href="<?php echo base_url();?>districts">
						<span class="menu-icon">
							<i class="fas fa-location-dot fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</span>
						<span class="menu-title">Districts</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->
                <?php } ?>
                <!--begin:Menu item-->
				<div class="menu-item pt-5">
					<!--begin:Menu content-->
					<div class="menu-content">
						<span class="menu-heading fw-bold text-uppercase fs-7">Reports</span>
					</div>
					<!--end:Menu content-->
				</div>
				<!--end:Menu item-->				
				
				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item">
					<!--begin:Menu link-->
					<a class="menu-link">
						<span class="menu-icon">
							<i class="fas fa-chart-simple fs-2">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</span>
						<span class="menu-title">Reports</span>
					</a>
					<!--end:Menu link-->
				</div>
				<!--end:Menu item-->
				
				
			</div>
			<!--end::Menu-->
		</div>
		<!--end::Aside Menu-->
	</div>
	<!--end::Aside menu-->
	<!--begin::Footer-->
	<div class="aside-footer flex-column-auto py-5" id="kt_aside_footer">
	</div>
	<!--end::Footer-->
</div>
<!--end::Aside-->


<div class="modal fade" id="aadhar_verification_modal" tabindex="-1" style="display: none;" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-750px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Modal title-->
				<h2 class="fw-bold">Verify Aadhar</h2>
				<!--end::Modal title-->
				<!--begin::Close-->
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
					<i class="ki-duotone ki-cross fs-1">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>
				</div>
				<!--end::Close-->
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body scroll-y mx-3 my-4">
				<!--begin::Form-->
				<form id="aadhar_verification" class="form fv-plugins-bootstrap5 fv-plugins-framework verification_form" action="<?php echo base_url().'franchisee/verify_aadhar_otp';?>">
					<input type="hidden" id="ref_id" name="ref_id" class="form-control" required />
					<div class="row g-3">
                        <div class="col-lg-7">
                            <div>
                                <label for="aadhar_number" class="form-label">AAdhar Number</label>
                                <div class="input-group">
                                    <input type="text" id="aadhar_number" name="aadhar_number" class="form-control" placeholder="Enter aadhar number" required />
                                    <button class="btn btn-light-primary send_otp" id="send_otp">Send OTP</button>
                                </div>    
                            </div>
                        </div>  
                        <div class="col-lg-5">
                            <div>
                                <label for="email" class="form-label">OTP</label>
                                <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP" required  value = '<?php echo (isset($data_info) && $data_info->contact_person != "") ? $data_info->contact_person : set_value('contact_person') ?>'/>
                            </div>
                        </div>
                    </div>
					<!--begin::Actions-->
					<div class="text-center pt-15">
						<button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
						<button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
							<span class="indicator-label">Verify</span>
							<span class="indicator-progress">Please wait... 
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
					<!--end::Actions-->
				</form>
				<!--end::Form-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>


<div class="modal fade" id="pan_verification_modal" tabindex="-1" style="display: none;" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-750px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Modal title-->
				<h2 class="fw-bold">Verify PAN Number</h2>
				<!--end::Modal title-->
				<!--begin::Close-->
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
					<i class="ki-duotone ki-cross fs-1">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>
				</div>
				<!--end::Close-->
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body scroll-y mx-3 my-4">
				<!--begin::Form-->
				<form id="pan_verification" class="form fv-plugins-bootstrap5 fv-plugins-framework verification_form" action="<?php echo base_url().'franchisee/verify_pan';?>">
					<div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="pan_number" class="form-label">Pan Number</label>
                                <input type="text" id="pan_number" name="pan_number" class="form-control" placeholder="Enter pan number" required />
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" required  />
                            </div>
                        </div>
                    </div>
					<!--begin::Actions-->
					<div class="text-center pt-15">
						<button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
						<button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
							<span class="indicator-label">Verify</span>
							<span class="indicator-progress">Please wait... 
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
					<!--end::Actions-->
				</form>
				<!--end::Form-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>


<div class="modal fade" id="bank_verification_modal" tabindex="-1" style="display: none;" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-750px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Modal title-->
				<h2 class="fw-bold">Verify Bank Details</h2>
				<!--end::Modal title-->
				<!--begin::Close-->
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
					<i class="ki-duotone ki-cross fs-1">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>
				</div>
				<!--end::Close-->
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body scroll-y mx-3 my-4">
				<!--begin::Form-->
				<form id="bank_verification" class="form fv-plugins-bootstrap5 fv-plugins-framework verification_form" action="<?php echo base_url().'franchisee/verify_bank';?>">
					<div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="name" class="form-label">User Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" required  />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="acc_number" class="form-label">Account Number</label>
                                <input type="password" id="acc_number" name="acc_number" class="form-control" placeholder="Enter account number" required />
                            </div>
                        </div>  
                    </div>
					<div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="ifsc_code" class="form-label">IFSC Code</label>
                                <input type="text" id="ifsc_code" name="ifsc_code" class="form-control" placeholder="Enter ifsc code" required  />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone number"  />
                            </div>
                        </div>  
                    </div>
					<!--begin::Actions-->
					<div class="text-center pt-15">
						<button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
						<button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
							<span class="indicator-label">Verify</span>
							<span class="indicator-progress">Please wait... 
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
					<!--end::Actions-->
				</form>
				<!--end::Form-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
