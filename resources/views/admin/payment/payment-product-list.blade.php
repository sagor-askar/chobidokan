@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Product Payment  List</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="project-dataTable">
                                <thead>
                                <tr>
                                    <th>

                                    </th>
                                    <th>
                                        Product Name
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
                                        Paid Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productSaleslist as $key => $productSales)
                                    <tr data-entry-id="{{ $key }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $productSales->product->title ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $productSales->user->name ?? 'Guest' }}
                                        </td>
                                        <td> Tk. {{ number_format($productSales->amount ?? 0, 2) }}</td>
                                        <td>
                                            {{ $productSales->designer->name ?? 'N/A' }}
                                        </td>
                                        <td> Tk. {{ number_format($productSales->earning_amount ?? 0, 2) }}</td>

                                        @if($productSales->designer_paid_status == 1)
                                            <td>
                                                <span class="badge badge-success" style="background-color: green">Paid</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-danger" style="background-color: #e38f83">Unpaid</span>
                                            </td>
                                        @endif
                                        <td>
                                            <form action="{{ route('admin.designer.product.payment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $productSales->product->id ?? '' }}">
                                                <input type="hidden" name="payment_id" value="{{ $productSales->payment_id ?? '' }}">
                                                <input type="hidden" name="designer_id" value="{{ $productSales->designer->id ?? '' }}">
                                                <input type="hidden" name="user_id" value="{{ $productSales->user->id ?? '' }}">
                                                <input type="hidden" name="amount" value="{{ $productSales->earning_amount }}">
                                                <button type="submit" class="btn btn-xs btn-warning">
                                                    Pay
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if ($productSaleslist->hasPages())
                                {{ $productSaleslist->links() }}
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
