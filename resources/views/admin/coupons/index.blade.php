@extends('layouts.admin')
@section('content')
<div class="content">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.coupons.create') }}">
                Add Coupon
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Coupon List
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable datatable-coupon" id="coupon-dataTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Code</th>
                                    <th>Discount Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $key => $coupon)
                                <tr data-entry-id="{{ $coupon->id }}">
                                    <td></td>
                                    <td>{{ $coupon->code ?? '' }}</td>
                                    <td>
                                        @if($coupon->type == 'fixed')
                                            <span class="badge badge-info" style="background-color: #3b5998;">Fixed</span>
                                        @else
                                            <span class="badge badge-warning" style="background-color: #f0ad4e;">Percentage</span>
                                        @endif
                                    </td>
                                    <td>{{ $coupon->discount ?? '' }}</td>
                                    <td>
                                        @if($coupon->status == 1)
                                            <span class="badge badge-success" style="background-color: green;">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.coupons.edit', $coupon->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>

                                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($coupons->hasPages())
                        {{ $coupons->links() }}
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

        // Assume mass delete action
        let deleteButtonTrans = '{{ trans("global.datatables.delete") }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.coupons.massDestroy') }}",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function(entry) {
                    return $(entry).data('entry-id');
                });

                if (ids.length === 0) {
                    alert('{{ trans("global.datatables.zero_selected") }}');
                    return;
                }

                if (confirm('{{ trans("global.areYouSure") }}')) {
                    $.ajax({
                        headers: { 'x-csrf-token': _token },
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' }
                    }).done(function() {
                        location.reload();
                    });
                }
            }
        };
        dtButtons.push(deleteButton);

        initDataTable('#coupon-dataTable', dtButtons);
    });
</script>
@endsection
