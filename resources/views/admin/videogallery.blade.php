@extends('admin.layouts.app')

@section('content')
<div class="h-full flex flex-auto flex-col justify-between">
							<!-- Content start -->
							<main class="h-full">
								<div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
                                    <div class="container mx-auto">
                                        <div class="card adaptable-card">
                                            <div class="card-body">
                                                <div class="lg:flex items-center justify-between mb-4">
                                                    <h3 class="mb-4 lg:mb-0">Video Gallery</h3>
                                                    <div class="inline-flex flex-wrap xl:flex gap-2 my-4">
                                                <a href="{{ route('admin.add_video') }}" class="btn btn-solid">Add Video</a>
                                            </div>
                                                </div>
                                                <div class="overflow-x-auto" id="DataTable">
                                                    <table id="data-table" class="table-default table-hover data-table">
                                                        <thead>
                                                            <tr>
                                                                 <th>Id</th>
                                                                <th>Video</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            @if( count($gallery) > 0 )
                                                                @foreach($gallery as $image)
                                                                <td>#{{ $image->id }}</td>
                                                                        <td>@if($image->type == 'youtube')
                                                                                <iframe 
                                                                                    src="{{ $image->video }}" 
                                                                                    frameborder="0" 
                                                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                                                    allowfullscreen>
                                                                                </iframe>
                                                                            @else
                                                                                <video controls style="width:200px">
                                                                                    <source src="{{ url('public/videogallery/' .$image->video) }}" type="video/mp4" >
                                                                                    Your browser does not support the video tag.
                                                                                </video>
                                                                            @endif</td>
                                                                         <td>
                                                                            <div class="flex justify-end text-lg">
                                                                                <a href="{{ route('admin.edit_video', ['id' => $image->id]) }}">
                                                                                <span class="cursor-pointer p-2 hover:text-indigo-600">
                                                                                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                                                    </svg>
                                                                                </span>
                                                                                </a>
                                                                                <a href="{{ route('admin.delete_video', $image->id) }}">
                                                                                     <span class="cursor-pointer p-2 hover:text-red-500">
                                                                                        <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
							</main>
							@endsection