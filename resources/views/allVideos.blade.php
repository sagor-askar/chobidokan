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
    </style>
    <main class="main">

        <!-- Hero Section -->
        @include('includes.hero')

        <h5 class="text-center mt-4">1,00,000+ videos for "Title Name >> View All"</h5>

        <section class="mb-2">
            <div class="container">
                <div class="row">

                    <!-- video 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card image-card">
                            <video class="card-img-top" muted>
                                <source src="{{ asset('images/demo-video.mp4') }}" type="video/mp4">
                            </video>

                            <!-- Overlay -->
                            <div class="image-overlay">
                                <div class="overlay-icons">
                                    <i class="fa fa-eye"></i>
                                    <i class="fa fa-download"></i>
                                    <i class="fa fa-share-alt"></i>
                                </div>
                                <span>Video Title</span>
                            </div>
                        </div>
                    </div>

                    <!-- video 2 -->
                    <div class="col-md-4 mb-4">
                        <div class="card image-card">
                            <video class="card-img-top" muted>
                                <source src="{{ asset('images/demo-video.mp4') }}" type="video/mp4">
                            </video>

                            <!-- Overlay -->
                            <div class="image-overlay">
                                <div class="overlay-icons">
                                    <i class="fa fa-eye"></i>
                                    <i class="fa fa-download"></i>
                                    <i class="fa fa-share-alt"></i>
                                </div>
                                <span>Video Title</span>
                            </div>
                        </div>

                    </div>

                    <!-- video 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card image-card">
                            <video class="card-img-top" muted>
                                <source src="{{ asset('images/demo-video.mp4') }}" type="video/mp4">
                            </video>

                            <!-- Overlay -->
                            <div class="image-overlay">
                                <div class="overlay-icons">
                                    <i class="fa fa-eye"></i>
                                    <i class="fa fa-download"></i>
                                    <i class="fa fa-share-alt"></i>
                                </div>
                                <span>Video Title</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
