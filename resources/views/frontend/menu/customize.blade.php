@extends('includes.master')
@section('content')

<style>
    .job-card {
        border: 2px solid #00aaff;
        border-radius: 8px;
        padding: 20px;
        margin: 30px auto;
        max-width: 1100px;
        background-color: #fff;
    }

    .badge-custom {
        background-color: #fff;
        color: #333;
        border: 1px solid #333;
        margin-right: 5px;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .info-icon {
        display: inline-block;
        width: 20px;
        margin-right: 8px;
    }

    .sidebar-info {
        font-size: 14px;
        margin-bottom: 8px;
    }

    .sidebar-info i {
        color: #666;
    }

    .job-status-icon {
        height: 6rem;
        width: auto;
        margin-top: 2rem;
        margin-left: auto;
        margin-right: auto;
    }

    /* Custom for the right column */
    .right {
        border-left: 2px solid rgb(161, 165, 161);
        padding-left: 15px;
    }

    /* 🔽 Mobile responsiveness from 380px to 500px */
    @media (max-width: 500px) {
        .job-card {
            padding: 15px;
            margin: 10px;
        }

        .job-status-icon {
            height: 4rem;
            margin-bottom: 10px;
        }

        .badge-custom {
            font-size: 12px;
            padding: 5px 8px;
        }

        h5 {
            font-size: 16px;
        }

        .sidebar-info {
            font-size: 13px;
        }

        .right {
            border-left: none;
            border-top: 1px solid #ccc;
            margin-top: 15px;
            padding-top: 15px;
        }
    }

</style>

<main class="main">

    <!-- Customize request -->
    <section class="section">
        <div class="container my-4">
            <div class="row align-items-end gy-3 mt-5" id="search">
                <h2 class="text-center">220 Open Jobs</h2>
                <!-- Search Bar -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group position-relative">
                        <label for="search-input">Search</label>
                        <input type="text" id="search-input" class="form-control ps-4" placeholder="What are you looking for?">
                        <span class="fa fa-search position-absolute" style="top: 36px; left: 5px; color: #aaa;"></span>
                    </div>
                </div>

                <!-- Category Select -->
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group position-relative">
                        <label for="category-select">Categories</label>
                        <select id="category-select" class="form-control pe-4">
                            <option selected disabled>All Categories (202)</option>
                            <option value="action">Action</option>
                            <option value="another">Another action</option>
                            <option value="something">Something else here</option>
                        </select>
                        <i class="fa fa-chevron-down position-absolute" style="top: 35px; right: 10px; pointer-events: none; color: #aaa;"></i>
                    </div>
                </div>

                <!-- Job Status Select -->
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group position-relative">
                        <label for="status-select">Job Status</label>
                        <select id="status-select" class="form-control pe-4">
                            <option selected disabled>Open Jobs (202)</option>
                            <option value="action">Action</option>
                            <option value="another">Another action</option>
                            <option value="something">Something else here</option>
                        </select>
                        <i class="fa fa-chevron-down position-absolute" style="top: 35px; right: 10px; pointer-events: none; color: #aaa;"></i>
                    </div>
                </div>
            </div>

            <hr />

            <p class="mt-3">
                <strong>Categories:</strong> Logo & Branding, Web & App Design, Print & Advertising Design, Graphic & Vector
                Design, Product & Merchandise,
                Art & Illustration | <a href="#" class="text-decoration-underline">View Closed Jobs</a>
            </p>

            {{-- Job list --}}
            <div class="job-card shadow-sm">
                <a href="{{ route('customize-details') }}" class="text-dark">
                    <div class="row">
                        <!-- Left Side (responsive icon placement) -->
                        <div class="col-md-2 col-12 text-center d-flex justify-content-center justify-content-md-start mb-3 mb-md-0 pt-md-2">
                            {{-- if the job is open --}}
                            <img class="job-status-icon" src="{{ asset('frontend_assets/img/open.png') }}" alt="">
                            {{-- if the job is closed, display this --}}
                            {{-- <img class="job-status-icon" src="{{ asset('frontend_assets/img/closed.png') }}" alt=""> --}}
                        </div>

                        <!-- Middle Content -->
                        <div class="col-md-7 col-12">
                            <h5><strong>Looking for a graphic designer to design a brochure-like introduction of our real estate business</strong></h5>
                            <p><strong>AL QASR PROPERTIES LTD.</strong> is a new real estate investment business that is just starting. We are looking for the best graphic designer to present the company’s strategy to important stakeholders. This project is <strong>URGENT</strong>. See attachment.</p>
                            <div class="d-flex flex-wrap">
                                <span class="badge badge-custom">Graphic Design Job</span>
                                <span class="badge badge-custom">Graphic Design Job</span>
                                <span class="badge badge-custom">Graphic Design Job</span>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="right col-md-3 col-12">
                            <p class="sidebar-info"><i class="info-icon">&#x1F4B0;</i> US$110</p>
                            <p class="sidebar-info"><i class="info-icon">&#x23F3;</i> 2 days left</p>
                            <p class="sidebar-info"><i class="info-icon">&#x1F5BC;</i> 0 designs</p>
                            <p class="sidebar-info"><i class="info-icon">&#x1F464;</i> 0 designers</p>
                            <p class="sidebar-info"><i class="info-icon">&#x2B50;</i> 0 4+ star ratings</p>
                        </div>
                    </div>
                </a>
            </div>





        </div>





    </section>

</main>
@endsection
