@extends('includes.master')
@section('content')
    <style>
        .item {
            position: relative;
            display: inline-block;
            overflow: hidden;
        }

        .item .img {
            width: 100%;
            height: auto;
        }

        .item .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-size: 40px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
            white-space: nowrap;
            pointer-events: none;
            user-select: none;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            max-width: 700px;
            width: 90%;
            position: relative;
            border-radius: 10px;
        }

        .modal-image-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
            overflow: hidden;
        }

        .modal-image-wrapper img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .modal-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            color: rgba(255, 255, 255, 0.25);
            font-size: 45px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.5);
            pointer-events: none;
            user-select: none;
        }

        .container2 {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .item {
            position: relative;
            width: 250px;
            height: 250px;
            overflow: hidden;
            cursor: pointer;
            border-radius: 10px;
        }

        .item img,
        .item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.3s;
            border-radius: 10px;
        }

        .item:hover img,
        .item:hover video {
            transform: scale(1.05);
        }

        .watermark {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
            text-shadow: 1px 1px 2px #000;
            z-index: 2;
            font-weight: bold;
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
        }


    </style>
<main class="main">

    <!-- Hero Section -->
    @include('includes.hero')

    <!-- Best Collection -->
    <section class="section">
        <div class="container section-title" data-aos="fade-up">
            <p>Premium Collection<br></p>
        </div>

        <main class="container2">
            @foreach($products as $key => $product)
                @php
                    $description = strip_tags($product->description);
                    $designer = $product->user->name;
                    $designer_id = $product->user->id;
                    $isVideo = $product->type == 2;
                @endphp

                <div class="item item-{{$key}}"
                     data-title="{{ $product->title }}"
                     data-file="{{ asset($product->file_path) }}"
                     data-description="{{ $description }}"
                     data-designer="{{ $designer }}"
                     data-designer_id="{{ $designer_id }}"
                     data-type="{{ $product->type }}"
                     data-product-id="{{ $product->id }}"
                     onclick="openModal(this)">

                    @if($isVideo)
                        <video class="img video-thumb" muted loop preload="metadata">
                            <source src="{{ asset($product->file_path) }}" type="{{ $product->file_type }}">
                        </video>
                    @else
                        <img class="img" src="{{ asset($product->file_path) }}" alt="">
                    @endif

                    <div class="watermark">CHOBIDOKAN</div>
                    <div class="overlay">{{ $product->title }} | Tk {{ $product->price }}</div>
                </div>
            @endforeach
        </main>

        <div class="pagination-wrapper d-flex justify-content-center mt-4">
            {{ $products->withQueryString()->links('pagination.custom') }}
        </div>
    </section>

    <!-- Popup Modal -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle"></h2>

            <div class="modal-image-wrapper">
                <img id="modalImage" src="" alt="" style="display:none;">
                <video id="modalVideo" controls style="display:none; width:100%;">
                    <source id="modalVideoSource" src="" type="">
                </video>
                <div class="modal-watermark">CHOBIDOKAN</div>
            </div>

            <p id="modalDescription"></p>
            <a href="#" id="buyButton" class="btn btn-sm btn-primary" style="width: 20%;">Buy Now</a>
        </div>
    </div>

    <script>
        // 🔹 Modal Open
        function openModal(element) {
            const title = element.dataset.title;
            const fileUrl = element.dataset.file;
            const type = element.dataset.type;
            const description = element.dataset.description;
            const designer = element.dataset.designer;
            const designer_id = element.dataset.designer_id;
            const designerRoute = "{{ url('designer-profile') }}/" + designer_id;

            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalDescription').innerHTML =
                description + "<br><strong>Designer:</strong> <a href='" + designerRoute + "'>" + designer + "</a>";

            const img = document.getElementById('modalImage');
            const vid = document.getElementById('modalVideo');
            const vidSrc = document.getElementById('modalVideoSource');

            if (type == 2) {
                // Video show
                img.style.display = 'none';
                vid.style.display = 'block';
                vidSrc.src = fileUrl;
                vid.load();
            } else {
                // Image show
                vid.style.display = 'none';
                img.style.display = 'block';
                img.src = fileUrl;
            }

            document.getElementById('buyButton').href = "{{ url('buy-product') }}/" + element.dataset.productId;
            document.getElementById('imageModal').style.display = 'flex';
        }

        // 🔹 Modal Close
        function closeModal() {
            const vid = document.getElementById('modalVideo');
            vid.pause();
            document.getElementById('imageModal').style.display = 'none';
        }

        // 🔹 Close modal when clicking outside
        window.onclick = function(event) {
            let modal = document.getElementById('imageModal');
            if (event.target === modal) {
                closeModal();
            }
        };

        // 🔹 Hover Play for Videos
        document.addEventListener('DOMContentLoaded', function() {
            const videos = document.querySelectorAll('.video-thumb');
            videos.forEach(video => {
                video.addEventListener('mouseenter', () => video.play());
                video.addEventListener('mouseleave', () => {
                    video.pause();
                    video.currentTime = 0;
                });
            });
        });
    </script>

    <!-- Popular Search -->
    <section class="section">
        <div class="container section-title" data-aos="fade-up">
            <p>Popular Search<br></p>
        </div>

        <div class="container">
            @foreach($categories as $category)
                <button type="button" class="btn btn-outline-secondary popularSearch">{{ $category->name }}</button>
            @endforeach
        </div>
    </section>

    <!-- become a seller section -->
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
            <a type="button" class="btn btn-dark" href="{{ route('seller-registration') }}" style="font-size: medium; border-radius: 20px; padding: 8px 38px;">BECOME A SELLER</a>
        </div>
    </section>
    @endif


    <!-- customized photo request section -->
    <section class="section">
        <div class="container mb-3">
            <h3>Customized Photograph Request</h3>
            <p>You can submit a request for customized theme photograph here. For example: you need a photo of a
                village
                road where a boy bycycling at morning. After you submit this our registered photographers will
                submit this theme
                image and you can purchase whatever you like.</p>

            <a type="button" class="btn btn-dark" href="{{ route('custom-request') }}" style="font-size: medium; border-radius: 20px; padding: 8px 38px;">CUSTOM REQUEST</a>
        </div>
    </section>
</main>

@endsection
