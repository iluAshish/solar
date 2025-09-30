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
                                                    <h3 class="mb-4 lg:mb-0">Booking List</h3>
                                                </div>
                                                <div class="overflow-x-auto" id="DataTable">
                                                    <table id="data-table" class="table-default table-hover data-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Product</th>
                                                                <th>Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            @if( count($book) > 0 )
                                                                @foreach($book as $transactions)
                                                                        <td>{{ $transactions->name }}</td>
                                                                        <td>{{ $transactions->email }}</td>
                                                                        <td>{{ $transactions->phone }}</td>
                                                                        <td>{{ $transactions->product }}</td>
                                                                        <td>
                                                                            <span>{{ date('dS M, Y', strtotime($transactions->updated_at)) }}</span>
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