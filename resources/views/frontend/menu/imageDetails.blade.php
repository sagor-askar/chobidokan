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

    </style>

    <!-- Hero Section -->
    @include('includes.hero')

    <div class="container py-3">

        <!-- Blog Container -->
        <div class=" border-0">

            <!-- Feature Image -->
            <div class="w-100 feature-img">

                <img src="{{ route('product.file.view', $product->id) }}"
                     class="img-fluid"
                     alt="{{ $product->file_name }}"
                     oncontextmenu="return false"
                     draggable="false">

                <!-- Watermark text -->
                <div class="image-watermark">
                    CHOBIDOKAN
                </div>

                <!-- Always visible bottom overlay -->
                <div class="feature-overlay">
                    <div class="text-center">
                        <span >{{ $product->title ?? '' }}</span>
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
                    <p class="text-secondary">
                        {!! $product->description !!}
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
@endsection
