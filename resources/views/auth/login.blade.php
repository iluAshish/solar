<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="shortcut icon" href="{{ url('public/assets/images/icon.png') }}">
		<title>Scopnix Solar Panel</title>

		<!-- Core CSS -->
		<link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/css/style.css') }}">
	</head>
	<body>
		<!-- App Start-->
		<div id="root">
			<!-- App Layout-->
			<div class="app-layout-blank flex flex-auto flex-col h-[100vh]">
				<main class="h-full">
                    <div class="page-container relative h-full flex flex-auto flex-col">
                        <div class="h-full">
                            <div class="container mx-auto flex flex-col flex-auto items-center justify-center min-w-0 h-full">
                                <div class="card min-w-[320px] md:min-w-[450px] card-shadow" role="presentation">
                                    <div class="card-body md:p-10">
                                        <!--<div class="text-center">-->
                                        <!--    <div class="logo">-->
                                        <!--        <img class="mx-auto" src="{{ url('public/assets/images/scopnixlogo.png') }}" alt="" style="width:30%">-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <div class="text-center">
                                            <div class="mb-4">
                                                <h3 class="mb-1">Welcome back!</h3>
                                                <p>Please enter your credentials to sign in!</p>
                                            </div>
                                            <div>
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="form-container vertical">
                                                        <div class="form-item vertical">
                                                            <label class="form-label mb-2">Email</label>
                                                            <div>
                                                                <input
                                                                    class="input"
                                                                    type="email"
                                                                    name="email"
                                                                    autocomplete="off"
                                                                    placeholder="Email Address"
                                                                    value=""
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="form-item vertical">
                                                            <label class="form-label mb-2">Password</label>
                                                            <div>
                                                                <span class="input-wrapper">
                                                                    <input
                                                                        class="input pr-8"
                                                                        type="password"
                                                                        name="password"
                                                                        autocomplete="off"
                                                                        placeholder="Password"
                                                                        value=""
                                                                    >
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-solid w-full" type="submit">Sign In</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>                
			</div>
		</div>

		<!-- Core Vendors JS -->
		<script src="{{ url('public/admin-assets/js/vendors.min.js') }}"></script>

		<!-- Other Vendors JS -->

		<!-- Page js -->

		<!-- Core JS -->
		<script src="{{ url('public/admin-assets/js/app.min.js') }}"></script>
	</body>

</html>