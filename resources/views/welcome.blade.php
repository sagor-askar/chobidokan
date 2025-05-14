@extends('includes.master')
@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container">
                <!-- search box -->
                <div class="custom-input-group">
                    <input type="text" class="custom-form-control" placeholder="SEARCH IMAGE HERE">
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
                <p>Best Collection<br></p>
            </div>

            <main class="container2">
                <div class="item item-1" onclick="openModal('Image 1', 'https://picsum.photos/500/300')">
                    <img class="img" src="https://picsum.photos/500/300" alt="">
                    <div class="overlay">Image 1</div>
                </div>
                <div class="item item-2" onclick="openModal('Image 2', 'https://picsum.photos/500/301')">
                    <img class="img" src="https://picsum.photos/500/301" alt="">
                    <div class="overlay">Image 2</div>
                </div>
                <div class="item item-3" onclick="openModal('Image 3', 'https://picsum.photos/500/302')">
                    <img class="img" src="https://picsum.photos/500/302" alt="">
                    <div class="overlay">Image 3</div>
                </div>
                <div class="item item-4" onclick="openModal('Image 4', 'https://picsum.photos/500/600')">
                    <img class="img" src="https://picsum.photos/500/600" alt="">
                    <div class="overlay">Image 4</div>
                </div>
                <div class="item item-5" onclick="openModal('Image 5', 'https://picsum.photos/500/800')">
                    <img class="img" src="https://picsum.photos/500/800" alt="">
                    <div class="overlay">Image 5</div>
                </div>
                <div class="item item-6" onclick="openModal('Image 6', 'https://picsum.photos/500/400')">
                    <img class="img" src="https://picsum.photos/500/400" alt="">
                    <div class="overlay">Image 6</div>
                </div>
                <div class="item item-7" onclick="openModal('Image 7', 'https://picsum.photos/500/304')">
                    <img class="img" src="https://picsum.photos/500/304" alt="">
                    <div class="overlay">Image 7</div>
                </div>
                <div class="item item-8" onclick="openModal('Image 8', 'https://picsum.photos/500/401')">
                    <img class="img" src="https://picsum.photos/500/401" alt="">
                    <div class="overlay">Image 8</div>
                </div>
            </main>
        </section>

        <!-- Popup Modal -->
        <div id="imageModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2 id="modalTitle"></h2>
                <img id="modalImage" src="" alt="">
                <p id="modalDescription">
                    This is one of the most creative photo from the July event. Specially added by the designer.
                    Uploaded By: <a href="">Sagor Askar</a>.
                </p>
            </div>
        </div>

        <script>
            function openModal(title, imageUrl) {
                document.getElementById('modalTitle').innerText = title;
                document.getElementById('modalImage').src = imageUrl;
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
                <button type="button" class="btn btn-outline-secondary popularSearch">Business</button>
                <button type="button" class="btn btn-outline-secondary popularSearch">Wedding</button>
                <button type="button" class="btn btn-outline-secondary popularSearch">Education</button>
                <button type="button" class="btn btn-outline-secondary popularSearch">Festivals</button>
                <button type="button" class="btn btn-outline-secondary popularSearch">Farmer</button>
                <button type="button" class="btn btn-outline-secondary popularSearch">Celebration</button>
                <button type="button" class="btn btn-outline-secondary popularSearch">Office</button>
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
                <a type="button" class="btn btn-dark" href="{{ route('seller-registration') }}"
                    style="font-size: medium; border-radius: 20px; padding: 8px 38px;">BECOME A SELLER</a>
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

                <a type="button" class="btn btn-dark" href="{{ route('custom-request') }}"
                    style="font-size: medium; border-radius: 20px; padding: 8px 38px;">CUSTOM REQUEST</a>
            </div>
        </section>
    </main>

@endsection
