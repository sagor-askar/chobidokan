@extends('includes.master')
@section('content')

    <main class="main">

        <!-- Hero Section -->
        @include('includes.hero')

        <h5 class="text-center mt-4">{{ $products->total() }} + images for "{{ $category?->name }}"</h5>

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
                                        <a href="{{ route('product-details',$product->id) }}" class="icon-circle">  
                                            <i class="fa fa-eye" title="View"></i>
                                        </a>

                                        @if($isPayment)
                                            <a href="{{ route('product.image-download', ['id' => base64_encode($product->id)]) }}" >
                                                <i class="fa fa-download" title="Download"></i>
                                            </a>
                                        @else

                                        <!-- add to wishlist -->
                                        @if(auth()->check())
                                            <form action="{{ route('wishlist.toggle', $product->id) }}"
                                                    method="POST"
                                                    style="display:inline;">
                                                @csrf
                                                <button type="submit" class="wishlist-btn">
                                                    <i class="fa
                                                        {{ $product->wishlists->where('user_id', auth()->id())->count()
                                                            ? 'fa-heart text-danger'
                                                            : 'fa-heart-o' }}">
                                                    </i>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('signin') }}" class="icon-circle">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        @endif


                                        {{-- Add to Cart --}}
                                        @if(auth()->check())
                                            <form action="{{ route('add.to.cart') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="cart-btn-pro">
                                                    <i class="fa fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('signin') }}" class="cart-btn-pro">
                                                <i class="fa fa-cart-plus"></i>
                                            </a>
                                        @endif


                                        <form action="{{ route('product.purchase') }}"
                                                method="POST"
                                                style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <button type="submit" class="icon-circle">
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
