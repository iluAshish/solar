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
                                                    <span>Update Video</span><br>
                                                    <span class="text-sm"></span>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="xl:flex gap-4">
                                            <div class="w-full">
                                                <div class="card adaptable-card">
                                                    <div class="card-body">
                                                        
                                                             <form action="{{ route('admin.update_video', $video->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-container vertical">
                                                                <div class="grid grid-cols-2 gap-4">
                                                                    <div class="form-item vertical">
                                                                        <label class="form-label mb-1">Video Type:</label>
                                                                        <div>
                                                                           <select class="input" name="type" id="type" onchange="toggleUrlInput(this.value)" required>
                                                                               <option value="youtube" {{ $video->type == 'youtube' ? 'selected' : '' }}>YouTube Link</option>
        <option value="upload" {{ $video->type == 'upload' ? 'selected' : '' }}>Upload Video</option>
                                                                            </select>

                                                                            @error('type')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                     <div class="form-item vertical" id="youtube_input" style="display: none;">
                                                                        <label class="form-label mb-1">YouTube URL:</label>
                                                                        <div>
                                                                            <iframe 
                                                                                    src="{{ $video->video }}" 
                                                                                    frameborder="0" 
                                                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                                                    allowfullscreen>
                                                                                </iframe>
                                                                            <input class="input" type="video" name="video" placeholder="Enter YouTube URL">
                                                                            @error('video')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                     <div class="form-item vertical" id="upload_input" style="display: none;">
                                                                        <label class="form-label mb-1">Upload Video:</label>
                                                                        <div>
                                                                            <video controls style="width:200px">
                                                                                    <source src="{{ url('public/videogallery/' .$video->video) }}" type="video/mp4" >
                                                                                    Your browser does not support the video tag.
                                                                                </video>
                                                                            <input class="input" type="file" name="video" accept="video/*">
                                                                            @error('video')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-item vertical col-span-2"><label class="form-label"></label>
                                                                        <div>
                                                                            <button class="btn btn-solid bg-sky-600" type="submit">
                                                                               Update
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
							<script>
    function toggleUrlInput() {
        var type = document.getElementById('type').value;
        document.getElementById('youtube_input').style.display = type === 'youtube' ? 'block' : 'none';
        document.getElementById('upload_input').style.display = type === 'upload' ? 'block' : 'none';
    }
    window.onload= toggleUrlInput();
</script>
							@endsection