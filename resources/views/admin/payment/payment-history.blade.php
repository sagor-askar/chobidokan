@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4> Designer Payment History </h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="project-dataTable">
                                <thead>
                                <tr>
                                    <th>

                                    </th>
                                    <th>
                                        Designer
                                    </th>

                                    <th>
                                        Customer
                                    </th>

                                    <th>
                                         Product/Project
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
                                @foreach($designerPaymentHistories as $key => $designerPaymentHistory)
                                    @php
                                      $productName='';
                                     if ($designerPaymentHistory->project_id){
                                          $productName = $designerPaymentHistory->project->name;
                                     }else{
                                         $productName = $designerPaymentHistory->product->title;
                                     }
                                    @endphp
                                    <tr data-entry-id="{{ $designerPaymentHistory->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $designerPaymentHistory->designer?->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $designerPaymentHistory->user?->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $productName ?? '' }}
                                        </td>

                                        <td>{{ number_format($designerPaymentHistory->amount ?? 0, 2) }} Tk.</td>
                                        <td>
                                            {{ $designerPaymentHistory->card_type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $designerPaymentHistory->bank_txn ?? '' }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($designerPaymentHistory->created_at)->format('d-m-Y')  }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if ($designerPaymentHistories->hasPages())
                                {{ $designerPaymentHistories->links() }}
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
