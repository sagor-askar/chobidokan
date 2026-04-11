@extends('includes.master')
@section('content')
<style>
  .gallery {
    margin-top: 40px;
  }

  .gallery-item {
      position: relative;
      width: 100%;
      height: 250px;
      border-radius: 6px;
      overflow: hidden;
  }

  .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.3s ease, filter 0.3s ease !important;
  }

  .gallery-item:hover img {
      transform: scale(1.03) !important;
      filter: brightness(0.95);
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

  .gallery-item .overlay {
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      height: 100%;
      background: linear-gradient(180deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 30%, rgba(0,0,0,0) 70%, rgba(0,0,0,0.8) 100%) !important;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 15px !important;
      opacity: 0 !important;
      transform: translateY(0) !important;
      transition: opacity 0.3s ease !important;
      pointer-events: none;
      z-index: 5;
  }

  .gallery-item:hover .overlay {
      opacity: 1 !important;
      pointer-events: auto;
  }

  .overlay-top {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      width: 100%;
      gap: 10px;
  }

  .overlay-bottom {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      width: 100%;
      gap: 10px;
  }

  .overlay-top-left {
      flex: 1;
      overflow: hidden;
  }

  .overlay-top-right, .overlay-bottom-left, .overlay-bottom-right {
      display: flex;
      gap: 10px;
      align-items: center;
  }

  .gallery-item .overlay h6 {
      color: white !important;
      margin-top: 0 !important;
      margin-bottom: 5px !important;
      font-weight: 500 !important;
      font-size: 16px !important;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.9);
      text-align: left;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      white-space: normal;
      line-height: 1.3;
  }

  .action-btn,
  .share-wrapper {
      background: rgba(255, 255, 255, 0.9) !important;
      border: none !important;
      border-radius: 50% !important;
      width: 40px !important;
      height: 40px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      text-decoration: none !important;
      cursor: pointer;
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
      box-shadow: 0 3px 6px rgba(0,0,0,0.15) !important;
      padding: 0 !important;
      position: relative;
  }

  .action-btn i, .share-wrapper i {
      margin: 0 !important;
      font-size: 17px !important;
      color: #4b4b4b !important;
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
  }

  .action-btn i.fa-heart.text-danger {
      color: #ff4757 !important;
  }

  .action-btn:hover,
  .share-wrapper:hover {
      background: #ffffff !important;
      transform: translateY(-3px) scale(1.05) !important;
      box-shadow: 0 5px 12px rgba(0,0,0,0.25) !important;
  }

  .action-btn:hover i.fa-heart-o,
  .action-btn:hover i.fa-heart { color: #ff4757 !important; }
  .action-btn:hover i.fa-cart-plus { color: #1e90ff !important; }
  .action-btn:hover i.fa-clone { color: #ffa502 !important; }
  .action-btn:hover i.fa-eye { color: #3742fa !important; }
  .share-wrapper:hover i.fa-share-alt { color: #2ed573 !important; }
  .action-btn:hover i.fa-download { color: #00b894 !important; }

  .share-dropdown {
      position: absolute;
      bottom: 50px !important;
      right: 0 !important;
      left: auto !important;
      background: white;
      border-radius: 6px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.15);
      padding: 10px;
      display: none;
      flex-direction: column;
      gap: 8px;
      z-index: 100;
      width: 140px;
      transform: translateY(10px);
      opacity: 0;
      animation: fadeIn 0.3s forwards;
  }

  @keyframes fadeIn {
      to { opacity: 1; transform: translateY(0); }
  }

  .share-dropdown a {
      display: flex !important;
      align-items: center !important;
      gap: 8px;
      color: #555 !important;
      text-decoration: none !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      padding: 6px !important;
      background: transparent !important;
      box-shadow: none !important;
      border-radius: 4px !important;
      width: auto !important;
      height: auto !important;
      transform: none !important;
      transition: all 0.2s !important;
  }

  .share-dropdown a i {
      font-size: 16px !important;
      color: #555 !important;
  }

  .share-dropdown a:hover {
      background: #f1f2f6 !important;
      color: #1e90ff !important;
  }

  .share-dropdown a:hover i {
      color: #1e90ff !important;
  }

  .wishlist-btn form, .cart-btn-form {
      margin: 0 !important;
      padding: 0 !important;
      display: inline-block !important;
  }

  .wishlist-btn button, .cart-btn-form button {
      border: none;
      outline: none;
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
      z-index: 10;
  }

  .gallery-item:hover .category-overlay {
      opacity: 1;
  }
</style>

<main class="main">

  <!-- Hero Section -->
  @include('includes.hero')

  <h5 class="text-center mt-4">{{ $products->total() }}+ Images @if($search) of Category <strong> "{{ $search }}"</strong> @endif </h5>

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
                  <div class="overlay-top">
                      <!-- Top Left: Title -->
                      <div class="overlay-top-left">
                          <h6>{{ $product->title ?? '' }}</h6>
                      </div>

                      <!-- Top Right: Wishlist and Cart -->
                      <div class="overlay-top-right">
                          <!-- Wishlist -->
                          @if(auth()->check())
                              <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="wishlist-btn">
                                  @csrf
                                  <button type="submit" class="action-btn" title="Save">
                                      <i class="fa {{ $product->wishlists->where('user_id', auth()->id())->count() ? 'fa-heart text-danger' : 'fa-heart-o' }}"></i>
                                  </button>
                              </form>
                          @else
                              <a href="{{ route('signin') }}" class="action-btn">
                                  <i class="fa fa-heart-o"></i>
                              </a>
                          @endif

                          <!-- Cart -->
                          @if(!$isPayment)
                              @if(auth()->check())
                                  <form action="{{ route('add.to.cart') }}" method="POST" class="cart-btn-form">
                                      @csrf
                                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                                      <button type="submit" class="action-btn" title="Add to Cart">
                                          <i class="fa fa-cart-plus"></i>
                                      </button>
                                  </form>
                              @else
                                  <a href="{{ route('signin') }}" class="action-btn">
                                      <i class="fa fa-cart-plus"></i>
                                  </a>
                              @endif
                          @endif
                      </div>
                  </div>

                  <div class="overlay-bottom">
                      <!-- Bottom Left: Similar and View -->
                      <div class="overlay-bottom-left">
                          <a href="{{ route('category-wise-product',$product->category_id) }}" class="action-btn" title="Find Similar">
                              <i class="fa fa-clone"></i>
                          </a>

                          <a href="{{ route('product-details',$product->id) }}" class="action-btn" title="View">
                              <i class="fa fa-eye"></i>
                          </a>
                      </div>

                      <!-- Bottom Right: Share and Download -->
                      <div class="overlay-bottom-right">
                          <!-- Share -->
                          <div class="share-wrapper action-btn">
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

                          <!-- Download / Buy -->
                          @if($isPayment)
                              <a href="{{ route('product.image-download', ['id' => base64_encode($product->id)]) }}" class="action-btn" title="Download">
                                  <i class="fa fa-download"></i>
                              </a>
                          @else
                              <form action="{{ route('product.purchase') }}" method="POST" class="cart-btn-form">
                                  @csrf
                                  <input type="hidden" name="product_id" value="{{$product->id}}">
                                  <button type="submit" class="action-btn" title="Buy">
                                      <i class="fa fa-download"></i>
                                  </button>
                              </form>
                          @endif
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
