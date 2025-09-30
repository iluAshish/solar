@extends('admin.layouts.app')

@section('content')
<div class="h-full flex flex-auto flex-col justify-between">
							<!-- Content start -->
							<main class="h-full">
								<div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
                                    <div class="container mx-auto">
                                        <div class="mb-6">
                                            <div class="flex items-center mb-1">
                                                <h3>
                                                    <span>Add Images</span><br>
                                                    <span class="text-sm"></span>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="xl:flex gap-4">
                                            <div class="w-full">
                                                <div class="card adaptable-card">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.imagegallery.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-container vertical">
                                                                <div class="grid grid-cols-2 gap-4">
                                                                    <div class="form-item vertical">
                                                                        <label class="form-label mb-1">Upload Images</label>
                                                                        <div>
                                                                            <input class="input" type="file" name="images[]" id="images" multiple accept="image/*">
                                                                            @error('images')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-item vertical col-span-2"><label class="form-label"></label>
                                                                        <div>
                                                                            <button class="btn btn-solid bg-sky-600" type="submit">
                                                                               Add
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>    
                                </div>
							</main>


							@endsection