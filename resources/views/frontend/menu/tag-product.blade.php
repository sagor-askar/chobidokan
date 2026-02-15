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



  /* ===============================
    VIDEO CARD
 =================================*/
  .video-card {
      position: relative;
      border-radius: 12px;
      overflow: visible; /* dropdown visibility ঠিক রাখবে */
  }
  /* Video hover zoom */
  .video-card video {
      transition: transform 0.4s ease;
  }
  /*.video-card:hover video {*/
  /*    transform: scale(1.05);*/
  /*}*/

  /* ===============================
     WATERMARK
  =================================*/
  .watermark {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(-25deg);
      font-size: 40px;
      font-weight: 800;
      color: rgba(255, 255, 255, 0.15);
      text-transform: uppercase;
      pointer-events: none;
      user-select: none;
      z-index: 2;
  }

  /* ===============================
     OVERLAY
  =================================*/
  .video-overlay {
      position: absolute;
      bottom: 0;
      width: 100%;
      padding: 16px;
      background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
      color: #fff;
      transform: translateY(100%);
      transition: transform 0.4s ease;
      z-index: 3;
  }

  .video-card:hover .video-overlay {
      transform: translateY(0);
  }

  /* Title */
  .video-title {
      font-weight: 600;
      font-size: 15px;
      margin-bottom: 6px;
  }

  /* Meta Row */
  .video-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
  }

  /* ===============================
     ICON BUTTONS
  =================================*/
  .video-icons {
      display: flex;
      gap: 8px;
  }

  .video-icons a,
  .video-icons button {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255,255,255,0.12);
      color: #fff;
      transition: all 0.25s ease;
      cursor: pointer;
  }

  .video-icons a:hover,
  .video-icons button:hover {
      background: #ffc107;
      color: #000;
      transform: translateY(-2px);
  }

  /* ===============================
     SHARE DROPDOWN
  =================================*/

  /* ===============================
  SHARE BUTTON ICON STYLE
=================================*/
  .video-icons .share-wrapper {
      position: relative;
  }
  .video-icons .share-btn {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255,255,255,0.12);
      color: #fff;
      transition: all 0.25s ease;
      cursor: pointer;
      font-size: 16px;
  }
  .video-icons .share-btn:hover {
      background: #ffc107;
      color: #000;
      transform: translateY(-2px);
  }

  /* ===============================
     SHARE DROPDOWN - CENTERED
  =================================*/
  .video-icons .share-wrapper .share-dropdown {
      position: absolute;
      bottom: 50px; /* distance from button */
      left: 50%;
      transform: translateX(-50%); /* center horizontally */
      background: #fff;
      min-width: 140px;
      border-radius: 6px;
      padding: 8px 0;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      display: none;
      z-index: 10;
      text-align: center;
  }
  .video-icons .share-wrapper:hover .share-dropdown {
      display: block;
  }
  .video-icons .share-wrapper .share-dropdown a {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 6px;
      padding: 8px 12px;
      color: #fff;
      text-decoration: none;
      font-size: 16px;
      transition: all 0.25s ease;
      border-radius: 4px;
      margin: 4px 1px -6px 30px;
  }
  .share-dropdown a i.fa-facebook {
      color: #3b5998;
  }
  .share-dropdown a i.fa-whatsapp {
      color: #25D366;
  }
  .share-dropdown a i.fa-twitter {
      color: #1DA1F2;
  }
  .share-dropdown a i.fa-link {
      color: #333;
  }
  .share-dropdown a:hover {
      opacity: 0.85;
      transform: translateY(-2px);
  }

</style>

<main class="main">

  <!-- Hero Section -->
  @include('includes.hero')

  <h5 class="text-center mt-4">{{ $products->total() }} + for "{{ $tag }}"</h5>

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

          @if($product->type == 1)
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <a href="{{ route('product-details',$product->id) }}">
                            <img src="{{ route('product.file.view', $product->id) }}" alt="{{$product->file_name}}">
                        </a>
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
              @else
                <div class="col-md-4 mb-4">
                    <div class="video-card position-relative overflow-hidden rounded shadow-lg">
                        <!-- Video Wrapper -->
                        <div class="ratio ratio-16x9">
                            <a href="{{ route('product-details',$product->id) }}">
                                <video class="w-100" muted playsinline preload="metadata" onmouseenter="this.play()"
                                       onmouseleave="this.pause(); this.currentTime=0;">
                                    <source src="{{ route('product.view.video', $product->id) }}" type="{{ $product->file_type }}">
                                </video>
                            </a>
                        </div>

                        <div class="watermark">CHOBIDOKAN</div>
                        <!-- Play Icon -->
                        <a href="{{ route('product-details',$product->id) }}"
                           class="position-absolute top-50 start-50 translate-middle text-white"
                           style="z-index: 5;">
                            <i class="fa fa-play-circle fa-3x opacity-75"></i>
                        </a>
                        <!-- Overlay -->
                        <div class="video-overlay">
                            <div class="video-title">
                                {{ $product->title ?? '' }}
                            </div>
                            <div class="video-meta">
                                <span>Tk {{ $product->price ?? '' }}</span>
                                <div class="video-icons d-flex gap-2">
                                    <!-- View -->
                                    <a href="{{ route('product-details',$product->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <!-- Download / Buy -->
                                    @if($isPayment)
                                        <a href="{{ route('product.video-download', ['id' => base64_encode($product->id)]) }}">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @else
                                        <form action="{{ route('product.purchase') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit">
                                                <i class="fa fa-download"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <!-- Share -->
                                    <div class="share-wrapper">
                                        <i class="fa fa-share-alt share-btn" title="Share"></i>

                                        <div class="share-dropdown">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product-details',$product->id)) }}" target="_blank">
                                                <i class="fa fa-facebook"></i>
                                            </a>

                                            <a href="https://api.whatsapp.com/send?text={{ urlencode(route('product-details',$product->id)) }}" target="_blank">
                                                <i class="fa fa-whatsapp"></i>
                                            </a>

                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('product-details',$product->id)) }}&text={{ urlencode($product->title) }}" target="_blank">
                                                <i class="fa fa-twitter"></i>
                                            </a>

                                            <a href="javascript:void(0)" onclick="copyToClipboard('{{ route('product-details',$product->id) }}')">
                                                <i class="fa fa-link"></i>
                                            </a>
                                        </div>
                                    </div>
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
