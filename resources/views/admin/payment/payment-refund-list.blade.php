@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4> Payment Refund List</h4>
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
                                        Customer
                                    </th>

                                    <th>
                                        Order Amount
                                    </th>

                                    <th>
                                        Refund Amount
                                    </th>

                                    <th>
                                        Refund Status
                                    </th>


                                    <th>
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($paymentRefundOrders as $key => $paymentRefundOrder)
                                    @php
                                        $payable_amount = $paymentRefundOrder->order->amount - ($paymentRefundOrder->order->amount * ($adminPercentage / 100));
                                    @endphp
                                    <tr data-entry-id="{{ $paymentRefundOrder->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $paymentRefundOrder->project?->name ?? '' }}
                                        </td>

                                        <td>
                                            {{ $paymentRefundOrder->project?->user?->name ?? '' }} <br>
                                            {{ $paymentRefundOrder->project?->user?->email ?? '' }}

                                        </td>

                                        <td> Tk. {{ number_format($paymentRefundOrder->order->amount ?? 0, 2)  }}</td>

                                        <td> Tk. {{ number_format($payable_amount ?? 0, 2)  }}</td>

                                        @if($paymentRefundOrder->designer_paid_status == 1)
                                            <td>
                                                <span class="badge badge-success" style="background-color: green">Paid</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-danger" style="background-color: #e38f83">Unpaid</span>
                                            </td>
                                        @endif

                                        <td>
                                            <form action="{{ route('admin.refund.project.payment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="payment_id" value="{{$paymentRefundOrder->id}}">
                                                <input type="hidden" name="amount" value="{{$payable_amount}}">
                                                <button type="submit" class="btn btn-xs btn-warning">
                                                   Refund Pay
                                                </button>
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if ($paymentRefundOrders->hasPages())
                                {{ $paymentRefundOrders->links() }}
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
