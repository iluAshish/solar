<?php 
$data['user_id'] = $this->tank_auth->get_user_id();
$data['username'] = $this->tank_auth->get_username();
$ci = get_instance();
$data['user_type'] = $ci->session->userdata('role');

 ?>
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
        <?php $this->load->view('partials/title-meta', array('title'=> $page_title)); ?>
        <?php $this->load->view('partials/head-css') ?>
    </head>
	<!--begin::Body-->
	<body id="kt_body" class="print-content-only aside-enabled">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
        
                <?php $this->load->view('partials/menu',$data) ?>
                
                <!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    				<?php $this->load->view('partials/topbar',$data) ?> 
    				<!--begin::Content-->
            		<?php	
            		$this->load->view($main_content, $data);
            		?>
    				<!--end::Content-->
    				<!--begin::Footer-->
    				<?php $this->load->view('partials/footer',$data) ?>
    				<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
        		

    </div>
    <!-- END layout-wrapper -->

    <!--begin::Javascript-->    

    <?php $this->load->view('partials/scripts') ?>
    <!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>