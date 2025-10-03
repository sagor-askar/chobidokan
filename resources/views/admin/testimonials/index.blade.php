@extends('layouts.admin')
@section('content')
<div class="content">
    @can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.testimonials.create') }}">
                Add Testimonial
            </a>
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Testimonials - User Review
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable datatable-Testimonial" id="testimonial-dataTable">
                            <thead>
                                <tr>
                                    <th width="10"></th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Designation
                                    </th>
                                    <th>
                                        Speech
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($testimonial as $key => $testimonials)
                                <tr data-entry-id="{{ $testimonials->id }}">
                                    <td></td>
                                    <td>
                                        {{ $testimonials->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $testimonials->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $testimonials->designation ?? '' }}
                                    </td>
                                    <td>
                                        {{ $testimonials->speech ?? '' }}
                                    </td>
                                    <td>
                                        {{-- view --}}
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.testimonials.show', $testimonials->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                        {{-- edit --}}
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.testimonials.edit', $testimonials->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                        {{-- delete --}}
                                        <form action="{{ route('admin.testimonials.destroy', $testimonials->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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


        let dtButtons = $.extend(true, [], defaultButtons);

        @can('faq_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans
            , url: "{{ route('admin.testimonial.massDestroy') }}"
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
                            'x-csrf-token': '{{ csrf_token() }}'
                        }
                        , method: 'POST'
                        , url: config.url
                        , data: {
                            ids: ids
                            , _method: 'DELETE'
                        }
                    }).done(function() {
                        location.reload()
                    })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        initDataTable('#testimonial-dataTable', dtButtons);
    });

</script>
@endsection
