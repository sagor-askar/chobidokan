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

  <h5 class="text-center mt-4">1,00,000+ images for "Title Name >> View All"</h5>

  <div class="container gallery">
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="gallery-item">
          <img src="{{ asset('frontend_assets/1.jpg') }}" alt="Gallery Image 1">
          <div class="overlay">
            <h6>Happy Senior Couple</h6>
            <div class="overlay-icons">
              <i class="fa fa-eye" title="View"></i>
              <i class="fa fa-download" title="Download"></i>
              <i class="fa fa-share-alt" title=""></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="gallery-item">
          <img src="{{ asset('frontend_assets/1.jpg') }}" alt="Gallery Image 2">
          <div class="overlay">
            <h6>Outdoor Activity</h6>
            <div class="overlay-icons">
              <i class="fa fa-eye" title="View"></i>
              <i class="fa fa-download" title="Download"></i>
              <i class="fa fa-share-alt" title=""></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="gallery-item">
          <img src="{{ asset('frontend_assets/1.jpg') }}" alt="Gallery Image 3">
          <div class="overlay">
            <h6>Smiling Grandma</h6>
            <div class="overlay-icons">
              <i class="fa fa-eye" title="View"></i>
              <i class="fa fa-download" title="Download"></i>
              <i class="fa fa-share-alt" title=""></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
