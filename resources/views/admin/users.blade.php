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
                                                    <h3 class="mb-4 lg:mb-0">User List</h3>
                                                </div>
                                                <div class="overflow-x-auto" id="DataTable">
                                                    <table id="data-table" class="table-default table-hover data-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Mobile</th>
                                                                <th>Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if( count($users) > 0 )
                                                            @php $i=1; @endphp
                                                                @foreach($users as $user)
                                                                    @php
                                                                        $words = explode(' ', $user->name);
                                                                        $initials = '';
                                                                        
                                                                        foreach ($words as $word) {
                                                                            $initials .= strtoupper(substr($word, 0, 1));
                                                                        }
                                                                    @endphp
                                                                        <td>
                                                                            <div class="flex items-center">
                                                                                <span class="avatar avatar-rounded avatar-md mr-4 bg-primary-100 text-primary-600 dark:bg-primary-500/20 dark:text-primary-100">
                                                                                    <span class="avatar-string avatar-inner-md">{{ $initials }}</span>
                                                                                </span>
                                                                                <span class="ml-2 rtl:mr-2 font-semibold">{{ $user->name }}</span>
                                                                            </div>
                                                                            
                                                                        </td>
                                                                        <td>{{ $user->email }}</td>
                                                                        <td>{{ $user->phone }}</td>
                                                                        <td>
                                                                            <span>{{ date('dS M, Y', strtotime($user->updated_at)) }}</span>
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