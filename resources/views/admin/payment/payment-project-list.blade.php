@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                     <h4> Project Payment List</h4>
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
                                       Designer
                                    </th>

                                    <th>
                                        Designer Amount
                                    </th>


                                    <th>
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderDetails as $key => $orderDetail)
                                    @php
                                        $payable_amount = $orderDetail->order->amount - ($orderDetail->order->amount * ($adminPercentage / 100));
                                    @endphp
                                    <tr data-entry-id="{{ $orderDetail->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $orderDetail->project?->name ?? '' }}
                                        </td>

                                        <td>
                                            {{ $orderDetail->project?->user?->name ?? '' }}
                                        </td>

                                        <td> Tk. {{ number_format($orderDetail->order->amount ?? 0, 2)  }}</td>
                                        <td>
                                            {{ $orderDetail->designer->name ?? '' }}
                                        </td>
                                        <td> Tk. {{ number_format($payable_amount ?? 0, 2)  }}</td>

                                        <td>
                                            <form action="{{ route('admin.designer.project.payment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="project_id" value="{{$orderDetail->project_id}}">
                                                <input type="hidden" name="order_id" value="{{$orderDetail->order_id}}">
                                                <input type="hidden" name="designer_id" value="{{$orderDetail->designer_id}}">
                                                <input type="hidden" name="user_id" value="{{$orderDetail->project->user_id}}">
                                                <input type="hidden" name="amount" value="{{$payable_amount}}">
                                                <button type="submit" class="btn btn-xs btn-warning">
                                                    Pay
                                                </button>
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if ($orderDetails->hasPages())
                                {{ $orderDetails->links() }}
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
