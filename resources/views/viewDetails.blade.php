@extends('includes.master')
@section('content')
    <style>
        .feature-img {
            position: relative;
            overflow: hidden;
        }

        .feature-overlay {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.65);
            color: #fff;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .feature-icons i {
            margin-right: 10px;
            font-size: 18px;
        }

        .feature-img img {
            height: auto;
            width: 100%;
        }

        .image-card {
            position: relative;
            overflow: hidden;
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.65);
            color: #fff;
            padding: 8px 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .overlay-icons i {
            margin-right: 8px;
            font-size: 16px;
        }
    </style>

    <!-- Hero Section -->
    @include('includes.hero')

    <div class="container py-3">

        <!-- Blog Container -->
        <div class=" border-0">

            <!-- Feature Image -->
            <div class="w-100 feature-img">
                <img src="{{ asset('frontend_assets/img/portfolio/books-2.jpg') }}" class="img-fluid" alt="blog image">

                <!-- Always visible bottom overlay -->
                <div class="feature-overlay">
                    <div class="feature-icons">
                        <i class="fa fa-heart"></i>
                        <i class="fa fa-eye"></i>
                        <i class="fa fa-share-alt"></i>
                    </div>

                    <span>Featured Image</span>
                </div>
            </div>

            <div class="card-body p-4">

                <!-- Author & Metadata -->
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">
                        <img src="http://1.gravatar.com/avatar/7a20fad302fc2dd4b4649dc5bdb3c463?s=64&d=mm&r=g"
                            class="rounded-circle mr-3" width="50" height="50" alt="Author">

                        <div>
                            <h6 class="mb-0 font-weight-bold">
                                <a href="#" class="text-dark">Julia Andrason</a>
                            </h6>
                            <small class="text-muted">
                                <i class="fa fa-calendar mr-1"></i>
                                Nov 23, 2015
                            </small>
                        </div>
                    </div>

                    <div>
                        <a href="#" class="text-secondary">
                            <i class="fa fa-download mr-1"></i> Total 10 Downloads
                        </a>
                    </div>

                </div>

                <!-- Blog Content -->
                <div class="mb-4" style="line-height: 1.8;">
                    <p class="text-secondary">
                        Ravenously while stridently coughed far promiscuously below jeez much yikes bland that salamander
                        cunningly some over abhorrent as house with between ouch that well scurrilously alas capybara
                        massive outdid oh said hello majestically roadrunner.
                    </p>

                    {{-- if the image is available --}}
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        Image Available.
                    </label>
                    <br>
                    <small>This image is copyrighted by ChobiDokan. To use it, purchase it now.</small>
                </div>

                <!-- Tags -->
                <div class="mt-4">
                    <h6 class="text-uppercase font-weight-bold">Tags</h6>

                    <div class="mt-2">
                        <a href="#" class="btn btn-sm btn-outline-secondary mr-2 mb-2">College</a>
                        <a href="#" class="btn btn-sm btn-outline-secondary mr-2 mb-2">Job</a>
                        <a href="#" class="btn btn-sm btn-outline-secondary mr-2 mb-2">Search</a>
                        <a href="#" class="btn btn-sm btn-outline-secondary mr-2 mb-2">Teacher</a>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Similar Projects Section -->

    <section class="mb-2">
        <div class="container">

            <h3 class="mb-4 text-center font-weight-bold">Similar Images</h3>

            <div class="row">

                <!-- Image 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card image-card">
                        <img src="{{ asset('frontend_assets/img/portfolio/books-2.jpg') }}" class="card-img-top"
                            alt="Image">

                        <!-- Overlay -->
                        <div class="image-overlay">
                            <div class="overlay-icons">
                                <i class="fa fa-eye"></i>
                                <i class="fa fa-download"></i>
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <span>Text</span>
                        </div>
                    </div>
                </div>

                <!-- Image 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card image-card">
                        <img src="{{ asset('frontend_assets/img/portfolio/books-2.jpg') }}" class="card-img-top"
                            alt="Image">

                        <!-- Overlay -->
                        <div class="image-overlay">
                            <div class="overlay-icons">
                                <i class="fa fa-eye"></i>
                                <i class="fa fa-download"></i>
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <span>Text</span>
                        </div>
                    </div>
                </div>

                <!-- Image 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card image-card">
                        <img src="{{ asset('frontend_assets/img/portfolio/books-2.jpg') }}" class="card-img-top"
                            alt="Image">

                        <!-- Overlay -->
                        <div class="image-overlay">
                            <div class="overlay-icons">
                                <i class="fa fa-eye"></i>
                                <i class="fa fa-download"></i>
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <span>Text</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
