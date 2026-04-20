@extends('layouts.user_panel')
@section('panel_content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="card-header">
                        <h4> Refund Payment History </h4>
                    </div>
                    <div class="panel-body">
                        @if(count($refundPaymentHistories) > 0 )
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="subCompany-dataTable">
                                    <thead>
                                    <tr>
                                        <th>
                                            SL
                                        </th>

                                        <th>
                                            Project
                                        </th>

                                        <th>
                                            Order Amount
                                        </th>

                                        <th>
                                           Refund Amount
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
                                    @foreach($refundPaymentHistories as $index => $refundPaymentHistory)
                                        <tr>

                                            <td>{{ $index + 1 }}</td>

                                            <td>
                                                {{ $refundPaymentHistory->project?->name ?? '' }}
                                            </td>

                                            <td>  {{ number_format($refundPaymentHistory->payment->amount ?? 0, 2) }} Tk.</td>
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

                            </div>
                            <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                {{ $refundPaymentHistories->withQueryString()->links('pagination.custom') }}
                            </div>
                        @else
                            <div class="col-12 text-center py-4">
                                <p class="mb-0 text-danger">No Refund Payment available yet.</p>
                            </div>
                        @endif
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
