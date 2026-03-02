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

  .watermark {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(-25deg);
      font-size: 40px;
      font-weight: 500;
      color: rgba(255, 255, 255, 0.2);
      text-transform: uppercase;
      white-space: nowrap;
      pointer-events: none;
      user-select: none;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
      z-index: 2;
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

  .category-overlay {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #fff;
      font-size: 22px;
      font-weight: 800;
      text-align: center;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
      opacity: 0;
      transition: 0.3s ease;
      z-index: 3;
  }

  .gallery-item:hover .category-overlay {
      opacity: 1;
  }


  /* share  */
  .share-wrapper {
      position: relative;
      display: inline-block;
  }

  .share-dropdown {
      position: absolute;
      bottom: 40px;
      right: 0;
      background: #fff;
      min-width: 160px;
      border-radius: 6px;
      padding: 8px 0;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      display: none;
      z-index: 10;
  }

  .share-dropdown a {
      display: block;
      padding: 8px 12px;
      color: #333;
      text-decoration: none;
      font-size: 14px;
  }

  .share-dropdown a:hover {
      background: #f5f5f5;
  }

</style>

<main class="main">

  <!-- Hero Section -->
  @include('includes.hero')

  <h5 class="text-center mt-4">{{ $products->total() }}+ images  @if($search) for <strong> {{ $search }}</strong> @endif </h5>

  <div class="container gallery">
    <div class="row">
        @foreach($products as $key=>$product)
          @php
           $isPayment = null;
           $authUser =  \Illuminate\Support\Facades\Auth::check() ? Auth::user() : null;
           if ($authUser) {
             $isPayment =  \App\Models\Payment::where('product_id', $product->id)->where('user_id',$authUser->id)->first();
          }
            @endphp
          <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <a href="{{ route('category-wise-product',$product->category_id) }}">
                    <img src="{{ route('product.file.view', $product->id) }}" alt="{{$product->file_name}}">
                </a>


                <div class="category-overlay">
                    <a href="{{ route('category-wise-product', $product->category_id) }}" style="color:white">
                        <span>{{ $product->category?->name }}</span>
                    </a>
                </div>

                <div class="watermark">CHOBIDOKAN</div>

              <div class="overlay">
                <h6>{{ $product->title ?? '' }}</h6>
                <div class="overlay-icons">
                    <a href="{{ route('product-details',$product->id) }}">  <i class="fa fa-eye" title="View"></i></a>
                    @if($isPayment)
                        <a href="{{ route('product.image-download', ['id' => base64_encode($product->id)]) }}" >
                            <i class="fa fa-download" title="Download"></i>
                        </a>
                    @else
                        <form action="{{ route('product.purchase') }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button type="submit">
                                <i class="fa fa-download" title="Buy"></i>
                            </button>
                        </form>
                    @endif
                    <div class="share-wrapper">
                        <i class="fa fa-share-alt share-btn" title="Share"></i>

                        <div class="share-dropdown">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product-details',$product->id)) }}" target="_blank">
                                <i class="fa fa-facebook"></i> Facebook
                            </a>

                            <a href="https://api.whatsapp.com/send?text={{ urlencode(route('product-details',$product->id)) }}" target="_blank">
                                <i class="fa fa-whatsapp"></i> WhatsApp
                            </a>

                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('product-details',$product->id)) }}&text={{ urlencode($product->title) }}" target="_blank">
                                <i class="fa fa-twitter"></i> Twitter
                            </a>

                            <a href="javascript:void(0)" onclick="copyToClipboard('{{ route('product-details',$product->id) }}')">
                                <i class="fa fa-link"></i> Copy Link
                            </a>
                        </div>
                    </div>

                </div>
              </div>
            </div>
          </div>
     @endforeach

    </div>
  </div>
</main>
@endsection
