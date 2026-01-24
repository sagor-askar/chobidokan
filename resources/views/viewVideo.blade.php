@extends('includes.master')
@section('content')
    <style>
        .feature-img {
            position: relative;
            overflow: hidden;
            padding-bottom: 70px;
        }

        .feature-overlay {
            position: absolute;
            bottom: 10px;
            width: 100%;
            background: rgba(0, 0, 0, 0.65);
            color: #fff;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
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

    <div class="container py-5">

        <!-- Container -->
        <div class=" border-0">

            <!-- Feature Image -->
            <div class="mt-5 w-100 feature-img rounded shadow-lg position-relative">

                <!-- Video Wrapper -->
                <div class="ratio ratio-16x9">
                    <video class="w-100" muted playsinline preload="metadata" controls onmouseenter="this.play()"
                        onmouseleave="this.pause(); this.currentTime=0;">

                        <source src="{{ asset('frontend_assets/img/demo.mp4') }}" type="video/mp4">
                    </video>
                </div>

                <!-- Center Play Icon -->
                <div class="position-absolute top-50 start-50 translate-middle text-white">
                    <i class="fa fa-play-circle fa-4x opacity-75"></i>
                </div>

                <!-- Bottom Overlay -->
                <div class="feature-overlay w-100" style="background: linear-gradient(transparent, rgba(0,0,0,0.85));">

                    <div class="d-flex align-items-center gap-3">
                        <div class="feature-icons">
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-eye"></i>
                            <i class="fa fa-share-alt"></i>
                        </div>

                        <span class="fw-semibold">Featured Video</span>
                    </div>

                    <span class="badge bg-warning text-dark fw-semibold">Featured</span>
                </div>
            </div>



            <div class="card-body p-4">

                <!-- Author & Metadata -->
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/img/user/default-user.png') }}" class="rounded-circle mr-3"
                            width="50" height="50" alt="Author">

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
                        Video Available.
                    </label>
                    <br>
                    <small>This video is copyrighted by ChobiDokan. To use it, purchase it now.</small>
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

            <h3 class="mb-4 text-center font-weight-bold">Similar Videos</h3>

            <div class="row">

                <!-- Image 1 -->
                <div class="col-md-4">
                    <div class="position-relative overflow-hidden rounded shadow-lg">

                        <!-- Video Wrapper -->
                        <div class="ratio ratio-16x9">
                            <video class="w-100" muted playsinline preload="metadata" onmouseenter="this.play()"
                                onmouseleave="this.pause(); this.currentTime=0;">

                                <source src="" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>

                        <!-- Play Icon -->
                        <div class="position-absolute top-50 start-50 translate-middle text-white">
                            <i class="fa fa-play-circle fa-3x opacity-75"></i>
                        </div>

                        <!-- Watermark -->
                        <div
                            class="position-absolute top-0 end-0 m-2 px-2 py-1 bg-dark bg-opacity-50 text-white small rounded">
                            CHOBIDOKAN
                        </div>

                        <!-- Overlay -->
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white"
                            style="background: linear-gradient(transparent, rgba(0,0,0,0.85));">

                            <div class="fw-semibold">Sample Video Title</div>

                            <div class="d-flex justify-content-between align-items-center small mt-1">
                                <span>Tk 500</span>

                                <div class="d-flex gap-3">
                                    <i class="fa fa-eye"></i>
                                    <i class="fa fa-download"></i>
                                    <i class="fa fa-share-alt"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
