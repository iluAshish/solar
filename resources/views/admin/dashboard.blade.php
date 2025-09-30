@extends('admin.layouts.app')

@section('content')
<div class="h-full flex flex-auto flex-col justify-between">
							<!-- Content start -->
							<main class="h-full">
								<div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
                                    <div class="flex flex-col gap-4 h-full">
                                        <div class="lg:flex items-center justify-between mb-4 gap-3">
                                            <div class="mb-4 lg:mb-0">
                                                <h3>Howdy {{ ucwords(Auth::user()->name) }}!</h3>
                                                <p>View your current analytics & stats</p>
                                            </div>
                                            <div class="flex flex-col lg:flex-row lg:items-center gap-3">
                                                <b>{{ date('dS M, Y') }}</b>
                                            </div>
                                        </div>
                                        @php
                                        $user = DB::table('books')->count();
                                        @endphp
                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                            <div class="card card-layout-frame">
                                                <div class="card-body">
                                                    <h6 class="font-semibold mb-4 text-sm">Total Booking</h6>
                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <h3 class="font-bold">
                                                                <span>{{ $user }} <small></small></span>
                                                            </h3>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         @php
                                        $plan = DB::table('franchises')->count();
                                        @endphp
                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                            <div class="card card-layout-frame">
                                                <div class="card-body">
                                                    <h6 class="font-semibold mb-4 text-sm">Franchise Application</h6>
                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <h3 class="font-bold">
                                                                <span>{{ $plan }} <small></small></span>
                                                            </h3>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
							</main>
							@endsection
						