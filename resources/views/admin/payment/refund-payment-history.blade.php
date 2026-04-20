@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4> Refund Payment History </h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="project-dataTable">
                                <thead>
                                <tr>
                                    <th>

                                    </th>

                                    <th>
                                        Project
                                    </th>

                                    <th>
                                        Customer
                                    </th>

                                    <th>
                                        Amount
                                    </th>

                                    <th>
                                        Card-Type
                                    </th>

                                    <th>
                                        Bank Transaction Id
                                    </th>
                                    <th>
                                        Date
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($refundPaymentHistories as $key => $refundPaymentHistory)

                                    <tr data-entry-id="{{ $refundPaymentHistory->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $refundPaymentHistory->project?->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $refundPaymentHistory->user?->name ?? '' }}
                                        </td>

                                        <td>  <strong>{{ number_format($refundPaymentHistory->amount ?? 0, 2) }} </strong> Tk.</td>
                                        <td>
                                            {{ $refundPaymentHistory->card_type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $refundPaymentHistory->bank_txn ?? '' }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($refundPaymentHistory->created_at)->format('d-m-Y')  }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if ($refundPaymentHistories->hasPages())
                                {{ $refundPaymentHistories->links() }}
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
