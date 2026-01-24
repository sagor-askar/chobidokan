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
    <main class="main">

        <!-- Hero Section -->
        @include('includes.hero')

        <h5 class="text-center mt-4">1,00,000+ videos for "Title Name >> View All"</h5>

        <section class="mb-2">
            <div class="container">
                <div class="row g-4">

                    <!-- Item -->
                    <div class="col-md-4">
                        <div class="position-relative overflow-hidden rounded shadow-lg">

                            <!-- Video Wrapper -->
                            <div class="ratio ratio-16x9">
                                <video class="w-100" muted playsinline preload="metadata" onmouseenter="this.play()"
                                    onmouseleave="this.pause(); this.currentTime=0;">

                                    <source src="{{ asset('frontend_assets/img/demo.mp4') }}" type="video/mp4">
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
    </main>
@endsection
