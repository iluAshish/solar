<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<!-- Page Title -->
	<title>Scopnix Solar Panel</title>
	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ url('public/assets/images/icon.png') }}">
	<!-- Google Fonts css-->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
	<link href="{{ url('public/assets/css2?family=Rajdhani:wght@400;500;600;700&amp;family=Rubik:wght@400;500&amp;display=swap') }}" rel="stylesheet">
	<!-- Bootstrap css -->
	<link href="{{ url('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
	<!-- SlickNav css -->
	<link href="{{ url('public/assets/css/slicknav.min.css') }}" rel="stylesheet">
	<!-- Swiper css -->
	<link rel="stylesheet" href="{{ url('public/assets/css/swiper-bundle.min.css') }}">
	<!-- Font Awesome icon css-->
	<link href="{{ url('public/assets/css/all.min.css') }}" rel="stylesheet" media="screen">
	<!-- Animated css -->
	<link href="{{ url('public/assets/css/animate.css') }}" rel="stylesheet">
	<!-- Magnific css -->
	<link href="{{ url('public/assets/css/magnific-popup.css') }}" rel="stylesheet">
	<!-- Main custom css -->
	<link href="{{ url('public/assets/css/style.css') }}" rel="stylesheet" media="screen">
	<style>
	    .hero {
            margin-top: -252px!important;
	    }
	    .client-logo-item
	    {
	        margin-top:10px;
	    }
	    .features-layout2 {
             padding: 0px 0 50px; 
        }
        .page-header {
            margin-top:-200px;
        }
        @media only screen and (max-width: 768px) {
          .logg
          {
              width:100%!important;
          }
          .section-title h1
          {
              padding-top:10px;
          }
        }
	</style>
</head>

<body class="tt-magic-cursor">

	<!-- Preloader Start -->
	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="{{ url('public/assets/images/icon.png') }}" alt=""></div>
		</div>
	</div>
	<!-- Preloader End -->

	<!-- Magic Cursor Start -->
	<div id="magic-cursor">
		<div id="ball"></div>
	</div>
	<!-- Magic Cursor End -->

	<!-- Topbar Section Start -->
	<div class="topbar wow fadeInUp">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<!-- Topbar Contact Information Start -->
					<div class="topbar-contact-info">
						<ul>
							<li><a href="#"><i class="fa-solid fa-envelope"></i> info@scopnixsolar.com</a></li>
							<li><a href="#"><i class="fa-solid fa-phone"></i> +91 955 5626 386</a></li>
						</ul>
					</div>
					<!-- Topbar Contact Information End -->
				</div>

				<div class="col-md-4">
					<!-- Topbar Social Links Start -->
					<div class="header-social-links">
						<ul>
						    <li><a href="https://wa.me/919555626386"><i class="fa-brands fa-whatsapp"></i></a></li>
							<li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
						</ul>
					</div>
					<!-- Topbar Social Links End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Topbar Section End -->

	<!-- Header Start -->
	<header class="main-header">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg">
				<div class="container">
					<!-- Logo Start -->
					<a class="navbar-brand" href="{{ route('home') }}">
						<img src="{{ url('public/assets/images/scopnixlo.svg') }}" alt="Logo" class="logg" style="width:40%">
					</a>
					<!-- Logo End -->

					<!-- Main Menu start -->
					<div class="collapse navbar-collapse main-menu">
						<ul class="navbar-nav mr-auto" id="menu">
							<li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('service') }}">Services</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('home') }}#gallery">Gallery</a></li>
							<li class="nav-item"><a class="nav-link" href="http://admin.test">Login</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('contact') }}#franchise">Franchise</a></li>
							<li class="nav-item highlighted-menu"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
						</ul>
					</div>
					<!-- Main Menu End -->

					<div class="navbar-toggle"></div>
				</div>
			</nav>

			<div class="responsive-menu"></div>
		</div>
	</header>
	@yield('content')
	@if(!Request::is('login')) 
	<div class="solar-calculator" id="book">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Solar Calculator Form Start -->
					<div class="calculator-box wow fadeInUp">
						<div class="row">
							<div class="col-lg-5">
								<!-- Section Title Start -->
								<div class="section-title">
									<h3>Get Started Now</h3>
									<h2>Take the First Step to Clean Energy</h2>
								</div>
								<!-- Section Title End -->
							</div>

							<div class="col-lg-7">
								<!-- Solar Form Start -->
								<div class="solar-form">
									<form action="{{ route('book.store') }}" method="POST">
									    @csrf
										<div class="row">
											<div class="form-group col-md-6 mb-3">
												<select name="product" class="form-control" id="category" required="">
													<option>Select Product</option>
													<option>SOLAR ONGRIDE</option>
													<option>SOLAR OFFGRIGE</option>
													<option>SOLAR HYBRIDE</option>
													<option>SOLAR STREET LIGHT</option>
													<option>SOLAR HOME LIGHT</option>
													<option>SOLAR WATER PUMP</option>
													<option>SOLAR WATER HEATER </option>
													<option>EV CHARGING STATIONS</option>
													<option>SOLAR ATA CHAKKI MILLS</option>
													<option>PM SURYA GHAR YOJNA</option>
													<option>KUSUM YOJNA</option>
													<option>EV VEHICLES</option>
												</select>
												<div class="help-block with-errors"></div>
											</div>

											<div class="form-group col-md-6 mb-3">
												<input type="text" name="name" class="form-control" id="name" placeholder="Full Name" required="">
												<div class="help-block with-errors"></div>
											</div>
			
			
											<div class="form-group col-md-6 mb-3">
												<input type="email" name="email" class="form-control" id="email" placeholder="Email" required="">
												<div class="help-block with-errors"></div>
											</div>
			
											<div class="form-group col-md-6 mb-3">
												<input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required="">
												<div class="help-block with-errors"></div>
											</div>
			
											<div class="col-md-12">
												<button type="submit" class="btn-default">Book Now</button>
												<div id="msgSubmit" class="h3 text-left hidden"></div>
											</div>
										</div>
									</form>
								</div>
								<!-- Solar Form End -->
							</div>
						</div>
					</div>
					<!-- Solar Calculator Form End -->
				</div>
			</div>
		</div>
	</div>
	@endif
	<div class="footer-ticker">
		<div class="scrolling-ticker">
            <div class="scrolling-ticker-box">
                <div class="scrolling-content">
                    <span>Schedule Your Solar Consultation</span>
					<span>Shorter Charging Time</span>
					<span>Wide Compatibility</span>
					<span>Efficiency & Power</span>
					<span>24*7 Support</span>
                </div>

                <div class="scrolling-content">
                    <span>Offering Solar Franchise District Wise</span>
					<span>Reap the Returns</span>
					<span>Heal the World</span>
					<span>Efficiency & Power</span>
					<span>24*7 Support</span>
                </div>
            </div>
        </div>
	</div>
	<!-- Footer Ticker End -->

	<!-- Footer Start -->
	<footer class="main-footer">
		<!-- Footer Contact Start -->
		<div class="footer-contact">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<!-- Footer Contact Box Start -->
						<div class="footer-contact-box wow fadeInUp" data-wow-delay="0.25s">
							<div class="contact-icon-box">
								<img src="{{ url('public/assets/images/icon-location.svg') }}" alt="">
							</div>

							<div class="footer-contact-info">
								<h3>Head Quarters</h3>
								<p>46/47 FOURTH FLOOR, GURU ANGAD NAGAR, LAXMI NAGAR, NEW DELHI</p>
							</div>
						</div>
						<!-- Footer Contact Box End -->
					</div>

					<div class="col-lg-4">
						<!-- Footer Contact Box Start -->
						<div class="footer-contact-box wow fadeInUp" data-wow-delay="0.5s">
							<div class="contact-icon-box">
								<img src="{{ url('public/assets/images/icon-location.svg') }}" alt="">
							</div>

							<div class="footer-contact-info">
								<h3>Office 1</h3>
								<p>BEHIND BY PASS POLICE STATION, DUMKA ROAD, BHAGALPUR, BIHAR</p>
							</div>
						</div>
						<!-- Footer Contact Box End -->
					</div>

					<div class="col-lg-4">
						<!-- Footer Contact Box Start -->
						<div class="footer-contact-box wow fadeInUp" data-wow-delay="0.75s">
							<div class="contact-icon-box">
								<img src="{{ url('public/assets/images/icon-location.svg') }}" alt="">
							</div>

							<div class="footer-contact-info">
								<h3>Office 2</h3>
								<p> C17/E, City center, Sector 4, Bokaro Steel C, Jharkhand</p>
							</div>
						</div>
						<!-- Footer Contact Box End -->
					</div>
				</div>
			</div>
		</div>
		<!-- Footer Contact End -->

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Mega Footer Start -->
					<div class="mega-footer">
						<div class="row">
							<div class="col-lg-3 col-md-12">
								<!-- Footer About Start -->
								<div class="footer-about">
									<figure>
										<img src="{{ url('public/assets/images/whitelogo.png') }}" alt="">
									</figure>
									<p>info@scopnixsolar.com</p>
								</div>
								<div class="footer-social-links">
									<ul>
									    <li><a href="https://wa.me/919555626386"><i class="fa-brands fa-whatsapp"></i></a></li>
										<li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
										<li><a href="#"><i class="fab fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
									</ul>
								</div>
								<!-- Footer Social Link End -->
							</div>

							<div class="col-lg-3 col-md-4">
								<!-- Footer Links Start -->
								<div class="footer-links">
									<h2>Quick Links</h2>
									<ul>
										<li><a href="{{ route('home') }}">Home</a></li>
										<li><a href="{{ route('about') }}">About Us</a></li>
										<li><a href="{{ route('service') }}">Services</a></li>
										<li><a href="{{ route('contact') }}">Contact Us</a></li>
									<!--	<li><a href="#">Open Franchise</a></li> -->
										<li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
									</ul>
								</div>
								<!-- Footer Links End -->
							</div>

							<div class="col-lg-3 col-md-4">
								<!-- Footer Links Start -->
								<div class="footer-links">
									<h2>Products</h2>
									<ul>
										<li><a href="{{ route('products') }}">Solar Ongrid</a></li>
										<li><a href="{{ route('products') }}">Solar Offgrid</a></li>
										<li><a href="{{ route('products') }}">Solar Hybrid</a></li>
										<li><a href="{{ route('products') }}">Solar Street Lights</a></li>
										<li><a href="{{ route('products') }}">Solar Home Lighting</a></li>
									</ul>
								</div>
								<!-- Footer Links End -->
							</div>

							<div class="col-lg-3 col-md-4">
								<!-- Footer Links Start -->
								<div class="footer-links">
									<ul>
									    <li><a href="{{ route('products') }}">Solar Water Pumps</a></li>
										<li><a href="{{ route('products') }}">Solar Water Heater</a></li>
										<li><a href="{{ route('products') }}">EV Charging System</a></li>
										<li><a href="{{ route('products') }}">Solar Ata Chakki Mills</a></li>
										<li><a href="{{ route('products') }}">PM Surya Ghar Yojana</a></li>
										<li><a href="{{ route('products') }}">Kusum Yojana</a></li>
										<li><a href="{{ route('products') }}">EV Vehicles</a></li>
									</ul>
								</div>
								<!-- Footer Links End -->
							</div>
						</div>
					</div>
					<!-- Mega Footer End -->

					<!-- Copyright Footer Start -->
				 <!-- Copyright Footer Start -->
            <div class="footer-copyright">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Footer Copyright Content Start -->
                        <div class="footer-copyright-text">
                            <p>Copyright © {{ date('Y') }} SCOPNIX INDIA TECHNOLOGY PVT LTD. All rights reserved.</p>
                        </div>
                        <!-- Footer Copyright Content End -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-legal-links" style="text-align: center; margin-top: 10px;">
                            <a href="{{ route('privacy.policy') }}" class="footer-copyright-link">Privacy Policy</a>
                            <span class="footer-copyright-separator">|</span>
                            <a href="{{ route('terms.conditions') }}" class="footer-copyright-link">Terms & Conditions</a>
                            <span class="footer-copyright-separator">|</span>
                            <a href="{{ route('refund.policy') }}" class="footer-copyright-link">Refund & Cancellation</a>
                        </div>
                    </div>
                </div>
            </div>
					<!-- Copyright Footer End -->
				</div>
			</div>
		</div>
	</footer>
	<div id="ftrMenu" class="ftr-menu">
	    
   <a href="https://wa.me/+919555626386" target="_blank"><img src="/public/assets/images/whatsapp-logo.webp" alt="whatsapp" width="50px"></a>
   
      <a href="tel:+919555626386"> <img src="/public/assets/images/phone.webp" alt="phonecall" width="50px"></a>
      <div class="btn-wave"></div>
    </div>
    
    <style>
        
        .ftr-menu {
    position: fixed;
    bottom: 3em;
    right: 3em;
    z-index: 9999;
}

.ftr-menu a {
    margin-right: 8px;
}

.btn-wave {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 9999px;
    background-color: #f7faff;
    opacity: 0;
    z-index: -1;
    -webkit-animation: sonarWave 1.5s linear infinite;
    animation: sonarWave 1.5s linear infinite;
}

@-webkit-keyframes sonarWave {
    from {
        opacity: .4
    }
    to {
        -webkit-transform: scale(2);
        transform: scale(2);
        opacity: 0
    }
}

@keyframes sonarWave {
    from {
        opacity: .4
    }
    to {
        -webkit-transform: scale(2);
        transform: scale(2);
        opacity: 0
    }
}


@-webkit-keyframes solar_pulse {
	0%
	{
		-webkit-transform:scale(.1,.1);
		-moz-transform:scale(.1,.1);
		-ms-transform:scale(.1,.1);
		-o-transform:scale(.1,.1);
		transform:scale(.1,.1);
		opacity:0
	}
	
	50%
	{
		opacity:1
	}
	
	100%
	{
		-webkit-transform:scale(1.2,1.2);
		-moz-transform:scale(1.2,1.2);
		-ms-transform:scale(1.2,1.2);
		-o-transform:scale(1.2,1.2);
		transform:scale(1.2,1.2);
		opacity:0
	}
}

@keyframes solar_pulse {
	0%
	{
		-webkit-transform:scale(.1,.1);
		-moz-transform:scale(.1,.1);
		-ms-transform:scale(.1,.1);
		-o-transform:scale(.1,.1);
		transform:scale(.1,.1);
		opacity:0
	}
	
	50%
	{
		opacity:1
	}
	
	100%
	{
		-webkit-transform:scale(1.2,1.2);
		-moz-transform:scale(1.2,1.2);
		-ms-transform:scale(1.2,1.2);
		-o-transform:scale(1.2,1.2);
		transform:scale(1.2,1.2);
		opacity:0
	}
}
    </style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   @if(session('success'))
      <script type="text/javascript">
          $(document).ready(function() {
               Swal.fire({
                    title: 'Congratulation!',
                    text: "{{ session('success') }} ",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-info"
                        }
                    });
        });
      </script>
      @php
        session()->forget('success');
      @endphp
     @endif

@if(session('error'))
      <script type="text/javascript">
          $(document).ready(function() {
          Swal.fire({
                    title: 'Oops!',
                    text: "{{ session('error') }}",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    });
        });
      </script>
      @php
        session()->forget('error');
      @endphp
      @endif
	<script src="{{ url('public/assets/js/jquery-3.7.1.min.js') }}"></script>
	<!-- Bootstrap js file -->
	<script src="{{ url('public/assets/js/bootstrap.min.js') }}"></script>
	<!-- Validator js file -->
	<script src="{{ url('public/assets/js/validator.min.js') }}"></script>
	<!-- SlickNav js file -->
	<script src="{{ url('public/assets/js/jquery.slicknav.js') }}"></script>
	<!-- Swiper js file -->
	<script src="{{ url('public/assets/js/swiper-bundle.min.js') }}"></script>
	<!-- Counter js file -->
	<script src="{{ url('public/assets/js/jquery.waypoints.min.js') }}"></script>
	<script src="{{ url('public/assets/js/jquery.counterup.min.js') }}"></script>
	<!-- Magnific js file -->
	<script src="{{ url('public/assets/js/jquery.magnific-popup.min.js') }}"></script>
	<!-- SmoothScroll -->
	<script src="{{ url('public/assets/js/SmoothScroll.js') }}"></script>
	<!-- Parallax js -->
	<script src="{{ url('public/assets/js/parallaxie.js') }}"></script>
	<!-- MagicCursor js file -->
	<script src="{{ url('public/assets/js/gsap.min.js') }}"></script>
	<script src="{{ url('public/assets/js/magiccursor.js') }}"></script>
	<!-- Text Effect js file -->
	<script src="{{ url('public/assets/js/splitType.js') }}"></script>
	<script src="{{ url('public/assets/js/ScrollTrigger.min.js') }}"></script>
	<!-- Wow js file -->
	<script src="{{ url('public/assets/js/wow.js') }}"></script>
	<!-- Main Custom js file -->
	<script src="{{ url('public/assets/js/function.js') }}"></script>
	<script src="{{ url('public/assets/js/theme-panel.js') }}"></script>
</body>

</html>