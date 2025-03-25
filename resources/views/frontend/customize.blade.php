@extends('includes.master')
@section('content')
    <main class="main">

        <!-- Best Collection -->
        <section class="section">

            <!-- customized photo request section -->
            <section class="section">
                <div class="container">
                    {{-- title --}}
                    <h3 class="text-center">Customize Photo Requests</h3>

                    <div class="row">
                        <!-- card -->
                        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                            <div class="card m-3">
                                <img class="card-img"
                                    src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/pasta.jpg"
                                    alt="Bologna">
                                <div class="card-img-overlay">
                                    <a href="#" class="btn btn-light btn-sm">Logo Design</a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Custom Logo Design</h4>
                                    <small class="text-muted d-flex align-items-center gap-3">
                                        <span><i class="fa fa-clock-o text-info"></i> 5 days</span>
                                        <span><i class="fa fa-dollar text-info"></i> 40 dollar</span>
                                        <span><i class="fa fa-users text-info"></i> 20 designers</span>
                                    </small>

                                    <p class="card-text" style="margin-top: 5px;">I love quick, simple pasta dishes, and
                                        this is one of my favorite.
                                    </p>
                                    <a href="#" class="btn btn-info">View Details</a>
                                </div>
                                <div
                                    class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
                                    <div class="views">Oct 20, 12:45PM
                                    </div>
                                    <div class="stats">
                                        <i class="fa fa-eye"></i> 1347
                                        <i class="fa fa-comment"></i> 12
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

    </main>
@endsection
