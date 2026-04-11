@extends('includes.master')
@section('content')
    <style>
        .container2 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-auto-rows: 200px;
            gap: 12px;
            width: 100%;
            padding: 0 15px; /* Added symmetric horizontal gap on both sides */
            margin: 0 auto;
            grid-auto-flow: dense;
        }

        .item {
            position: relative;
            overflow: hidden;
            border-radius: 4px; /* ImagesBazaar sharp/minimal curve */
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* 
         * Strict Dimension Limiting (Maps to ImagesBazaar Max Limits)
         * Base Size: 1x1 (Approx 400w x 200h)
         */

        /* Tall Portrait Boxes (~620px Height Max, mimicking your 690 max) */
        .item:nth-child(10n + 1),
        .item:nth-child(10n + 6) {
            grid-row: span 3;
        }

        /* Medium Square/Vertical Boxes (~412px Height, mimicking your 547 max) */
        .item:nth-child(5n + 2),
        .item:nth-child(7n + 4) {
            grid-row: span 2;
        }

        /* Wide Landscape Box */
        .item:nth-child(14n + 8) {
            grid-column: span 2;
            grid-row: span 2;
        }

        /* Responsive Flow overrides */
        @media (max-width: 1200px) {
            .container2 {
                grid-template-columns: repeat(3, 1fr);
            }
            .item { grid-column: span 1 !important; }
        }

        @media (max-width: 768px) {
            .container2 {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }
            .item { grid-row: span 2 !important; }
            .item:nth-child(4n + 1) { grid-row: span 3 !important; }
        }

        @media (max-width: 576px) {
            .container2 {
                grid-template-columns: 1fr;
                grid-auto-rows: 240px;
            }
            .item { grid-row: span 1 !important; }
        }

        .item img,
        .item video {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Forces intrinsically crazy images to respect bounds */
            transition: transform 0.5s ease;
        }

        .item:hover img,
        .item:hover video {
            transform: scale(1.08); /* Zoom effect similar to pro domains */
        }

        /* Hover Overlay */
        .item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.6));
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 5;
            pointer-events: none;
        }

        .item:hover::before {
            opacity: 1;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-size: 3vw;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
            white-space: nowrap;
            pointer-events: none;
            user-select: none;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        .popularSearch {
            margin-bottom: 10px;
            margin-right: 5px;
        }

        /* Center Category Text on hover */
        .category-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -30%);
            color: #fff;
            font-size: 20px;  
            font-weight: 800;    
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0px 4px 15px rgba(0,0,0,0.9);
            opacity: 0;           
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 10;
            pointer-events: none;
        }

        .item:hover .category-overlay {
            opacity: 1;
            transform: translate(-50%, -50%);
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
                        $designer = $product->designer->name;
                        $designer_id = $product->designer->id;
                        $isVideo = $product->type == 2;
                    @endphp

                    <div class="item item-{{ $key }}"
                         data-title="{{ $product->title }}"
                         data-file="{{ route('product.file.view', $product->id) }}"
                         data-description="{{ $description }}"
                         data-designer="{{ $designer }}"
                         data-designer_id="{{ $designer_id }}"
                         data-type="{{ $product->type }}"
                         data-product-id="{{ $product->id }}"
                         onclick="window.location='{{ route('category-wise-product', $product->category_id) }}'">

                        @if ($isVideo)
                            <video class="img video-thumb" muted loop preload="metadata">
                                <source src="{{ route('product.file.view', $product->id) }}"
                                        type="{{ $product->file_type }}">
                            </video>
                        @else
                            <img class="img"
                                 src="{{ route('product.file.view', $product->id) }}"
                                 alt="">
                        @endif

                            <div class="category-overlay">
                                <span>{{ $product->category?->name ?? 'Collection' }}</span>
                            </div>

                        <div class="watermark">CHOBIDOKAN</div>
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

@if(session('download_product_id'))
    <script>
        window.onload = function () {
            const link = document.createElement('a');
            link.href = "{{ route('product.image-download', session('download_product_id')) }}";
            link.download = '';
            document.body.appendChild(link);
            link.click();
            link.remove();
        };
    </script>
@endif
