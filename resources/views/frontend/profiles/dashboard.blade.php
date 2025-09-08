@extends('layouts.designer_panel')
@section('panel_content')

    <section class="pt-4 pb-5">
        <div class="container">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="font-weight-bold">Dashboard</h4>
                <small class="text-muted">Welcome back, {{ $user->name }}!</small>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <!-- Projects Card -->
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-left-primary h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-project-diagram fa-2x text-primary mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold">{{ $totalProjects ?? 0 }}</h5>
                                <small class="text-muted">Projects</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submissions Card -->
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-left-success h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-upload fa-2x text-success mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold">{{ $totalSubmit ?? 0 }}</h5>
                                <small class="text-muted">Submissions</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clients Card -->
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-left-info h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-users fa-2x text-info mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold">56</h5>
                                <small class="text-muted">Clients</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings Card -->
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-left-warning h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa fa-dollar-sign fa-2x text-warning mr-3"></i>
                            <div>
                                <h5 class="mb-0 font-weight-bold">$7,850</h5>
                                <small class="text-muted">Earnings</small>
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
