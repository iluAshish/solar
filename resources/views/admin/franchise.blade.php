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
                                                    <h3 class="mb-4 lg:mb-0">Franchise Applications List</h3>
                                                </div>
                                                <div class="overflow-x-auto" id="DataTable">
                                                    <table id="data-table" class="table-default table-hover data-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Occupation</th>
                                                                 <th>City</th>
                                                                  <th>State</th>
                                                                   <th>Preferred Location</th>
                                                                    <th>Investment</th>
                                                                     <th>Where Hear about Us</th>
                                                                      <th>Why Interested</th>
                                                                <th>Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            @if( count($franchise) > 0 )
                                                                @foreach($franchise as $transactions)
                                                                        <td>{{ $transactions->name }}</td>
                                                                        <td>{{ $transactions->email }}</td>
                                                                        <td>{{ $transactions->phone }}</td>
                                                                        <td>{{ $transactions->occupation }}</td>
                                                                         <td>{{ $transactions->city }}</td>
                                                                          <td>{{ $transactions->state }}</td>
                                                                           <td>{{ $transactions->location }}</td>
                                                                            <td>{{ $transactions->investment }}</td>
                                                                             <td>{{ $transactions->hear }}</td>
                                                                              <td>{{ $transactions->interested }}</td>
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