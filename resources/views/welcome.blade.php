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
            <div class="item-1 item">
                <img class="img" src="https://picsum.photos/500/300" alt="">
                <div class="overlay">Image 1</div>
            </div>
            <div class="item-2 item">
                <img class="img" src="https://picsum.photos/500/301" alt="">
                <div class="overlay">Image 2</div>
            </div>
            <div class="item-3 item">
                <img class="img" src="https://picsum.photos/500/302" alt="">
                <div class="overlay">Image 3</div>
            </div>
            <div class="item-4 item">
                <img class="img" src="https://picsum.photos/500/600" alt="">
                <div class="overlay">Image 4</div>
            </div>
            <div class="item-5 item">
                <img class="img" src="https://picsum.photos/500/800" alt="">
                <div class="overlay">Image 5</div>
            </div>
            <div class="item-6 item">
                <img class="img" src="https://picsum.photos/500/400" alt="">
                <div class="overlay">Image 6</div>
            </div>
            <div class="item-7 item">
                <img class="img" src="https://picsum.photos/500/304" alt="">
                <div class="overlay">Image 7</div>
            </div>
            <div class="item-8 item">
                <img class="img" src="https://picsum.photos/500/401" alt="">
                <div class="overlay">Image 8</div>
            </div>
        </main>
    </section>



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
            <a type="button" class="btn btn-dark" href="" style="font-size: medium; border-radius: 20px; padding: 8px 38px;">BECOME A SELLER</a>
        </div>
    </section>

    <!-- customized photo request section -->
    <section class="section">
        <div class="container mb-3">
            <h3>Customized Photograph Request</h3>
            <p>You can submit a request for customized theme photograph here. For example: you need a photo of a
                village
                road where a boy bycycling at morning. After you submit this our registered photographers will
                submit this theme
                image and you can purchase whatever you like.</p>

            <a type="button" class="btn btn-dark" href="" style="font-size: medium; border-radius: 20px; padding: 8px 38px;">CUSTOM REQUEST</a>
        </div>
    </section>

</main>
@endsection
