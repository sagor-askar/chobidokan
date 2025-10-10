@extends('includes.master')
@section('content')
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container">
            <!-- search box with dropdown -->
            <div class="custom-input-group" style="display: flex; align-items: center; gap: 10px;">

                <!-- Dropdown -->
                <select class="custom-form-control" style="max-width: 10rem;">
                    <option value="all">All</option>
                    <option value="photos">Photos</option>
                    <option value="illustrations">Illustrations</option>
                    <option value="vectors">Vectors</option>
                </select>

                <!-- Search Input -->
                <input type="text" class="custom-form-control" placeholder="SEARCH IMAGE HERE">

                <!-- Search Button -->
                <div class="custom-input-group-append">
                    <button class="custom-btn" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>



    <!-- Best Collection -->
    <section class="section">
        <div class="container section-title" data-aos="fade-up">
            <p>Premium Collection<br></p>
        </div>

        <main class="container2">
            @foreach($products as $key=>$product)
                @php
                    $description = strip_tags($product->description);
                    $designer = $product->user->name;
                    $designer_id = $product->user->id;
                @endphp

                <div class="item item-{{$key}}"
                     data-title="{{ $product->title }}"
                     data-image="{{ asset($product->file_path) }}"
                     data-description="{{ $description }}"
                     data-designer="{{ $designer }}"
                     data-designer_id="{{ $designer_id }}"
                     onclick="openModal(this)">
                    <img class="img" src="{{ asset($product->file_path) }}" alt="">
                    <div class="overlay">{{ $product->title }} | Tk {{ $product->price }}</div>
                </div>
            @endforeach
        </main>
        <div class="pagination-wrapper d-flex justify-content-center mt-4" >
            {{ $products->withQueryString()->links('pagination.custom') }}
        </div>
    </section>

    <!-- Popup Modal -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle"></h2>
            <img id="modalImage" src="" alt="">

            <p id="modalDescription"></p>
            <a href="#" id="buyButton" class="btn btn-sm btn-primary" style="width: 20%;">Buy Now</a>
        </div>
    </div>

    <script>
        function openModal(element) {
            const title = element.dataset.title;
            const imageUrl = element.dataset.image;
            const description = element.dataset.description;
            const designer = element.dataset.designer;
            const designer_id = element.dataset.designer_id;
            const designerRoute = "{{ url('designer-profile') }}/" + designer_id;

            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalDescription').innerHTML =
                description + "<br> <strong>Designer:</strong> <a href='" + designerRoute + "' id='designerLink'>" + designer + "</a>";
            document.getElementById('buyButton').href = "{{ url('buy-product') }}/" + element.dataset.productId;

            document.getElementById('imageModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Close modal when clicking outside the content
        window.onclick = function(event) {
            let modal = document.getElementById('imageModal');
            if (event.target === modal) {
                closeModal();
            }
        };

    </script>

    <!-- popular search -->
    <section class="section">
        <div class="container section-title" data-aos="fade-up">
            <p>Popular Search<br></p>
        </div>

        <div class="container">
            @foreach($categories as $key=>$category)
               <button type="button" class="btn btn-outline-secondary popularSearch">{{$category->name}}</button>
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
