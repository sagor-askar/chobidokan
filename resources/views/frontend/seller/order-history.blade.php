@extends('layouts.designer_panel')
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
                        Order History
                    </div>
                    <div class="panel-body">
                        @if(count($orderHistories) > 0 )
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="subCompany-dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project Name</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Publish Date</th>
                                    <th>Expire Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderHistories as $index => $project)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $project->name }}</td>
                                            <td>{{ $project->category?->name ?? 'N/A' }}</td>
                                            <td>{{ $project?->order?->amount }} TK.</td>
                                            <td>{{ \Carbon\Carbon::parse($project->publish_date)->format('d M, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($project->expire_date)->format('d M, Y') }}</td>
                                            <td>
                                                @if($project->status == 2)
                                                    <span class="badge bg-success">Completed</span>
                                                @else
                                                    <span class="badge bg-secondary">Failed</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a class="btn btn-xs btn-info" href="{{ route('designer.order.submitted-file',$project->id) }}">
                                                    <i class="fa fa-eye mr-2"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="pagination-wrapper d-flex justify-content-center mt-4">
                            {{ $orderHistories->withQueryString()->links('pagination.custom') }}
                        </div>
                        @else
                            <div class="col-12 text-center py-4">
                                <p class="mb-0 text-danger">No Order History available yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
