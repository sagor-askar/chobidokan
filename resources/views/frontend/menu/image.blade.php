@extends('includes.master')
@section('content')
<style>
  .gallery {
    margin-top: 40px;
  }

  .gallery-item {
      position: relative;
      width: 100%;
      height: 250px; /* Fixed height (You can adjust) */
      border-radius: 8px;
      overflow: hidden;
  }

  .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Maintain same size for all images */
      display: block;
      transition: transform 0.4s ease;
  }

  .gallery-item:hover img {
      transform: scale(1.08);
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

  <h5 class="text-center mt-4">{{ $products->total() }}+ images  @if($search) for <strong> {{ $search }}</strong> @endif </h5>

  <div class="container gallery">
    <div class="row">
        @foreach($products as $key=>$product)
          <div class="col-md-4 mb-4">
            <div class="gallery-item">
              <img src="{{ asset($product->file_path) }}" alt="{{$product->file_name}}">
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
     @endforeach

    </div>
  </div>
</main>
@endsection
