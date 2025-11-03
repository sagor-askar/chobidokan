@extends('layouts.admin')
@section('content')

    <style>
        .project-header {
            background-color: #f8f9fa; /* subtle light background */
            padding: 20px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .project-header h3 {
            font-size: 22px;
            font-weight: 700;
            color: #343a40; /* professional dark color */
            margin: 0;
        }

        .project-title {
            color: #0d6efd; /* highlight project name with primary color */
        }

    </style>
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
                        Designer List
                    </div>
                    <div class="panel-body">
                        <div class="card-header text-center project-header">
                            <h3>Project: <span class="project-title">{{ @$designers[0]->project?->name ?? 'N/A' }}</span></h3>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="subCompany-dataTable">
                                <thead>
                                <tr>
                                    <th>

                                    </th>
                                    <th>
                                        Designer Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Phone
                                    </th>

                                    <th>
                                        Submit Date
                                    </th>

                                    <th>
                                        Total Submitted Design
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($designers as $key => $designer)
                                    @php
                                       $totalSubmit = \App\Models\ProjectSubmit::where('project_id', $designer->project_id)
                                                        ->where('user_id', $designer->user_id)
                                                        ->withCount('uploads')
                                                        ->get()
                                                        ->sum('uploads_count');
                                    @endphp
                                    <tr data-entry-id="{{ $designer->id }}">
                                        <td>

                                        </td>

                                        <td>
                                           {{ $designer->user?->name ?? '' }}
                                        </td>
                                        <td>
                                          {{ $designer->user?->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $designer->user?->phone ?? '' }}
                                        </td>


                                        <td class="{{ \Carbon\Carbon::parse($designer->submit_date)->isPast() ? 'text-danger' : 'text-success' }}">
                                            {{ \Carbon\Carbon::parse($designer->submit_date)->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            {{ $totalSubmit}}
                                        </td>

                                        <td>

                                            <a class="btn btn-xs btn-primary" href="{{ route('admin.project.design-submit-show', [$designer->project_id,$designer->user_id]) }}">
                                                {{ trans('global.view') }}
                                            </a>

                                            <form action="{{ route('admin.project.delete', $designer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

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
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
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

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true
                , order: [
                    [1, 'desc']
                ]
                , pageLength: 100
                , });
            let table = $('.datatable-SubCompany:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>

@endsection
