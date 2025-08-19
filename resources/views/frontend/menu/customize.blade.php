@extends('includes.master')
@section('content')
{{-- custom css for this page only --}}
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

        phpphp .job-status-icon {
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
                <h2 class="text-center">{{count($projects)}} Open  @if(count($projects) > 1)  Jobs @else Job @endif </h2>
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
                            <option selected disabled>All Categories ({{count($categories)}})</option>
                            @foreach($categories as $key=>$category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <i class="fa fa-chevron-down position-absolute" style="top: 35px; right: 10px; pointer-events: none; color: #aaa;"></i>
                    </div>
                </div>

                <!-- Job Status Select -->
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group position-relative">
                        <label for="status-select">Job Status</label>
                        <select id="status-select" class="form-control pe-4">
                            <option selected disabled>Open Jobs ({{count($projects)}})</option>
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
                <strong>Categories:</strong>
                @foreach($categories as $index => $category)
                    {{ $category->name }}@if(!$loop->last),@endif
                @endforeach
                | <a href="{{ route('closed-jobs') }}" class="text-decoration-underline">View Closed Jobs</a>
            </p>

         @if(count($projects) > 0)
          @foreach($projects as $key=>$project)

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
                            <h5><strong>{!! $project->project_description !!}</strong></h5>
                            <p>{!! $project->logo_description !!}</p>
                            <div class="d-flex flex-wrap">
                                <span class="badge badge-custom">{{$project->category?->name}} Job</span>
                            </div>
                        </div>

                        @php
                            $expireDate = \Carbon\Carbon::parse($project->expire_date)->startOfDay();
                                $today = \Carbon\Carbon::now()->startOfDay();

                                $daysLeft = $today->gt($expireDate)
                                    ? 'Expired'
                                    : $today->diffInDays($expireDate);
                        @endphp

                        <!-- Right Side -->
                        <div class="right col-md-3 col-12">
                            <p class="sidebar-info"><i class="info-icon">&#x1F4B0;</i>{{$project->order?->amount}} Tk</p>
                            <p class="sidebar-info"><i class="info-icon">&#x23F3;</i> {{$daysLeft}} days left</p>
                            <p class="sidebar-info"><i class="info-icon">&#x1F5BC;</i> 0 designs</p>
                            <p class="sidebar-info"><i class="info-icon">&#x1F464;</i> 0 designers</p>
{{--                            <p class="sidebar-info"><i class="info-icon">&#x2B50;</i> 0 4+ star ratings</p>--}}
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @else
                <div class="text-center">
                    <h3 class="text-warning">No jobs Available</h3>
                </div>
            @endif


        </div>
    </section>
</main>
@endsection
