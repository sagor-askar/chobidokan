@extends('includes.master')
@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <style>
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }

        .left-section {
            border-right: 2px solid #dee2e6;
            background-color: #f2f2f2;
            padding: 10px;
        }

        .nav-tabs .nav-link {
            border: none;
            border-bottom: 2px solid transparent;
        }

        .nav-tabs .nav-link.active {
            border-bottom: 1px solid #007bff;
            font-weight: bold;
        }

        /* counter card */
        .card-counter {
            box-shadow: 2px 2px 10px #dadada;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            height: 100px;
            border-radius: 5px;
            transition: 0.3s linear all;
        }

        .card-counter:hover {
            box-shadow: 4px 4px 20px #dadada;
            transition: 0.3s linear all;
        }

        .card-counter.primary {
            background-color: #007bff;
            color: #fff;
        }

        .card-counter.danger {
            background-color: #ef5350;
            color: #fff;
        }

        .card-counter.success {
            background-color: #66bb6a;
            color: #fff;
        }

        .card-counter.info {
            background-color: #26c6da;
            color: #fff;
        }

        .card-counter i {
            font-size: 5em;
            opacity: 0.2;
        }

        .card-counter .count-numbers {
            position: absolute;
            right: 35px;
            top: 20px;
            font-size: 32px;
            display: block;
        }

        .card-counter .count-name {
            position: absolute;
            right: 35px;
            top: 65px;
            font-style: italic;
            text-transform: capitalize;
            opacity: 0.5;
            display: block;
            font-size: 18px;
        }

        @media (min-width: 992px) {
            .custom-dashboard-container {
                max-width: 1350px;
                margin: 0 auto;
            }
        }
        
        .dashboard-section-spacing {
            padding-top: 100px;
            padding-bottom: 60px;
        }
        @media (max-width: 991px) {
            .dashboard-section-spacing {
                padding-top: 120px; /* More space on mobile for the header */
            }
        }

        /* Force solid header background on dashboard */
        .header {
            background-color: #ffffff !important;
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1) !important;
        }

    </style>
    <section class="dashboard-section-spacing">
        <div class="container-fluid px-4 custom-dashboard-container">
            <div class="row d-flex align-items-start">
                @include('partials.designer_menu')
                <div class="col-lg-9 col-xl-9">
                    @yield('panel_content')
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS + jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
