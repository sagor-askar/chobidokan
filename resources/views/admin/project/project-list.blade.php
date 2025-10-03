@extends('layouts.admin')
@section('content')
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Project List
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="project-dataTable">
                                <thead>
                                <tr>
                                    <th>

                                    </th>
                                    <th>
                                       Project Name
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Customer
                                    </th>
                                    <th>
                                        Amount
                                    </th>

                                    <th>
                                        Expire Date
                                    </th>

                                    <th>
                                        T.Designer
                                    </th>

                                    <th>
                                        T.Submitted Design
                                    </th>
                                    <th>
                                       Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $key => $project)
                                    <tr data-entry-id="{{ $project->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $project->name ?? '' }}
                                        </td>

                                        @if($project->project_file)
                                            <td><img src="{{ asset($project->project_file) }}" alt="Image" width="40"></td>
                                        @else
                                            <td><span class="badge badge-danger">No Logo Attached!</span></td>
                                        @endif

                                        <td>
                                            {{ $project->category?->name ?? '' }}
                                        </td>

                                        <td>
                                            <p style="color:steelblue "><b>{{ $project->user?->name ?? '' }}</b></p>
                                            <p style="color:lightseagreen " >{{ $project->user?->email ?? '' }}</p>
                                        </td>

                                        <td>
                                            {{ $project->order?->amount ?? '' }}
                                        </td>

                                        <td class="{{ \Carbon\Carbon::parse($project->expire_date)->isPast() ? 'text-danger' : 'text-success' }}">
                                            {{ \Carbon\Carbon::parse($project->expire_date)->format('d-m-Y') }}
                                        </td>

                                        <td>
                                            {{ $project->total_designer ?? '' }}
                                        </td>
                                        <td>
                                            {{ $project->total_submitted_design ?? '' }}
                                        </td>

                                        @if($project->status == 1)
                                            <td>
                                                <span class="badge badge-info" style="background-color: green">Active</span>
                                            </td>
                                        @elseif($project->status == 2)
                                            <td>
                                                <span class="badge badge-success">Inactive</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-danger">Inactive</span>
                                            </td>
                                        @endif

                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('admin.project.details', $project->id) }}">
                                                <i class="fa fa-list"></i> Details
                                            </a>

                                            <form action="{{ route('admin.project.delete', $project->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if ($projects->hasPages())

                                {{ $projects->links() }}
                            @endif
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], defaultButtons);
            @can('category_delete')
            let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
            let deleteButton = {
                text: deleteButtonTrans
                , url: "{{ route('admin.categories.massDestroy') }}"
                , className: 'btn-danger'
                , action: function(e, dt, node, config) {
                    var ids = $.map(dt.rows({
                        selected: true
                    }).nodes(), function(entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('
                        global.datatables.zero_selected ') }}')

                        return
                    }

                    if (confirm('{{ trans('
                        global.areYouSure ') }}')) {
                        $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            }
                            , method: 'POST'
                            , url: config.url
                            , data: {
                                ids: ids
                                , _method: 'DELETE'
                            }
                        })
                            .done(function() {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            initDataTable('#project-dataTable', dtButtons);

        })

    </script>

@endsection
