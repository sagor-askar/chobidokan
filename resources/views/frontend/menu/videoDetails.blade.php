@extends('includes.master')
@section('content')
    <style>
        .feature-img {
            position: relative;
            overflow: hidden;
            padding-bottom: 70px;
        }

        .feature-icons i {
            margin-right: 10px;
            font-size: 18px;
        }

        .feature-img img {
            height: auto;
            width: 100%;
        }

        .overlay-icons i {
            margin-right: 8px;
            font-size: 16px;
        }

        .feature-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background: linear-gradient(
                to top,
                rgba(0,0,0,0.85),
                rgba(0,0,0,0.4),
                transparent
            );
            color: #fff;
        }


        .overlay-content {
            display: flex;
            justify-content: center;   /* horizontal center */
            align-items: center;       /* vertical alignment */
            text-align: center;
        }

        .video-meta {
            font-size: 18px;
        }

        .video-price {
            color: #c95846; /* premium gold */
            font-weight: 600;
        }

        .overlay-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        /* ==============================
            MULTI-LAYER WATERMARK
        =============================== */
        .watermark-multi {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            z-index: 3;
        }

        .watermark-multi span {
            font-size: 40px;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.08);
            text-transform: uppercase;
            transform: rotate(-25deg);
            margin: 60px;
            text-shadow: 1px 1px 8px rgba(255,255,255,0.12), -1px -1px 8px rgba(255,255,255,0.12);
            animation: watermarkPulse 3s ease-in-out infinite alternate;
        }

        @keyframes watermarkPulse {
            0% {
                color: rgba(255, 255, 255, 0.06);
                text-shadow: 1px 1px 4px rgba(255,255,255,0.08), -1px -1px 4px rgba(255,255,255,0.08);
            }
            100% {
                color: rgba(255, 255, 255, 0.12);
                text-shadow: 2px 2px 10px rgba(255,255,255,0.15), -2px -2px 10px rgba(255,255,255,0.15);
            }
        }

        /* share  */
        .share-wrapper {
            position: relative;
            display: inline-block;
        }
        .share-dropdown {
            position: absolute;
            bottom: 40px;
            right: 0;
            background: #fff;
            min-width: 160px;
            border-radius: 6px;
            padding: 8px 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            display: none;
            z-index: 10;
        }
        .share-dropdown a {
            display: block;
            padding: 8px 12px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }
        .share-dropdown a:hover {
            background: #f5f5f5;
        }

        .image-popup {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(0,0,0,0.9);
            justify-content: center;
            align-items: center;
        }

        .popup-image {
            max-width: 95vw;
            max-height: 95vh;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .popup-close {
            position: absolute;
            top: 25px;
            right: 35px;
            font-size: 40px;
            color: #fff;
            cursor: pointer;
        }
        .watermark-multi {
            position: absolute;
            inset: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            pointer-events: none;
            z-index: 2;
        }

        .watermark-multi span {
            color: rgba(255,255,255,0.08); /* very light */
            font-size: 28px;
            font-weight: bold;
            margin: 40px;
            transform: rotate(-25deg);
        }

        video {
            position: relative;
            z-index: 1;
            background: #000;
        }

        .zoom-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 3;
            background: rgba(0,0,0,0.6);
            border: none;
            color: #fff;
            padding: 10px 14px;
            font-size: 1.8rem;
        }

    </style>

    <!-- Hero Section -->
    @include('includes.hero')

    <div class="container">

        <!-- Container -->
        <div class=" border-0">

            <div class="row">

                <div class="col-md-8">
                    <div class="position-relative bg-light p-3 rounded shadow-sm">

                        <!-- Video Wrapper -->
                        <div class="position-relative ratio ratio-16x9">

                            <video id="productVideo"
                                class="w-100 rounded"
                                playsinline
                                preload="metadata"
                                controlsList="nodownload">

                                <source src="{{ route('product.view.video', $product->id) }}"
                                        type="{{ $product->file_type }}">
                            </video>

                            <!-- Multi Watermark -->
                            <div class="watermark-multi">
                                @for($i=0; $i<15; $i++)
                                    <span>CHOBIDOKAN</span>
                                @endfor
                            </div>

                            <!-- Zoom Button -->
                            <button type="button"
                                    class="zoom-btn"
                                    onclick="openVideoModal()">
                                <i class="fa fa-search-plus"></i>
                            </button>

                        </div>

                        <!-- Video Info -->
                        <div class="mt-3">
                            <small class="text-muted fw-semibold d-block mb-2">Video Format</small>

                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-secondary-subtle text-dark">
                                    Full HD • 1920x1080 • MP4
                                </span>
                                <span class="badge bg-secondary-subtle text-dark">
                                    Duration: 00:30
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="videoPopup" class="image-popup">

                    <span class="popup-close" onclick="closeVideoModal()">&times;</span>

                    <video class="popup-image"
                        controls
                        autoplay>

                        <source src="{{ route('product.view.video', $product->id) }}"
                                type="{{ $product->file_type }}">
                    </video>

                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light h-100">

                        <!-- Pricing Options -->
                        <div class="mb-3">

                            <div class="d-flex justify-content-between align-items-start">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="plan" id="singleVideo">
                                    <label class="form-check-label fw-semibold" for="singleVideo">
                                        Buy Single Video
                                    </label>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">Tk {{ $product->price }}</div>
                                    <small class="text-muted">Per Video</small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-start rounded mt-2 p-2"
                                style="background:#eef4ff;">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="plan" id="subscription" checked>
                                    <label class="form-check-label fw-semibold" for="subscription">
                                        <span class="badge bg-primary mb-1">Subscribe & Save</span><br>
                                        Monthly Subscription
                                    </label>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">950 BDT</div>
                                    <small class="text-muted">Per Month</small>
                                </div>
                            </div>

                        </div>

                        <!-- Download Button -->
                        <button class="btn btn-sm w-100 text-white fw-semibold mb-2"
                                style="background:#ff3b3f;">
                            Download
                        </button>

                        <div class="text-center mb-2">
                            <a href="#" class="text-decoration-none small text-dark fw-semibold">
                                See all video plans
                            </a>
                        </div>

                        <!-- Video Info -->
                        <div>
                            <small class="text-muted">Video Title</small>
                            <h5 class="fw-bold mb-3">
                                {{ $product->title }}
                            </h5>

                            <small class="text-muted d-block mb-2">Video details</small>

                            <small class="text-muted d-block">
                                {!! $product->description !!}
                            </small>

                            <small class="text-muted d-block mt-2">
                                Upload date:
                                {{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}
                            </small>

                        </div>
                    </div>
                </div>

            </div>

            <div class="card-body p-4">

                <!-- Author & Metadata -->
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">
                        <a  target="_blank" href="{{ route('designer-profile',$product->designer->id) }}">
                            <img src="{{ $product->designer && $product->designer->image  ? asset($product->designer->image)  : 'http://1.gravatar.com/avatar/7a20fad302fc2dd4b4649dc5bdb3c463?s=64&d=mm&r=g' }}"
                                 class="rounded-circle mr-3"
                                 width="50"
                                 height="50"
                                 alt="Author">
                        </a>


                        <div>

                            <h6 class="mb-0 font-weight-bold">
                                <a target="_blank" href="{{ route('designer-profile',$product->designer->id) }}" class="text-dark">{{ $product->designer?->name }}</a>
                            </h6>

                            <small class="text-muted">
                                <i class="fa fa-calendar mr-1"></i>
                                {{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}
                            </small>
                        </div>
                    </div>

                    <div class="d-flex gap-3">

                        <div class="share-wrapper">
                            <i class="fa fa-share-alt share-btn" title="Share"></i>

                            <div class="share-dropdown">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product-details',$product->id)) }}" target="_blank">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>

                                <a href="https://api.whatsapp.com/send?text={{ urlencode(route('product-details',$product->id)) }}" target="_blank">
                                    <i class="fa fa-whatsapp"></i> WhatsApp
                                </a>

                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('product-details',$product->id)) }}&text={{ urlencode($product->title) }}" target="_blank">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>

                                <a href="javascript:void(0)" onclick="copyToClipboard('{{ route('product-details',$product->id) }}')">
                                    <i class="fa fa-link"></i> Copy Link
                                </a>
                            </div>
                        </div>

                        @if($isPayment)
                            <a href="{{ route('product.image-download', ['id' => base64_encode($product->id)]) }}"
                               class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-download mr-1"></i> Download
                            </a>
                        @else
                            <form action="{{ route('product.purchase') }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                    <i class="fa fa-download mr-1"></i> Buy
                                </button>
                            </form>
                        @endif


                        <button type="button" class="btn btn-outline-secondary btn-sm">
                            <i class="fa fa-list mr-1"></i> Total  <strong>{{ $product->total_download }}</strong> Downloads
                        </button>
                    </div>

                </div>

                <!-- Blog Content -->
                <div class="mb-4" style="line-height: 1.8;">

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
                        @if (count($uniqueTags) > 0)
                            @foreach ($uniqueTags as $key => $tag)
                                <a href="{{ route('tag-wise-product', $tag) }}"
                                   class="btn btn-sm btn-outline-secondary mr-2 mb-2">{{ $tag }}</a>
                            @endforeach
                        @endif
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

                @foreach ($similarProducts as $key => $similarProduct)
                <div class="col-md-4">
                    <div class="position-relative overflow-hidden rounded shadow-lg">
                        <!-- Video Wrapper -->
                        <div class="ratio ratio-16x9">
                            <video class="w-100" muted playsinline preload="metadata" onmouseenter="this.play()"
                                   onmouseleave="this.pause(); this.currentTime=0;">
                                <source src="{{ route('product.view.video', $similarProduct->id) }}" type="{{ $similarProduct->file_type }}">
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

                            <div class="fw-semibold">{{ $similarProduct->title }}</div>

                            <div class="d-flex justify-content-between align-items-center small mt-1">
                                <span>Tk {{ $similarProduct->price }}</span>
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

    <script>
        const video = document.getElementById('productVideo');
        const playBtn = document.getElementById('centerPlayBtn');
        const playIcon = playBtn.querySelector('i');

        // Click event to toggle play/pause
        playBtn.addEventListener('click', () => {
            if(video.paused) {
                video.play();
                playIcon.classList.remove('fa-play-circle');
                playIcon.classList.add('fa-pause-circle');
            } else {
                video.pause();
                playIcon.classList.remove('fa-pause-circle');
                playIcon.classList.add('fa-play-circle');
            }
        });


        video.addEventListener('play', () => {
            playBtn.style.opacity = '0.6';
        });
        video.addEventListener('pause', () => {
            playBtn.style.opacity = '1';
        });

        // Prevent right-click / download
        video.addEventListener('contextmenu', e => e.preventDefault());
    </script>

    {{-- video popup --}}
    <script>
        function openVideoModal() {
            document.getElementById('videoPopup').style.display = "flex";
        }

        function closeVideoModal() {
            const popup = document.getElementById('videoPopup');
            popup.style.display = "none";
            popup.querySelector("video").pause();
        }
    </script>
@endsection
