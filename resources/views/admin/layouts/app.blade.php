<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="shortcut icon" href="{{ url('public/assets/images/icon.png') }}">
		<title>Admin Dashboard </title>
		<link rel="stylesheet" type="text/css" href="{{ url('public/admin-assets/css/style.css') }}">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<style>
		    .invalid-feedback
		    {
		        display:block!important;
		    }
		    .dt-button
		    {
		        background-color: var(--primary-color-600)!important;
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity)) !important;
                height: 2.75rem!important;
                white-space: nowrap!important;
                border-radius: 0.375rem!important;
                padding-left: 2rem!important;
                padding-right: 2rem!important;
                padding-top: 0.5rem!important;
                padding-bottom: 0.5rem!important;
                font-weight: 600!important;
            }
            div.dt-buttons {
                position: relative!important;
                float: right!important;
                margin: 10px!important;
            }
            .paging_simple_numbers
            {
                float:right!important;
                margin:5px!important;
            }
            tfoot
            {
                --tw-bg-opacity: 1;
                background-color: rgb(249 250 251 / var(--tw-bg-opacity));
            }
		</style>
	</head>
	<body>
		<div id="root">
			<div class="app-layout-classic flex flex-auto flex-col">
				<div class="flex flex-auto min-w-0">
					<div class="side-nav side-nav-light side-nav-expand">
						<div class="side-nav-header">
							<div class="px-6">
								<a href="{{ route('home') }}"><img src="{{ url('public/assets/images/scopnixlogo.png') }}" alt="" style="width:50%"></a>
							</div>
						</div>
						@include('admin/layouts/menus.'.Auth::user()->type.'_sidebar')
					</div>
					<div class="flex flex-col flex-auto min-h-screen min-w-0 relative w-full">
						<header class="header border-b border-gray-200 dark:border-gray-700">
							<div class="header-wrapper h-16">
								<div class="header-action header-action-start">
									<div id="side-nav-toggle" class="side-nav-toggle header-action-item header-action-item-hoverable">
										<div class="text-2xl">
											<svg class="side-nav-toggle-icon-expand" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
											</svg>
											<svg class="side-nav-toggle-icon-collapsed hidden" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
												<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
											</svg>
										</div>
									</div>
									<div class="side-nav-toggle-mobile header-action-item header-action-item-hoverable" data-bs-toggle="modal" data-bs-target="#mobile-nav-drawer">
										<div class="text-2xl">
											<svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
											</svg>
										</div>
									</div>
								</div>
								<div class="header-action header-action-end">
									<div class="dropdown">
										<div class="dropdown-toggle" id="user-dropdown" data-bs-toggle="dropdown">
											<div class="header-action-item flex items-center gap-2">
												<div class="hidden md:block">
												    <div class="text-xs capitalize">{{ ucwords(Auth::user()->name) }}</div>
													<div class="font-bold">{{ ucwords(Auth::user()->name) }}</div>
												</div>
											</div>
										</div>
										<ul class="dropdown-menu bottom-end min-w-[240px]">
											<li class="menu-item-header">
												<div class="py-2 px-3 flex items-center gap-2">
													<div>
														<div class="font-bold text-gray-900 dark:text-gray-100">{{ ucwords(Auth::user()->name) }}</div>
														<div class="text-xs">{{ Auth::user()->email }}</div>
													</div>
												</div>
											</li>
											<li id="menu-item-29-2VewETdxAb" class="menu-item-divider"></li>
											<li class="menu-item menu-item-hoverable gap-2 h-[35px]">
											   <a class="flex gap-2 items-center" href="{{ route('logout') }}">
												<span class="text-xl opacity-50">
													<svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
													</svg>
												</span>
												<span>Sign Out</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</header>
						@include('admin/layouts/mobile.'.Auth::user()->type.'_sidebar')
						@yield('content')
						 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                             <script type="text/javascript">
                                function del_func(id, model)
                                {
                                    var conf= confirm('Are you sure to delete this?');
                                    if(conf===true)
                                    {
                                        $.ajax({
                            				url:"{{ route('admin.del.function') }}",
                            				data:
                            				{
                            				    _token: '{{ csrf_token() }}',
                            					id:id,
                            					model:model,
                            				},
                            				type:'POST',
                            				success: function(data)
                            				{
                            				    if(data=='2')
                            				    {
                            				        alert('Error Occured, Please Try Later');
                            				    }
                            				    Swal.fire({
                                                title: 'Hurray!',
                                                text: "Record Deleted Successfully",
                                                    icon: "success",
                                                    buttonsStyling: false,
                                                    confirmButtonText: "Ok",
                                                    customClass: {
                                                        confirmButton: "btn bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white"
                                                    }
                                                });
                            				 $("#user-table").load(location.href+" #user-table>*",""); 
                            				 $("#table").load(location.href+" #table>*",""); 
                            				}
                                		});
                                    }
                                }
                            </script>  
							<footer class="footer flex flex-auto items-center h-16 px-4 sm:px-6 md:px-8">
								<div class="flex items-center justify-between flex-auto w-full">
									<span>Copyright © {{ date('Y') }} <span class="font-semibold">Scopnix Solar</span> All rights reserved.</span>
								</div>
								
							</footer>
							
						</div>
						</div>
				</div>
			</div>
		</div>
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
                            confirmButton: "btn bg-sky-600 btn-solid"
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
                            confirmButton: "btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white"
                        }
                    });
        });
      </script>
      @php
        session()->forget('error');
      @endphp
      @endif
      
		<script src="{{ url('public/admin-assets/js/vendors.min.js') }}"></script>
		<script src="{{ url('public/admin-assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('public/admin-assets/vendors/datatables/dataTables.custom-ui.min.js') }}"></script>
        <script src="{{ url('public/admin-assets/js/pages/wallets.js') }}"></script>
        <script src="{{ url('public/admin-assets/js/pages/table-demo.js') }}"></script>
		<script src="{{ url('public/admin-assets/js/app.min.js') }}"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
        @if(request()->segment(2) == 'reports' || request()->segment(2) == 'users' || request()->segment(2) == 'running-loans' || request()->segment(2) == 'due-loans' || request()->segment(2) == 'paid-loans')
        	<script>
		    $(document).ready(function() {
		        $('#data-table').DataTable().destroy();
                $('#data-table').DataTable( {
                    dom: 'fBrtip',
                    buttons: [
                        'copy', 'pdf', 'excel', 'print'
                    ]
                } );
            } );
		</script>
		@endif
		
		
	</body>

</html>
