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
                            Order List
                        </div>
                        <div class="panel-body">
                            @if(count($orderProjects) > 0 )
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
                                        <th>Submission Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderProjects as $index => $orderProject)

                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <a title="Details" href="{{ route('customize-details',$orderProject->id) }}">{{ $orderProject->name }}</a>
                                            </td>
                                            <td>{{ $orderProject->category?->name ?? 'N/A' }}</td>
                                            @if($orderProject->project_file)
                                                <td><img src="{{ asset($orderProject->project_file) }}" alt="Image" height="60" width="auto"></td>
                                            @else
                                                <td><span class="badge badge-danger">No Logo Attached!</span></td>
                                            @endif
                                            <td>{{ $orderProject?->order->amount }} TK.</td>
                                            <td>{{ \Carbon\Carbon::parse($orderProject->publish_date)->format('d M, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($orderProject->expire_date)->format('d M, Y') }}</td>

                                            @if(count($orderProject->orderDetails) > 0)
                                                <td>
                                                    <span class="badge badge-info" style="background-color: green">Submitted</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge badge-danger">Pending</span>
                                                </td>
                                            @endif

                                            <td>
                                                <a class="btn btn-xs btn-info" href="{{ route('user.order.submitted-file',$orderProject->id) }}">
                                                    <i class="fa fa-eye mr-2"></i>
                                                </a>
                                            </td>
                                        </tr>

                                     @endforeach
                                    </tbody>


                                </table>

                            </div>
                            <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                {{ $orderProjects->withQueryString()->links('pagination.custom') }}
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
