@extends('layouts.user_panel')
@section('panel_content')
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="card-header">
                        Order History List
                    </div>
                    <div class="panel-body">
                        @if(count($orderHistoryProjects) > 0 )
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="subCompany-dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project Name</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Amount</th>
                                        <th>Publish Date</th>
                                        <th>Expire Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderHistoryProjects as $index => $orderHistory)

                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <a title="Details" href="{{ route('customize-details',$orderHistory->id) }}">{{ $orderHistory->name }}</a>
                                            </td>
                                            <td>{{ $orderHistory->category?->name ?? 'N/A' }}</td>
                                            @if($orderHistory->project_file)
                                                <td><img src="{{ asset($orderHistory->project_file) }}" alt="Image" height="60" width="auto"></td>
                                            @else
                                                <td><span class="badge badge-danger">No Logo Attached!</span></td>
                                            @endif

                                            @if($orderHistory->status == 2)
                                            <td>{{ $orderHistory?->order->amount }} TK. </td>
                                            @elseif($orderHistory->status == 0)
                                                <td>
                                                    <p>{{ $orderHistory?->order->amount }} TK. <span class="badge badge-info" style="background-color: green">Refunded</span></p>

                                                </td>
                                            @endif
                                            <td>{{ \Carbon\Carbon::parse($orderHistory->publish_date)->format('d M, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($orderHistory->expire_date)->format('d M, Y') }}</td>

                                            @if($orderHistory->status == 2)
                                                <td>
                                                    <span class="badge badge-info" style="background-color: green">Completed</span>
                                                </td>
                                            @elseif($orderHistory->status == 0)
                                                <td>
                                                    <span class="badge badge-danger">Rejected</span>
                                                </td>
                                            @endif

                                            <td>
                                                <a class="btn btn-xs btn-info" href="{{ route('user.order.submitted-file',$orderHistory->id) }}">
                                                    <i class="fa fa-eye mr-2"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>


                                </table>

                            </div>
                            <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                {{ $orderHistoryProjects->withQueryString()->links('pagination.custom') }}
                            </div>
                        @else
                            <div class="col-12 text-center py-4">
                                <p class="mb-0 text-danger">No submissions available yet.</p>
                            </div>
                        @endif
                    </div>
                </div>



            </div>
        </div>
    </div>



@endsection
