@extends('app')
 
 @section('content')
 <div class="page-header parallaxie">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Page Header Box Start -->
					<div class="page-header-box">
						<h1 class="text-anime">Contact us</h1>
					</div>
					<!-- Page Header Box End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header End -->

	<!-- Contact Information Section Start -->
	<div class="contact-information">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Section Title Start -->
					<div class="section-title">
						<h3 class="wow fadeInUp">Reach Out</h3>
						<h2 class="text-anime">Happy to Answer All Your Questions</h2>
					</div>
					<!-- Section Title End -->
				</div>
			</div>
			<div class="row">

				<div class="col-lg-4 col-md-6">
					<!-- Contact Info Item Start -->
					<div class="contact-info-item wow fadeInUp" data-wow-delay="0.5s">
						<div class="contact-image">
							<figure class="image-anime">
								<img src="{{ url('public/assets/images/email-img.jpg') }}" alt="">
							</figure>
						</div>

						<div class="contact-info-content">
							<h3>Emails:</h3>
							<p>info@scopnixsolar.com</p>
						</div>

						<div class="contact-icon">
							<img src="{{ url('public/assets/images/icon-mail.svg') }}" alt="">
						</div>
					</div>
					<!-- Contact Info Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Contact Info Item Start -->
					<div class="contact-info-item wow fadeInUp" data-wow-delay="0.75s">
						<div class="contact-image">
							<figure class="image-anime">
								<img src="{{ url('public/assets/images/phone-img.jpg') }}" alt="">
							</figure>
						</div>

						<div class="contact-info-content">
							<h3>Contact Number:</h3>
							<p>+91 955 5626 386</p>
						</div>

						<div class="contact-icon">
							<img src="{{ url('public/assets/images/icon-phone.svg') }}" alt="">
						</div>
					</div>
					<!-- Contact Info Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Contact Info Item Start -->
					<div class="contact-info-item wow fadeInUp" data-wow-delay="1.0s">
						<div class="contact-image">
							<figure class="image-anime">
								<img src="{{ url('public/assets/images/follow-img.jpg') }}" alt="">
							</figure>
						</div>

						<div class="contact-info-content">
							<h3>Follow Us:</h3>
							<ul>
							    <li><a href="https://wa.me/919555626386"><i class="fa-brands fa-whatsapp"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
							</ul>
						</div>

						<div class="contact-icon">
							<img src="{{ url('public/assets/images/icon-follow.svg') }}" alt="">
						</div>
					</div>
					<!-- Contact Info Item End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Contact Information Section End -->

	<!-- Google Map & Contact Form Section Start -->
	<div class="google-map-form" id="franchise">
		<div class="google-map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.6808573465314!2d77.27919797429385!3d28.639325633774327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfca8db454e15%3A0x1bfef6a8abbffe1d!2sGuru%20Angad%20Nagar%20West%2C%20Laxmi%20Nagar%2C%20Delhi%2C%20110092%2C%20India!5e0!3m2!1sen!2s!4v1731612743337!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>

		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-6">
					<div class="contact-form-box">
						<!-- Section Title Start -->
						<div class="section-title">
							<h3 class="wow fadeInUp">Application Form</h3>
							<h2 class="text-anime">Join Scopnix as a Solar Franchise Partner</h2>
						</div>
						<!-- Section Title End -->

						<!-- Contact Form start -->
						<div class="contact-form wow fadeInUp" data-wow-delay="0.75s">
							<form id="contactForm" action="#" method="POST" data-toggle="validator">
								<div class="row">
									<div class="form-group col-md-6 mb-4">
										<input type="text" name="name" class="form-control" id="name" placeholder="Name" required="">
										<div class="help-block with-errors"></div>
									</div>

									<div class="form-group col-md-6 mb-4">
										<input type="email" name="email" class="form-control" id="email" placeholder="Email" required="">
										<div class="help-block with-errors"></div>
									</div>

									<div class="form-group col-md-6 mb-4">
										<input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required="">
										<div class="help-block with-errors"></div>
									</div>
									
									<div class="form-group col-md-6 mb-4">
										<input type="text" name="occupation" class="form-control" id="subject" placeholder="Current Occupation / Business" required="">
										<div class="help-block with-errors"></div>
									</div>
										<div class="form-group col-md-6 mb-4">
										<input type="text" name="city" class="form-control" id="subject" placeholder="City Name" required="">
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group col-md-6 mb-4">
										<input type="text" name="state" class="form-control" id="subject" placeholder="State Name" required="">
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group col-md-12 mb-4">
										<input type="text" name="location" class="form-control" id="subject" placeholder="Preferred Location for Franchise" required="">
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group col-md-12 mb-4">
										<input type="text" name="investment" class="form-control" id="subject" placeholder="Investment Capacity" required="">
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group col-md-12 mb-4">
										<input type="text" name="hear" class="form-control" id="subject" placeholder="How Did You Hear About Us?" required="">
										<div class="help-block with-errors"></div>
									</div>

									<div class="form-group col-md-12 mb-4">
										<textarea name="interested" class="form-control" id="msg" rows="4" placeholder="Why are you interested in a Scopnix Franchise?" required=""></textarea>
										<div class="help-block with-errors"></div>
									</div>

									<div class="col-md-12 text-center">
										<button type="submit" class="btn-default">Apply Now</button>
										<div id="msgSubmit" class="h3 text-left hidden"></div>
									</div>
								</div>
							</form>
						</div>
						<!-- Contact Form end -->
					</div>
				</div>
			</div>
		</div>
	</div>
 @endsection