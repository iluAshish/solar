<?php
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'class'	=> 'form-control bg-transparent',
	'value' => set_value('login'),
	'maxlength'	=> 80,
        'placeholder'	=> $login_label,
	'size'	=> 30,
	'required' => 'required'
);
$password = array(
	'name'	=> 'password',
	'class'	=> 'form-control bg-transparent password-input',
	'id'	=> 'password',
	'placeholder'	=> 'Password',
	'size'	=> 30,
	'required' => 'required'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$login_btn = array(
	'value'	=> 'Login',
	'type'	=> 'submit',
	'class'	=> 'btn btn-primary btn-cons',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>


<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: MetronicProduct Version: 8.2.6
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head>
<base href="../../../" />
		<title><?php echo WEBSITE_NAME; ?></title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - The World's #1 Selling Tailwind CSS & Bootstrap Admin Template by KeenThemes" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="http://preview.keenthemes.comauthentication/layouts/creative/sign-in.html" />
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/media/logos/icon.png" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="<?php echo base_url();?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('<?php echo base_url();?>assets/media/auth/bg4.jpg'); } [data-bs-theme="dark"] body { background-image: url('<?php echo base_url();?>assets/media/auth/bg4-dark.jpg'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid flex-lg-row">
				<!--begin::Aside-->
				<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
					<!--begin::Aside-->
					<div class="d-flex flex-center flex-lg-start flex-column">
						<!--begin::Logo-->
						<a href="<?php echo base_url();?>" class="mb-7">
							<img alt="Logo" src="<?php echo base_url();?>assets/media/logos/logo.png?v=2" />
						</a>
						<!--end::Logo-->
						<!--begin::Title-->
						<h4 class="text-white fw-normal m-0">At Scopnix, we’re on a mission to bring sustainable, reliable, and affordable solar energy solutions to homes, businesses, and communities across the country. With a firm commitment to quality and customer satisfaction, we offer a comprehensive range of solar products and services, from residential rooftop systems to commercial solar installations.</h4>
						<!--end::Title-->
					</div>
					<!--begin::Aside-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
					<!--begin::Card-->
					<div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
						<!--begin::Wrapper-->
						<div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
							<!--begin::Form-->
							<?php echo form_open($this->uri->uri_string(), array('class' => 'form w-100', 'id' => 'kt_login_signin_formmm', 'novalidate' => 'novalidate')); ?>    
								<!--begin::Heading-->
								<div class="text-center mb-11">
									<!--begin::Title-->
									<h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
									<!--end::Title-->
								</div>
								<!--begin::Heading-->
								<!--end::Input group=-->
								<div class="fv-row mb-3">
									<!--begin::Password-->
									<select class="form-select form-select-lg form-select-solid" name="user_type" required >
        							    <option value="0">Select Role</option>
        							    <?php foreach($roles as $key=>$value) { ?>
                                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                        <?php } ?>
									</select>
									<!--end::Password-->
								</div>
								<!--end::Input group=-->
								
								<!--begin::Input group=-->
								<div class="fv-row mb-8">
									<!--begin::Email-->
									<?php echo form_input($login); ?>
                					<?php echo form_error($login['name'], '<p class="error text-danger-emphasis">', '</p>'); ?><?php echo isset($errors[$login['name']])?'<p class="error text-danger-emphasis">'.$errors[$login['name']].'</p>':''; ?>
									<!--end::Email-->
								</div>
								<!--end::Input group=-->
								<div class="fv-row mb-3">
									<!--begin::Password-->
									<?php echo form_password($password); ?>
									<?php echo form_error($password['name'], '<p class="error text-danger-emphasis">', '</p>'); ?><?php echo isset($errors[$password['name']])?'<p class="error text-danger-emphasis">'.$errors[$password['name']].'</p>':''; ?>
									<!--end::Password-->
								</div>
								
								<!--begin::Submit button-->
								<div class="d-grid mb-10">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<!--begin::Indicator label-->
										<span class="indicator-label">Sign In</span>
										<!--end::Indicator label-->
										<!--begin::Indicator progress-->
										<span class="indicator-progress">Please wait... 
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										<!--end::Indicator progress-->
									</button>
								</div>
								<!--end::Submit button-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Card-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = <?php echo base_url()."assets/";?>;</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?php echo base_url();?>assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo base_url();?>assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="<?php echo base_url();?>assets/js/custom/authentication/sign-in/general.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
