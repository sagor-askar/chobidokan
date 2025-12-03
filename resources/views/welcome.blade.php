@extends('includes.master')
@section('content')
    <style>
        .container2 {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            padding: 0;
        }

        .item {
            position: relative;
            width: calc((100% / 3) - 14px);
            height: auto;
            aspect-ratio: 1 / 1;
            display: inline-block;
            overflow: hidden;
            cursor: pointer;
        }

        .item img,
        .item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.3s;
        }

        .item:hover img,
        .item:hover video {
            transform: scale(1.05);
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-size: 50px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
            white-space: nowrap;
            pointer-events: none;
            user-select: none;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        .container2 {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .overlay {
            position: absolute;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            width: 100%;
            text-align: center;
            padding: 5px 0;
            font-size: 14px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            z-index: 3;
        }
        .popularSearch {
            margin-bottom: 10px;
            margin-right: 5px;
        }
    </style>
    <main class="main">

        @include('includes.hero')

        <section class="section">
            <div class="container section-title" data-aos="fade-up">
                <p>Premium Collection<br></p>
            </div>

            <main class="container2">
                @foreach ($products as $key => $product)
                    @php
                        $description = strip_tags($product->description);
                        $designer = $product->user->name;
                        $designer_id = $product->user->id;
                        $isVideo = $product->type == 2;
                    @endphp

                    <div class="item item-{{ $key }}" data-title="{{ $product->title }}"
                        data-file="{{ asset($product->file_path) }}" data-description="{{ $description }}"
                        data-designer="{{ $designer }}" data-designer_id="{{ $designer_id }}"
                        data-type="{{ $product->type }}" data-product-id="{{ $product->id }}">

                        @if ($isVideo)
                            <video class="img video-thumb" muted loop preload="metadata">
                                <source src="{{ asset($product->file_path) }}" type="{{ $product->file_type }}">
                            </video>
                        @else
                            <img class="img" src="{{ asset($product->file_path) }}" alt="">
                        @endif

                        <div class="watermark">CHOBIDOKAN</div>
                        <div class="overlay">
                            <a href="{{ route('product-details', $product->id) }}" style="color: white;">
                                {{ $product->title }} | Tk {{ $product->price }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </main>

            <div class="pagination-wrapper d-flex justify-content-center mt-4">
                {{ $products->withQueryString()->links('pagination.custom') }}
            </div>
        </section>

        <section class="section">
            <div class="container section-title" data-aos="fade-up">
                <p>Popular Search<br></p>
            </div>

            <div class="container">
                @foreach ($categories as $category)
                    <a href="{{ route('category-wise-product', $category->id) }}"
                        class="btn btn-outline-secondary popularSearch">{{ $category->name }}</a>
                @endforeach

                @if (count($uniqueTags) > 0)
                    @foreach ($uniqueTags as $key => $tag)
                        <a href="{{ route('tag-wise-product', $tag) }}"
                            class="btn btn-outline-secondary popularSearch">{{ $tag }}</a>
                    @endforeach
                @endif
            </div>
        </section>

        @if (Auth::check() && Auth::user()->role_id == 2)
        @else
            <section class="section">
                <div class="container">
                    <h3>Sell Your Photograph on ChobiDokan</h3>
                    <p>Become a contributor and make money selling your images.</p>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <button type="button" class="btn btn-link text-decoration-none sellBtn" style="font-size: 1.3rem;">
                            <i class="fa fa-plus-square-o text-danger"></i> Create Your Account
                        </button>
                        <button type="button" class="btn btn-link text-decoration-none sellBtn" style="font-size: 1.3rem;">
                            <i class="fa fa-upload text-danger"></i> Upload Your Photograph
                        </button>
                        <button type="button" class="btn btn-link text-decoration-none sellBtn" style="font-size: 1.3rem;">
                            <i class="fa fa-usd text-danger"></i> Make Money Per Every Sell
                        </button>
                    </div>
                    <a type="button" class="btn btn-dark" href="{{ route('seller-registration') }}"
                        style="font-size: medium; padding: 5px 15px;">Become A Seller</a>
                </div>
            </section>
        @endif


        <section class="section">
            <div class="container mb-3">
                <h3>Customized Photograph Request</h3>
                <p>You can submit a request for customized theme photograph here. For example: you need a photo of a
                    village
                    road where a boy bycycling at morning. After you submit this our registered photographers will
                    submit this theme
                    image and you can purchase whatever you like.</p>

                <a type="button" class="btn btn-dark" href="{{ route('custom-request') }}"
                    style="font-size: medium; padding: 5px 15px;">Custom Request</a>
            </div>
        </section>
    </main>

@endsection
