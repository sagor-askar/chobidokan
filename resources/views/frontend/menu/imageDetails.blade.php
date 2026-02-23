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


        .similar-card {
            position: relative;
            width: 100%;
            height: 250px;
            /* Fixed height for all items */
            border-radius: 8px;
            overflow: hidden;
        }

        /* Image inside card */
        .similar-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* SAME height-width, perfect crop */
            transition: transform 0.4s ease;
        }

        /* Hover zoom effect */
        .similar-card:hover img {
            transform: scale(1.08);
        }

        /* Overlay styles */
        .similar-overlay {
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

        /* watermark text */
        .image-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);

            font-size: 100px;
            font-weight: 600;
            letter-spacing: 1px;

            color: #ffffff;
            opacity: 0.15;
            z-index: 10;

            pointer-events: none;
            user-select: none;
            white-space: nowrap;

            text-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
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

        .image-watermark {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-20deg);
            font-size: 48px;
            font-weight: bold;
            color: rgba(255,255,255,0.3);
            pointer-events: none;
        }

        .zoom-btn {
            position: absolute;
            bottom: 15px;
            right: 15px;
            width: 45px;
            height: 45px;
            font-size: 2rem;
            color: white;
            border: none;
            background-color: transparent;
        }

        /* Popup background */
        .image-popup {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(0,0,0,0.9);
            justify-content: center;
            align-items: center;
        }

        /* Image */
        .popup-image {
            max-width: 95vw;
            max-height: 95vh;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        /* Close button */
        .popup-close {
            position: absolute;
            top: 25px;
            right: 35px;
            font-size: 40px;
            color: #fff;
            cursor: pointer;
        }

        .popup-close:hover {
            color: #ff4d4f;
        }
    </style>

    <!-- Hero Section -->
    @include('includes.hero')

    <div class="container py-3">

        <!-- Blog Container -->
        <div class=" border-0">

            <div class="row">

                <!-- Left Side: Image -->
                <div class="col-md-8">
                    <div class="position-relative bg-light p-3 rounded shadow-sm">
                        <!-- Main Image Wrapper -->
                        <div class="position-relative">
                            <img src="{{ route('product.file.view', $product->id) }}"
                                class="img-fluid w-100 rounded"
                                alt="{{ $product->file_name }}"
                                draggable="false">

                            <!-- Watermark -->
                            <div class="image-watermark">
                                CHOBIDOKAN
                            </div>

                            <!-- Zoom (+) Button -->
                            <button type="button" class="zoom-btn" onclick="openImageModal()">
                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                            </button>

                        </div>

                        <!-- Photo Formats -->
                        <div class="mt-3">
                            <small class="text-muted fw-semibold d-block mb-2">Photo formats</small>

                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-secondary-subtle text-dark">
                                    6000 × 4000 pixels • 20 × 13.3 in • DPI 300 • JPG
                                </span>
                                <span class="badge bg-secondary-subtle text-dark">
                                    1000 × 667 pixels • 3.3 × 2.2 in • DPI 300 • JPG
                                </span>
                                <span class="badge bg-secondary-subtle text-dark">
                                    500 × 334 pixels • 1.7 × 1.1 in • DPI 300 • JPG
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Custom Image Popup -->
                <div id="imagePopup" class="image-popup">

                    <span class="popup-close" onclick="closeImageModal()">&times;</span>

                    <img src="{{ route('product.file.view', $product->id) }}"
                        alt="{{ $product->file_name }}"
                        class="popup-image">

                </div>

                <!-- Right Side: Options -->
                <div class="col-md-4">
                    <div class="p-3 bg-light h-100">

                        <!-- Pricing Options -->
                        <div class="mb-3">

                            <!-- Single Image -->
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="plan" id="singleImage">
                                    <label class="form-check-label fw-semibold" for="singleImage">
                                        Buy Single Image
                                    </label>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">100 BDT</div>
                                    <small class="text-muted">Per Image</small>
                                </div>
                            </div>

                            <!-- Subscription -->
                            <div class="d-flex justify-content-between align-items-start rounded" style="background:#eef4ff;">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="plan" id="subscription" checked>
                                    <label class="form-check-label fw-semibold" for="subscription">
                                        <span class="badge bg-primary mb-1">Subscribe & Save</span><br>
                                        15 Images Subscription
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
                                See all image plans
                            </a>
                        </div>

                        <!-- Image Info -->
                        <div>
                            <small class="text-muted">Image Title</small>
                            <h5 class="fw-bold mb-3">
                                A rooftop Shot with Pigeon Flying
                            </h5>

                            <small class="text-muted d-block mb-2">Image details</small>
                            <small class="text-muted d-block">
                                Asset id: 1940756152
                            </small>

                            <small class="text-muted d-block">
                                {!! $product->description !!}
                            </small>

                            <small class="text-muted d-block mt-2">
                                Release information: Signed model release on file with chobidokan.com
                            </small>

                            <small class="text-muted d-block mt-2">
                                Upload date: {{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}
                            </small>

                            <small class="text-muted d-block mt-2">
                                Categories:
                                <a href="#" class="text-decoration-none">People</a>,
                                <a href="#" class="text-decoration-none">Business/Finance</a>
                            </small>

                            <!-- Author -->
                            {{-- <div class="d-flex align-items-center mt-3">
                                <div class="rounded-circle bg-secondary me-2"
                                    style="width:40px;height:40px;"></div>
                                <span class="fw-semibold">Mr. Designer</span>
                            </div> --}}
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

                        <div style="padding: 5px;">
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
            <h3 class="mb-4 text-center font-weight-bold">Similar Images</h3>
            <div class="row">
                @foreach ($similarProducts as $key => $similarProduct)
                    <div class="col-md-4 mb-4">
                        <div class="similar-card">
                            <a href="{{ route('product-details', $product->id) }}">
                                <img src="{{ route('product.file.view', $product->id) }}" alt="{{ $product->file_name }}" oncontextmenu="return false" draggable="false">
                            </a>
                            <div class="similar-overlay">
                                <div>
                                    <a href="{{ route('product-details', $similarProduct->id) }}">
                                        <i class="fa fa-eye text-white"></i>
                                    </a>
                                    <i class="fa fa-download"></i>
                                    <i class="fa fa-share-alt"></i>
                                </div>
                                <span>{{ $similarProduct->title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- custom popup --}}
    <script>
        function openImageModal() {
            document.getElementById('imagePopup').style.display = "flex";
        }

        function closeImageModal() {
            document.getElementById('imagePopup').style.display = "none";
        }

        // Close when clicking outside image
        document.getElementById('imagePopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
    </script>
@endsection
