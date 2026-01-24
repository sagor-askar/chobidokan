@extends('includes.master')

@section('content')
    <main class="container-fluid py-5">

        <style>
            .premium-info-box h2 {
                position: relative;
                padding-bottom: 10px;
                margin-bottom: 1.5rem !important;
            }

            .premium-info-box h2::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                width: 60px;
                height: 4px;
                background-color: var(--bs-primary, #0d6efd);
            }
        </style>

        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="bg-white rounded-3 shadow-lg p-5 my-5 premium-info-box">

                    <h4 class="fw-bolder text-dark mb-4">
                        {{ $infoSetup?->title }}
                    </h4>

                    <p class="lead text-secondary lh-lg">
                        {!! $infoSetup?->description !!}
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
