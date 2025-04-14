@extends('includes.master')
@section('content')
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap");

<main class="main">

    <!-- Best Collection -->
    <section class="section">

        <div class="container my-5">
            <div class="border-bottom pb-3 px-2 d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <svg height="30px" class="mr-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 495 495" style="enable-background:new 0 0 495 495;" xml:space="preserve">
                        <g>
                            <path d="M495,103.513V95.5c0-21.78-17.72-39.5-39.5-39.5h-416C17.72,56,0,73.72,0,95.5v303.997c0,0.003,0,0.005,0,0.008
		C0.003,421.283,17.722,439,39.5,439h416c21.78,0,39.5-17.72,39.5-39.5V103.521C495,103.518,495,103.516,495,103.513z M39.5,71h416
		c13.509,0,24.5,10.99,24.5,24.5v4.883c-35.121,34.963-92.85,92.464-140.721,140.289l-75.162-75.162
		c-9.162-9.162-24.071-9.162-33.233,0L15,381.393V95.5C15,81.99,25.991,71,39.5,71z M455.5,424h-416
		c-12.519,0-22.868-9.439-24.319-21.574L241.49,176.117c3.314-3.314,8.706-3.314,12.021,0l75.158,75.158
		C289.26,290.67,258.813,321.249,257.5,323c-2.485,3.313-1.814,8.015,1.5,10.5c1.349,1.012,2.928,1.5,4.494,1.5
		c2.187,0,4.349-0.953,5.822-2.764C275.075,325.77,412.962,188.308,480,121.551V399.5C480,413.01,469.009,424,455.5,424z" />
                            <path d="M103.5,199c21.78,0,39.5-17.72,39.5-39.5S125.28,120,103.5,120S64,137.72,64,159.5S81.72,199,103.5,199z M103.5,135
		c13.509,0,24.5,10.99,24.5,24.5S117.009,184,103.5,184S79,173.01,79,159.5S89.991,135,103.5,135z" />
                        </g>
                    </svg>
                    <a href="#" style="color: #9B5DE5; font-size: 20px;" class="text-capitalize font-weight-bold mb-0">Customize Request</a>
                </div>
                <a href="#" class="btn btn-primary text-white">See All</a>
            </div>
            <div class="row">
                {{-- item --}}
                <div class="col-md-4 p-4">
                    <a href="{{ route('customize-details') }}" class="text-decoration-none text-dark">
                        <div style="box-shadow: 0 0 20px #ddd;">
                            <div class="position-relative" style="height: 320px; background-image: url('https://images.pexels.com/photos/2040627/pexels-photo-2040627.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'); background-position: center; background-size: cover;">
                                <div class="position-absolute px-3 py-4" style="background: rgba(0, 0, 0, .5); right: 0; bottom: 0; left: 0;">
                                    <h3 class="h6">
                                        <span class="text-white" style="line-height: 1.6;">
                                            Lorem ipsum dolor consectetur adipisicing elit. Commodi, ad!
                                        </span>
                                    </h3>

                                    <div class="mt-2 d-flex justify-content-between">
                                        <span class="pl-2 text-white"><i class="fa fa-tasks"></i><small> Logo Design</small></span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <span><i class="fa fa-clock-o text-info"></i> 5 days</span>
                                    <span><i class="fa fa-dollar text-info"></i> 40 dollar</span>
                                    <span><i class="fa fa-users text-info"></i> 20 designers</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>



            </div>
        </div>

    </section>

</main>
@endsection
