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
                           Confirm Orders
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
                                        <th>Publish Date</th>
                                        <th>Expire Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderProjects as $index => $orderProject)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $orderProject->name }}</td>
                                            <td>{{ $orderProject->category?->name ?? 'N/A' }}</td>
                                            @if($orderProject->project_file)
                                                <td><img src="{{ asset($orderProject->project_file) }}" alt="Image" width="40"></td>
                                            @else
                                                <td><span class="badge badge-danger">No Logo Attached!</span></td>
                                            @endif
                                            <td>{{ \Carbon\Carbon::parse($orderProject->publish_date)->format('d M, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($orderProject->expire_date)->format('d M, Y') }}</td>
                                            <td>
                                                <a class="btn btn-xs btn-info" href="{{ route('designer.order-delivery',$orderProject->id) }}">
                                                   View
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
