@extends('includes.master')
@section('content')
    {{-- external cdns --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <main class="main">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="sec-title text-center">
                            <h2>Happy Users of Chobi Dokan</h2>

                            <div class="section-borders">
                                <span></span>
                                <span class="black-border"></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel client-testimonial-carousel">
                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe 1<span>Land Broker</span></h3>
                            </div>
                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe 2<span>Land Broker</span></h3>
                            </div>
                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe 3<span>Land Broker</span></h3>
                            </div>
                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe 4<span>Land Broker</span></h3>
                            </div>

                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe 5<span>Land Broker</span></h3>
                            </div>
                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe 6<span>Land Broker</span></h3>
                            </div>
                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe 7<span>Land Broker</span></h3>
                            </div>
                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe 8<span>Land Broker</span></h3>
                            </div>

                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe 9<span>Land Broker</span></h3>
                            </div>
                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe <span>Land Broker</span></h3>
                            </div>
                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe <span>Land Broker</span></h3>
                            </div>
                            <div class="single-testimonial-item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Eveniet ex labore id beatae molestiae, libero quis eum nam voluptates quidem.</p>
                                <h3>Jane Doe <span>Land Broker</span></h3>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script src="main.js"></script>

        <script>
            $(document).ready(function() {
                $(".owl-carousel").owlCarousel({
                    items: 3,
                    //autoplay:false,
                    margin: 30,
                    loop: true,
                    dots: true
                });
            });
        </script>




    </main>
@endsection
