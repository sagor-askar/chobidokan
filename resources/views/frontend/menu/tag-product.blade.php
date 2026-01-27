@extends('includes.master')
@section('content')
<style>
  .gallery {
    margin-top: 40px;
  }

  .gallery-item {
    position: relative;
    overflow: hidden;
  }

  .gallery-item img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.4s ease;
  }

  .gallery-item:hover img {
    transform: scale(1.05);
  }

  /* Overlay */
  .overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.6);
    color: white;
    height: 80px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transform: translateY(100%);
    transition: all 0.4s ease;
  }

  .gallery-item:hover .overlay {
    opacity: 1;
    transform: translateY(0);
  }

  .overlay h6 {
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    color: #fff;
  }

  .overlay-icons {
    margin-top: 5px;
  }

  .overlay i {
    font-size: 18px;
    margin: 0 10px;
    cursor: pointer;
    transition: color 0.2s;
  }

  .overlay i:hover {
    color: #ffc107;
  }
</style>

<main class="main">

  <!-- Hero Section -->
  @include('includes.hero')

  <h5 class="text-center mt-4">{{ $products->total() }} + for "{{ $tag }}"</h5>

  <div class="container gallery">
    <div class="row">

      @foreach($products as $key=>$product)
          @if($product->type == 1)
              <div class="col-md-4 mb-4">
                <div class="gallery-item">
                    <a href="{{ route('product-details',$product->id) }}">
                        <img src="{{ asset($product->file_path) }}" alt="{{$product->file_name}}">
                    </a>
                  <div class="overlay">
                    <h6>{{ $product->title ?? '' }}</h6>
                    <div class="overlay-icons">
                        <a href="{{ route('product-details',$product->id) }}">  <i class="fa fa-eye" title="View"></i></a>
                      <i class="fa fa-download" title="Download"></i>
                      <i class="fa fa-share-alt" title=""></i>
                    </div>
                  </div>
                </div>
              </div>
              @else
                <div class="col-md-4 mb-4">
                    <div class="position-relative overflow-hidden rounded shadow-lg">
                        <!-- Video Wrapper -->
                        <div class="ratio ratio-16x9">
                            <video class="w-100" muted playsinline preload="metadata" onmouseenter="this.play()"
                                   onmouseleave="this.pause(); this.currentTime=0;">
                                <source src="{{ asset($product->file_path) }}" type="video/mp4">
                            </video>
                        </div>
                        <!-- Play Icon -->
                        <a href="{{ route('product-details',$product->id) }}"
                           class="position-absolute top-50 start-50 translate-middle text-white"
                           style="z-index: 5;">
                            <i class="fa fa-play-circle fa-3x opacity-75"></i>
                        </a>
                        <!-- Overlay -->
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white"
                             style="background: linear-gradient(transparent, rgba(0,0,0,0.85));">
                            <div class="fw-semibold">{{ $product->title ?? '' }}</div>
                            <div class="d-flex justify-content-between align-items-center small mt-1">
                                <span>Tk {{ $product->price ?? '' }}</span>

                                <div class="d-flex gap-3">
                                    <i class="fa fa-eye"></i>
                                    <i class="fa fa-download"></i>
                                    <i class="fa fa-share-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    @endforeach

    </div>
  </div>
</main>
@endsection
