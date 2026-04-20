@extends('layouts.user_panel')
@section('panel_content')

    <section class="pt-4 pb-5">
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="font-weight-bold">Dashboard</h4>
                <small class="text-muted">Welcome back, {{ $user->name }}!</small>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <!-- Product Purchases Card -->
                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card shadow-sm border-left-primary h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-shopping-cart fa-2x text-success mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold text-center">{{ $totalProductPurchase->count() ?? 0 }}</h5>
                                <small class="text-muted text-nowrap">Total Product Purchase</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Spending Card -->
                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card shadow-sm border-left-info h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-money-bill-wave fa-2x text-info mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold">৳ {{ number_format( $totalProductPurchase->sum('amount') ?? 0, 2) }}</h5>
                                <small class="text-muted text-nowrap">Total Product Purchase Amount</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Orders Card -->
                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card shadow-sm border-left-success h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-shopping-cart fa-2x text-success mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold text-center">{{ $totalProjectOrder->count() ?? 0 }}</h5>
                                <small class="text-muted">Total Project Orders</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Spending Card -->
                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card shadow-sm border-left-info h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-money-bill-wave fa-2x text-info mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold">৳ {{ number_format( $totalProjectOrder->sum('amount') ?? 0, 2) }}</h5>
                                <small class="text-muted text-nowrap">Total Order Amount</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Spending Card -->
                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card shadow-sm border-left-info h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-money-bill-wave fa-2x text-info mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold">৳ {{ number_format( ($totalProjectOrder->sum('amount') + $totalProductPurchase->sum('amount') ) ?? 0, 2) }}</h5>
                                <small class="text-muted text-nowrap">Total Amount</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card shadow-sm border-left-info h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-money-bill-wave fa-2x text-info mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold">৳ {{ number_format( $refundPayment->sum('amount') ?? 0, 2) }}</h5>
                                <small class="text-muted text-nowrap">Refund Amount </small>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Project Orders Card -->
                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card shadow-sm border-left-success h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-shopping-cart fa-2x text-success mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold text-center">{{ $activeProject ?? 0 }}</h5>
                                <small class="text-muted">Active Project</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card shadow-sm border-left-success h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-shopping-cart fa-2x text-success mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold text-center">{{ $completedProject ?? 0 }}</h5>
                                <small class="text-muted"> Complete Project</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card shadow-sm border-left-success h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-shopping-cart fa-2x text-success mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold text-center">{{ $rejectedProject ?? 0 }}</h5>
                                <small class="text-muted"> Reject Project</small>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>

    <style>
        /* Card Border Left Colors */
        .border-left-primary { border-left: 4px solid #007bff !important; }
        .border-left-success { border-left: 4px solid #28a745 !important; }
        .border-left-info { border-left: 4px solid #17a2b8 !important; }
        .border-left-warning { border-left: 4px solid #ffc107 !important; }

        .card i {
            min-width: 40px;
            text-align: center;
        }

        .card h5 {
            font-weight: 600;
        }

        /* Hover effect for cards */
        .card:hover {
            transform: translateY(-3px);
            transition: 0.3s;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
    </style>

@endsection
