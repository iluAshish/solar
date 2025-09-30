@extends('layouts.app')

@section('content')
<div class="h-full flex flex-auto flex-col justify-between">
							<main class="h-full">
								<div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
                                    <div class="container mx-auto">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3>Account Settings</h3>
                                        </div>
                                        <div class="card adaptable-card">
                                            <div class="card-body">
                                                <div class="tabs">
                                                    <div role="tablist" class="tab-list tab-list-underline">
                                                        <button class="tab-nav tab-nav-underline active" data-bs-toggle="tab" data-bs-target="#tab-password" role="tab" aria-selected="false" tabindex="0">
                                                            Password
                                                        </button>
                                                    </div>
                                                    <div class="tab-content px-4 py-6">
                                                        <div class="tab-pane fade active show" id="tab-password" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                                            <form action="{{ route('admin.change.password') }}" method="post">
                                                                <div class="form-container vertical">
                                                                    <div>
                                                                        <h5>Password</h5>
                                                                        <p>Enter your current &amp; new password to reset your password</p>
                                                                    </div>
                                                                    <div class="grid md:grid-cols-3 gap-4 py-8 border-b border-gray-200 dark:border-gray-600 items-center">
                                                                        <div class="font-semibold">Current Password</div>
                                                                        <div class="col-span-2">
                                                                            <div class="form-item vertical mb-0 max-w-[700px]">
                                                                                @csrf
                                                                                <label class="form-label"></label>
                                                                                <div>
                                                                                    <input class="input" type="password" autocomplete="off" placeholder="Current Password" value="" name="current_password">
                                                                                </div>
                                                                                 @error('current_password')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid md:grid-cols-3 gap-4 py-8 border-b border-gray-200 dark:border-gray-600 items-center">
                                                                        <div class="font-semibold">New Password</div>
                                                                        <div class="col-span-2">
                                                                            <div class="form-item vertical mb-0 max-w-[700px]">
                                                                                <label class="form-label"></label>
                                                                                <div>
                                                                                    <input class="input" type="password" name="password" autocomplete="off" placeholder="New Password" value="">
                                                                                </div>
                                                                                 @error('password')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-4 flex ltr:justify-end gap-2">
                                                                        <button class="btn btn-solid" type="submit">Update Password</button>
                                                                    </div>
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
						@endsection