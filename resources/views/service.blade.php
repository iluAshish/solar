@extends('app')
 
 @section('content')
 <div class="page-header parallaxie">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Page Header Box Start -->
					<div class="page-header-box">
						<h1 class="text-anime">Our Services</h1>
					</div>
					<!-- Page Header Box End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header End -->

	<!-- Services List Page Start -->
	<div class="page-services">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="0.25s">
						<a href="#" class="service-box-link"></a>

						<div class="service-image">
							<figure>
								<img src="{{ url('public/assets/images/service-1.jpg') }}" alt="">
							</figure>

							<div class="service-icon">
								<img src="{{ url('public/assets/images/icon-service-1.svg') }}" alt="">
							</div>
						</div>

						<div class="service-content">
							<h3>Solar Maintenance</h3>
							<p>Keep your solar systems running optimally with regular maintenance.</p>
						</div>
					</div>
					<!-- Service Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="0.5s">
						<a href="#" class="service-box-link"></a>

					<div class="service-image">
											<figure>
												<img src="{{ url('public/assets/images/service-2.jpg') }}" alt="">
											</figure>

											<div class="service-icon">
												<img src="{{ url('public/assets/images/icon-service-2.svg') }}" alt="">
											</div>
										</div>

										<div class="service-content">
											<h3>Energy Saving Devices</h3>
											<p>Eco-friendly devices to help you save on energy bills.</p>
										</div>
					</div>
					<!-- Service Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="0.75s">
						<a href="#" class="service-box-link"></a>

						<div class="service-image">
											<figure>
												<img src="{{ url('public/assets/images/service-3.jpg') }}" alt="">
											</figure>

											<div class="service-icon">
												<img src="{{ url('public/assets/images/icon-service-3.svg') }}" alt="">
											</div>
										</div>

										<div class="service-content">
											<h3>Solar Installation</h3>
											<p>Professional and efficient installation services for hassle-free energy generation.</p>
										</div>
					</div>
					<!-- Service Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="1.0s">
						<a href="#" class="service-box-link"></a>

					<div class="service-image">
											<figure>
												<img src="{{ url('public/assets/images/service-4.jpg') }}" alt="">
											</figure>

											<div class="service-icon">
												<img src="{{ url('public/assets/images/4icon.svg') }}" alt="">
											</div>
										</div>

										<div class="service-content">
											<h3>Solar Solutions</h3>
											<p>Customized solar solutions to fit your specific energy needs.</p>
										</div>
					</div>
					<!-- Service Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="1.25s">
						<a href="#" class="service-box-link"></a>

					<div class="service-image">
											<figure>
												<img src="{{ url('public/assets/images/service-5.jpg') }}" alt="">
											</figure>

											<div class="service-icon">
												<img src="{{ url('public/assets/images/5icon.svg') }}" alt="">
											</div>
										</div>

										<div class="service-content">
											<h3>Net Metering</h3>
											<p>Sell excess energy back to the grid and earn on your solar investment.</p>
										</div>
					</div>
					<!-- Service Item End -->
				</div>

				<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="1.5s">
						<a href="#" class="service-box-link"></a>

					<div class="service-image">
											<figure>
												<img src="{{ url('public/assets/images/service-6.jpg') }}" alt="">
											</figure>

											<div class="service-icon">
												<img src="{{ url('public/assets/images/6icon.svg') }}" alt="">
											</div>
										</div>

										<div class="service-content">
											<h3>Issue Detection</h3>
											<p>Quick and efficient troubleshooting services to minimize downtime.</p>
										</div>
					</div>
					<!-- Service Item End -->
				</div>
					<div class="col-lg-4 col-md-6">
					<!-- Service Item Start -->
					<div class="service-item wow fadeInUp" data-wow-delay="1.5s">
						<a href="#" class="service-box-link"></a>
 
				<div class="service-image">
											<figure>
												<img src="{{ url('public/assets/images/service-7.jpg') }}" alt="">
											</figure>

											<div class="service-icon">
												<img src="{{ url('public/assets/images/7icon.svg') }}" alt="">
											</div>
										</div>

										<div class="service-content">
											<h3>Branding</h3>
											<p>Develop a distinct brand image that stands out in the renewable energy sector.</p>
										</div>
					</div>
					<!-- Service Item End -->
				</div>
			</div>
		</div>
	</div>
	@endsection