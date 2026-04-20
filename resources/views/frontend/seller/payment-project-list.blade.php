@extends('layouts.designer_panel')
@section('panel_content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="card-header">
                        <h4>Order Payable list</h4>
                    </div>
                    <div class="panel-body">
                        @if(count($orderDetails) > 0 )
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover datatable datatable-SubCompany" id="subCompany-dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project Name</th>
                                        <th>Customer</th>
                                        <th>Submit Date</th>
                                        <th>Order Amount</th>
                                        <th> Earning Amount <br>
                                            <small>(Off Authority percentage)</small>
                                        </th>
                                        <th>Payment Status </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderDetails as $index => $orderDetail)

                                        @php
                                            $payable_amount = $orderDetail->order->amount - ($orderDetail->order->amount * ($adminPercentage / 100));
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <a target="_blank" href="{{ route("customize-details",$orderDetail->project->id) }}">{{ $orderDetail->project->name }}</a></td>
                                            <td>{{ $orderDetail->project->user->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($orderDetail->created_at)->format('Y-m-d')  }}</td>
                                            <td> Tk. {{ $orderDetail->order->amount }}</td>
                                            <td> Tk. {{ number_format($payable_amount ?? 0, 2)  }}</td>
                                            <td>
                                                @if($orderDetail->order->status == 0)
                                                    <span class="badge bg-danger">Unpaid</span>
                                                @else
                                                    <span class="badge bg-success">Paid</span>
                                                @endif
                                            </td>

                                        </tr>

                                    @endforeach
                                    </tbody>


                                </table>

                            </div>
                            <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                {{ $orderDetails->withQueryString()->links('pagination.custom') }}
                            </div>
                        @else
                            <div class="col-12 text-center py-4">
                                <p class="mb-0 text-danger">No Order Payment available yet.</p>
                            </div>
                        @endif
                    </div>
                </div>



            </div>
        </div>
    </div>




@endsection
