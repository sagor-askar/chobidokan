@extends('includes.master')

@section('content')
    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        .profile-img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #007bff;
            margin-bottom: 15px;
        }

        .left-section {
            border-right: 1px solid #dee2e6;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        .social-links a {
            margin: 0 8px;
            font-size: 18px;
            color: #495057;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: #007bff;
        }

        .card-counter {
            position: relative;
            padding: 20px;
            border-radius: 12px;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform .2s ease-in-out;
        }

        .card-counter:hover {
            transform: translateY(-5px);
        }

        .card-counter i {
            font-size: 2.5rem;
            opacity: 0.3;
        }

        .count-numbers {
            font-size: 28px;
            font-weight: bold;
            margin-left: 10px;
        }

        .count-name {
            font-size: 14px;
            opacity: 0.8;
            margin-left: 10px;
        }

        .submitted-card img {
            height: 180px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }
    </style>

    <section class="py-5 mt-5">
        <div class="container">
            <div class="row">
                <!-- Left Panel -->
                <div class="col-md-3 text-center left-section">
                    <img src="{{ asset($user->image ?? 'frontend_assets/img/team/team-1.jpg') }}" class="profile-img" alt="User Image"/>
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted small mb-3">{!! strip_tags($user->bio ?? '') !!}</p>

                    <div class="social-links">
                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="col-md-9">
                    <!-- Statistics -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white border-0">
                            <h5 class="mb-0">Statistics</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <div class="card-counter bg-primary">
                                        <i class="fas fa-code-branch"></i>
                                        <div class="count-numbers">{{$totalProject}}</div>
                                        <div class="count-name">Jobs</div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card-counter  bg-info">
                                        <i class="fas fa-ticket-alt"></i>
                                        <div class="count-numbers">{{$totalSubmit}}</div>
                                        <div class="count-name">Total Submit</div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card-counter bg-success">
                                        <i class="fas fa-database"></i>
                                        <div class="count-numbers">-</div>
                                        <div class="count-name">Selected</div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card-counter bg-danger">
                                        <i class="fas fa-ticket-alt"></i>
                                        <div class="count-numbers">-</div>
                                        <div class="count-name">Rejected</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submitted Works -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-0">
                            <h5 class="mb-0">Submitted Works</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                @foreach($uploads as $key=>$upload)
                                <div class="col-md-4 mb-4">
                                    <div class="card submitted-card h-100">
                                        <img src="{{ asset($upload->file_path) }}" class="card-img-top" alt="Work"/>
                                        <div class="card-body">
                                            <h5 class="card-title mb-1">{{$upload->project?->name }} </h5>
                                            <p class="card-text text-muted small mb-2">
                                                {{ \Carbon\Carbon::parse($upload->projectSubmit?->submit_date)->format('d/m/Y')  }}
                                            </p>
                                            <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                    <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                        {{ $uploads->withQueryString()->links('pagination.custom') }}
                                    </div>
                                <!-- more submitted works here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
