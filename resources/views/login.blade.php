@extends('app')
 
 @section('content')
 <div class="page-header parallaxie">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Page Header Box Start -->
					<div class="page-header-box">
						<h1 class="text-anime">Login</h1>
					</div>
					<!-- Page Header Box End -->
				</div>
			</div>
		</div>
	</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="contact-form-box" style="background: #f7f7f7;margin-top:100px">
						<!-- Section Title Start -->
						<div class="section-title">
							<h2 class="text-anime">Welcome to Portal</h2>
						</div>
						<!-- Section Title End -->

						<!-- Contact Form start -->
						<div class="contact-form wow fadeInUp" data-wow-delay="0.75s">
							<form id="contactForm" action="#" method="POST" data-toggle="validator">
								<div class="row">
									<div class="form-group col-md-12 mb-4">
										<input type="text" name="name" class="form-control" id="name" placeholder="Name" required="">
										<div class="help-block with-errors"></div>
									</div>

									<div class="form-group col-md-12 mb-4">
										<input type="email" name="email" class="form-control" id="email" placeholder="Email" required="">
										<div class="help-block with-errors"></div>
									</div>

									<div class="form-group col-md-12 mb-4">
										<input type="text" name="password" class="form-control" id="password" placeholder="Password" required="">
										<div class="help-block with-errors"></div>
									</div>
									

									<div class="col-md-12 text-center">
										<button type="submit" class="btn-default">Login</button>
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
 @endsection