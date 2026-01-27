@extends('includes.master')
@section('content')
    <style>
        /* ===== VIDEO PLAYER ===== */
        .video-wrapper {
            position: relative;
            width: 100%;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
        }

        .video-wrapper video {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Gradient overlay */
        .video-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(0,0,0,0.15),
                rgba(0,0,0,0.65)
            );
            pointer-events: none;
        }

        /* WATERMARK */
        .video-watermark {
            position: absolute;
            bottom: 60px;
            right: 26px;
            color: #fff;
            font-weight: 800;
            font-size: 28px;
            letter-spacing: 3px;
            opacity: 0.35;
            text-transform: uppercase;
            text-shadow: 0 0 8px rgba(0,0,0,0.6);
            pointer-events: none;
        }


        .video-wrapper {
            position: relative;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
        }

        /* NORMAL MODE */
        .video-watermark {
            position: absolute;
            bottom: 60px;
            right: 26px;
            color: #fff;
            font-weight: 800;
            font-size: 28px;
            letter-spacing: 3px;
            opacity: 0.35;
            text-transform: uppercase;
            text-shadow: 0 0 8px rgba(0,0,0,0.6);
            pointer-events: none;
            z-index: 5;
        }

        /* ===== FULLSCREEN MODE ===== */
        .video-wrapper:fullscreen .video-watermark,
        .video-wrapper:-webkit-full-screen .video-watermark,
        .video-wrapper:-moz-full-screen .video-watermark,
        .video-wrapper:-ms-fullscreen .video-watermark {
            position: fixed;
            bottom: 40px;
            right: 40px;
            font-size: 32px;
            opacity: 0.4;
            z-index: 2147483647;
        }

        /* INFO CARD */
        .info-card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }

        /* AUTHOR */
        .author-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        /* ACTION BUTTONS */
        .action-btn {
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 14px;
        }

        /* DESCRIPTION */
        .description-box {
            background: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
        }

        /* TAGS */
        .tag-btn {
            border-radius: 20px;
            font-size: 13px;
            padding: 5px 14px;
        }
    </style>



    <!-- Hero Section -->
    @include('includes.hero')

    <div class="container py-3">

        <!-- Blog Container -->
        <div class=" border-0">

            <!-- Feature Image -->
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div class="video-wrapper shadow-lg" id="videoContainer">

                            <video id="mainVideo" controls autoplay playsinline>
                                <source src="{{ asset($product->file_path) }}" type="video/mp4">
                            </video>

                            <div class="video-gradient"></div>
                            <div class="video-watermark" id="videoWatermark">CHOBIDOKAN</div>
                        </div>
                        <h3 class="mt-4 font-weight-bold">{{ $product->title }}</h3>
                        <h6 class="text-muted">Price: Tk {{ $product->price }}</h6>

                    </div>
                </div>
            </div>
            <div class="card-body p-4">

                <!-- Author & Metadata -->
                <div class="info-card mt-4">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div class="d-flex align-items-center">
                            <img src="{{ $product->user && $product->user->image ? asset($product->user->image) : 'http://1.gravatar.com/avatar/7a20fad302fc2dd4b4649dc5bdb3c463?s=64&d=mm&r=g' }}"
                                 class="rounded-circle author-img mr-3">

                            <div>
                                <h6 class="mb-0 font-weight-bold">{{ $product->user?->name }}</h6>
                                <small class="text-muted">
                                    <i class="fa fa-calendar mr-1"></i>
                                    {{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}
                                </small>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary action-btn">
                                <i class="fa fa-heart"></i> Save
                            </button>
                            <button class="btn btn-outline-secondary action-btn">
                                <i class="fa fa-download"></i> Try
                            </button>
                            <button class="btn btn-outline-secondary action-btn">
                                <i class="fa fa-list"></i> 10 Downloads
                            </button>
                        </div>

                    </div>


                    <!-- Blog Content -->
                    <div class="description-box">
                        {!! $product->description !!}

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" checked disabled>
                            <label class="form-check-label">
                                Image Available
                            </label>
                        </div>

                        <small class="text-muted">
                            This content is copyrighted by <strong>ChobiDokan</strong>. Purchase required.
                        </small>
                    </div>

                <!-- Tags -->
                    <div class="mt-4">
                        <h6 class="text-uppercase font-weight-bold">Tags</h6>

                        <div class="mt-2">
                            @foreach ($uniqueTags as $tag)
                                <a href="{{ route('tag-wise-product', $tag) }}"
                                   class="btn btn-outline-secondary tag-btn mr-2 mb-2">
                                    {{ $tag }}
                                </a>
                            @endforeach
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
                    @foreach($similarProducts as $key=>$similarProduct)
                        <div class="col-md-4">
                            <div class="position-relative overflow-hidden rounded shadow-lg">

                                <!-- Video Wrapper -->
                                <div class="ratio ratio-16x9">
                                    <video class="w-100" muted playsinline preload="metadata" onmouseenter="this.play()"
                                           onmouseleave="this.pause(); this.currentTime=0;">
                                        <source src="{{ asset($similarProduct->file_path) }}" type="video/mp4">
                                    </video>
                                </div>
                                <!-- Play Icon -->
                                <a href="{{ route('product-details',$similarProduct->id) }}"
                                   class="position-absolute top-50 start-50 translate-middle text-white"
                                   style="z-index: 5;">
                                    <i class="fa fa-play-circle fa-3x opacity-75"></i>
                                </a>

                                <!-- Overlay -->
                                <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white"
                                     style="background: linear-gradient(transparent, rgba(0,0,0,0.85));">

                                    <div class="fw-semibold">{{ $similarProduct->title ?? '' }}</div>

                                    <div class="d-flex justify-content-between align-items-center small mt-1">
                                        <span>Tk {{ $similarProduct->price ?? '' }}</span>

                                        <div class="d-flex gap-3">
                                            <i class="fa fa-eye"></i>
                                            <i class="fa fa-download"></i>
                                            <i class="fa fa-share-alt"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </section>
@endsection
