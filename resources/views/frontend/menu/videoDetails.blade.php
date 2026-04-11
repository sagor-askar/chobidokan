@extends('includes.master')
@section('content')
    <style>
        body {
            background-color: #f8f9fa; /* Sleek background */
        }

        .image-preview-wrapper {
            position: relative;
            background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAOElEQVQYV2N89erVfwY0ICYmxhhgxKphGAWjYEwB5y5dumSEcRmN7u7uRjTNKF4YZoGwi+DqkAIA1z8kR+H/TngAAAAASUVORK5CYII='), #ffffff;
            background-repeat: repeat;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 25px rgba(0,0,0,0.06);
            border: 1px solid #eaeaea;
            min-height: 400px;
            cursor: pointer;
        }

        .image-preview-wrapper img {
            width: 100%;
            height: auto;
            max-height: 80vh;
            object-fit: contain;
            display: block;
            transition: transform 0.3s ease;
        }

        /* Repeating Watermark Pattern over image */
        .watermark-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 10;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="350" height="250"><g transform="translate(175, 125) rotate(-25) translate(-175, -125)"><text x="175" y="125" font-size="28" font-family="Arial, sans-serif" font-weight="300" fill="rgba(255,255,255,0.3)" text-anchor="middle" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">CHOBIDOKAN</text></g></svg>');
            background-repeat: repeat;
        }

        /* Sidebar Panel (Shutterstock Match) */
        .sidebar-panel {
            background: #ffffff;
            position: sticky;
            top: 30px;
        }

        .shutter-plan-card {
            border: 1px solid #b3b3b3;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            cursor: pointer;
            background: #ffffff;
            position: relative;
        }

        .shutter-plan-card.selected {
            border: 2px solid #222222;
            padding: 15px; /* adjust for thicker border */
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }

        .custom-shutter-radio {
            appearance: none;
            width: 22px;
            height: 22px;
            border: 2px solid #222;
            border-radius: 50%;
            margin: 0;
            margin-top: 2px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            outline: none;
            cursor: pointer;
            flex-shrink: 0;
        }
        .custom-shutter-radio:checked::after {
            content: "";
            width: 10px;
            height: 10px;
            background: #222;
            border-radius: 50%;
        }

        .shutter-plan-title {
            font-size: 16px;
            font-weight: 700;
            color: #000;
            margin-left: 10px;
        }

        .shutter-price {
            font-size: 17px;
            font-weight: 700;
            color: #000;
            line-height: 1.1;
        }

        .shutter-price-sub {
            font-size: 12px;
            color: #4b4b4b;
            margin-top: 3px;
        }

        .shutter-desc {
            font-size: 14px;
            color: #444;
            margin-left: 32px;
            margin-top: 6px;
            line-height: 1.5;
        }

        .shutter-pack-selector {
            margin-left: 32px;
            margin-top: 14px;
            border: 1px solid #d4d4d4;
            border-radius: 6px;
            display: inline-flex;
            overflow: hidden;
            font-family: inherit;
        }
        .shutter-pack-item {
            padding: 8px 16px;
            font-size: 14px;
            color: #4b4b4b;
            border-right: 1px solid #d4d4d4;
        }
        .shutter-pack-item:last-child {
            border-right: none;
        }
        .shutter-pack-item.active {
            background: #cdcdcd;
            color: #111;
            border: 2px solid #111;
            margin: -1px;
            border-radius: 6px;
            font-weight: 500;
        }

        .shutter-download-btn {
            background: #f12c4c;
            color: white;
            font-size: 17px;
            font-weight: 700;
            width: 100%;
            border: none;
            border-radius: 6px;
            padding: 14px;
            text-align: center;
            transition: background 0.2s;
            margin-top: 5px;
        }
        .shutter-download-btn:hover {
            background: #d8213e;
            color: white;
        }

        .shutter-more-plans {
            text-align: center;
            margin-top: 20px;
        }
        .shutter-more-plans a {
            color: #000;
            font-weight: 800;
            font-size: 15px;
            text-decoration: none;
        }

        .shutter-business-box {
            border: 1px solid #f1f1f1;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            cursor: pointer;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: box-shadow 0.2s;
        }
        .shutter-business-box:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.06);
        }

        /* Meta text styling */
        .meta-title {
            font-size: 24px;
            font-weight: 800;
            color: #2d3436;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .author-chip {
            display: inline-flex;
            align-items: center;
            background: #ffffff;
            padding: 6px 16px 6px 6px;
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            border: 1px solid #f1f2f6;
            text-decoration: none;
            color: #2d3436;
            transition: all 0.2s;
        }
        .author-chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            color: #ff3b3f;
        }

        .author-chip img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            margin-right: 12px;
            object-fit: cover;
        }

        .author-chip .author-info {
            display: flex;
            flex-direction: column;
        }

        .author-chip .author-name {
            font-weight: 700;
            font-size: 14px;
            line-height: 1.2;
        }

        .author-chip .author-meta {
            font-size: 11.5px;
            color: #636e72;
        }

        /* Action Toolbar beneath image */
        .action-toolbar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #e0e6ed;
            margin-bottom: 25px;
            gap: 15px;
        }

        .toolbar-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        /* Keep buttons inside boundaries on desktops, remove margin on mobile */
        @media (min-width: 992px) {
            .action-toolbar-right {
                margin-right: 55px;
            }
        }

        .btn-action-icon {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 16px;
            color: #475569;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            outline: none;
        }

        .btn-action-icon:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #ff3b3f;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .btn-action-icon i {
            font-size: 16px;
        }

        /* Tags styling */
        .tag-btn {
            background: #e2e8f0;
            color: #475569;
            border: none;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 13px;
            font-weight: 600;
            margin-right: 6px;
            margin-bottom: 8px;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .tag-btn:hover {
            background: #cbd5e1;
            color: #0f172a;
        }

        /* Share dropdown */
        .share-wrapper {
            position: relative;
            display: inline-block;
        }
        .share-dropdown {
            position: absolute;
            bottom: calc(100% + 10px);
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            padding: 10px;
            display: none;
            flex-direction: column;
            gap: 5px;
            z-index: 100;
            min-width: 160px;
            border: 1px solid #f1f2f6;
        }
        .share-dropdown a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            color: #475569;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .share-dropdown a:hover {
            background: #f1f5f9;
            color: #1e90ff;
        }

        /* Image Details Specs */
        .image-specs {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #f1f2f6;
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f8f9fa;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }
        .info-value {
            color: #0f172a;
            font-size: 14px;
            font-weight: 600;
            text-align: right;
        }

        /* Similar Videos overlay styles */
        .gallery-item {
            position: relative;
            width: 100%;
            height: 250px;
            border-radius: 6px;
            overflow: hidden;
        }

        .gallery-item img, .gallery-item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease, filter 0.3s ease !important;
        }

        .gallery-item:hover img, .gallery-item:hover video {
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
        .gallery-item .share-wrapper {
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

        .action-btn i, .gallery-item .share-wrapper i.share-btn {
            margin: 0 !important;
            font-size: 17px !important;
            color: #4b4b4b !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .action-btn i.fa-heart.text-danger {
            color: #ff4757 !important;
        }

        .action-btn:hover,
        .gallery-item .share-wrapper:hover {
            background: #ffffff !important;
            transform: translateY(-3px) scale(1.05) !important;
            box-shadow: 0 5px 12px rgba(0,0,0,0.25) !important;
        }

        .action-btn:hover i.fa-heart-o,
        .action-btn:hover i.fa-heart { color: #ff4757 !important; }
        .action-btn:hover i.fa-cart-plus { color: #1e90ff !important; }
        .action-btn:hover i.fa-clone { color: #ffa502 !important; }
        .action-btn:hover i.fa-eye { color: #3742fa !important; }
        .gallery-item .share-wrapper:hover i.share-btn { color: #2ed573 !important; }
        .action-btn:hover i.fa-download { color: #00b894 !important; }

        .gallery-item .share-dropdown {
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
            border: none;
        }

        @keyframes fadeIn {
            to { opacity: 1; transform: translateY(0); }
        }

        .gallery-item .share-dropdown a {
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

        .gallery-item .share-dropdown a i {
            font-size: 16px !important;
            color: #555 !important;
        }

        .gallery-item .share-dropdown a:hover {
            background: #f1f2f6 !important;
            color: #1e90ff !important;
        }

        .gallery-item .share-dropdown a:hover i {
            color: #1e90ff !important;
        }

        .gallery-item .share-wrapper:hover .share-dropdown {
            display: flex;
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

        /* Custom Popup */
        .image-popup {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(0,0,0,0.85);
            justify-content: center;
            align-items: center;
        }
        .popup-content-wrapper {
            display: flex;
            flex-direction: column;
            width: 90vw;
            height: 90vh;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            background: #111;
        }
        .popup-image-container {
            position: relative;
            background: #111;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }
        .popup-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }
        .popup-footer {
            background: #2a2c31;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .popup-footer .brand {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .popup-footer .image-id {
            text-align: right;
            font-size: 11px;
            font-weight: 600;
            color: #ffffff;
            line-height: 1.4;
        }
        .popup-footer .image-id span {
            color: #9ba0a9;
            font-weight: normal;
        }
        .popup-close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 32px;
            font-weight: lighter;
            color: #fff;
            cursor: pointer;
            transition: color 0.2s;
            z-index: 10000;
        }
        .popup-close:hover {
            color: #ff3b3f;
        }
    </style>

    <!-- Hero Section -->
    @include('includes.hero')

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row gx-lg-5">

            <!-- Left Side: Image and Details -->
            <div class="col-lg-8 mb-5 mb-lg-0">

                <!-- Main Image Preview with Watermark -->
                <div class="image-preview-wrapper" onclick="openImageModal()">
                    <video id="productVideo" class="popup-image" style="max-height: 80vh; z-index: 1;" muted playsinline controlsList="nodownload" oncontextmenu="return false;" onmouseenter="this.play()" onmouseleave="this.pause(); this.currentTime=0;"><source src="{{ route('product.view.video', $product->id) }}" type="{{ $product->file_type }}"></video>

                    <!-- Repeating Watermark Overlay -->
                    <div class="watermark-overlay"></div>

                    <!-- Zoom (+) Button floating -->
                    <button type="button" class="btn btn-light rounded-circle shadow position-absolute d-flex align-items-center justify-content-center" style="bottom: 20px; right: 20px; width: 45px; height: 45px; opacity: 0.9; z-index: 20;">
                        <i class="fa fa-search-plus text-dark" style="font-size:18px;"></i>
                    </button>

                    <!-- Formats Badge Overlay -->
                    <div class="position-absolute d-flex gap-2" style="top: 20px; left: 20px; z-index: 20;">
                        <span class="badge bg-dark text-white shadow-sm" style="opacity:0.85;">HD {{ strtoupper($product->file_type ?? 'MP4') }}</span>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-muted fw-semibold d-block mb-2">Video Format</small>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-secondary-subtle text-dark" id="dynamicResBadge">
                            <i class="fa fa-spinner fa-spin"></i> Loading...
                        </span>
                        <span class="badge bg-secondary-subtle text-dark" id="dynamicDurBadge">
                            <i class="fa fa-spinner fa-spin"></i> Loading...
                        </span>
                    </div>
                </div>

                <!-- Action Toolbar -->
                <div class="action-toolbar">
                    <div class="toolbar-group">
                        <!-- Author / Contributor Info -->
                        <a target="_blank" href="{{ route('designer-profile', $product->designer->id ?? 1) }}" class="author-chip">
                            <img src="{{ isset($product->designer) && $product->designer->image ? asset($product->designer->image) : 'http://1.gravatar.com/avatar/7a20fad302fc2dd4b4649dc5bdb3c463?s=64&d=mm&r=g' }}" alt="Author">
                            <div class="author-info">
                                <span class="author-name">{{ $product->designer->name ?? 'Contributor' }}</span>
                                <span class="author-meta">{{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="toolbar-group action-toolbar-right">
                        <button type="button" class="btn-action-icon" style="cursor:default;">
                            <i class="fa fa-download text-muted"></i>
                            <span>{{ $product->total_download ?? 0 }}</span>
                        </button>

                        <!-- Wishlist -->
                        @if(auth()->check())
                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn-action-icon">
                                    <i class="fa {{ $product->wishlists->where('user_id', auth()->id())->count() ? 'fa-heart text-danger' : 'fa-heart-o' }}"></i> Save
                                </button>
                            </form>
                        @else
                            <a href="{{ route('signin') }}" class="btn-action-icon">
                                <i class="fa fa-heart-o"></i> Save
                            </a>
                        @endif

                        <!-- Share Dropdown -->
                        <div class="share-wrapper">
                            <button type="button" class="btn-action-icon" onclick="toggleShare(event)">
                                <i class="fa fa-share-alt"></i> Share
                            </button>
                            <div class="share-dropdown" id="shareDropdownList">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product-details',$product->id)) }}" target="_blank">
                                    <i class="fa fa-facebook" style="color:#1877F2;"></i> Facebook
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode(route('product-details',$product->id)) }}" target="_blank">
                                    <i class="fa fa-whatsapp" style="color:#25D366;"></i> WhatsApp
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('product-details',$product->id)) }}&text={{ urlencode($product->title) }}" target="_blank">
                                    <i class="fa fa-twitter" style="color:#1DA1F2;"></i> Twitter
                                </a>
                                <a href="javascript:void(0)" onclick="copyToClipboard('{{ route('product-details',$product->id) }}')">
                                    <i class="fa fa-link"></i> Copy Link
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description & Details -->
                <div class="mb-4">
                    <h1 class="meta-title">{{ $product->title ?? 'A beautiful creation' }}</h1>

                    <div class="text-secondary mb-4" id="descriptionContainer" style="font-size: 15.5px; line-height: 1.8;">
                        @php
                            $fullText = $product->description ?? '';
                            $plainText = strip_tags($fullText);
                            $isLong = strlen($plainText) > 500;
                            $shortText = \Illuminate\Support\Str::limit($plainText, 500, '');
                        @endphp

                        @if($isLong)
                            <div id="descShort">
                                {{ $shortText }}<span id="dots"> ...</span>
                                <a href="javascript:void(0)" onclick="toggleDesc()" id="seeMoreBtn" style="color: #1e90ff; font-weight: 400; text-decoration: none;"> See more</a>
                            </div>
                            <div id="descFull" style="display: none;">
                                {!! $fullText !!}
                                <a href="javascript:void(0)" onclick="toggleDesc()" id="seeLessBtn" style="color: #1e90ff; font-weight: 400; text-decoration: none; display: inline-block; margin-top: 5px;">See Less</a>
                            </div>
                        @else
                            {!! $fullText !!}
                        @endif
                    </div>

                    <div class="image-specs shadow-sm">
                        <div class="info-row">
                            <span class="info-label">Asset ID</span>
                            <span class="info-value">{{ $product->asset_id ?? '' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Upload Date</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Release Info</span>
                            <span class="info-value">Signed model release on file securely.</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Categories</span>
                            <span class="info-value">
                                <a href="#" class="text-decoration-none">{{ $product->category->name ?? '' }}</a>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Copyright</span>
                            <span class="info-value text-muted fw-normal"><i class="fa fa-copyright"></i> ChobiDokan - Purchase to use</span>
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                @if (isset($uniqueTags) && count($uniqueTags) > 0)
                    <div class="mt-4">
                        <h6 class="text-uppercase text-muted font-weight-bold mb-3" style="font-size: 13px; letter-spacing: 0.5px;">Related Keywords</h6>
                        <div>
                            @foreach ($uniqueTags as $key => $tag)
                                <a href="{{ route('tag-wise-product', $tag) }}" class="tag-btn">{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <!-- Right Side: Pricing Options -->
            <div class="col-lg-4">
                <div class="sidebar-panel">
                    <form action="{{ $hasAccess ? route('product.video-download', ['id' => base64_encode($product->id)]) : route('checkout.page') }}" method="{{ $hasAccess ? 'GET' : 'POST' }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <!-- Dynamically updated price value -->
                        <input type="hidden" name="price" id="checkoutPrice" value="{{ $product->price ?? 0 }}">

                        @if(!$hasAccess)
                            <!-- Secondary Single Video Card (Hidden check logic) -->
                            <div class="shutter-plan-card" id="planStandard" onclick="selectPlan('planStandard')">
                                <div class="d-flex justify-content-between align-items-start">
                                    <label class="d-flex align-items-center mb-0" style="cursor:pointer;">
                                        <input type="radio" name="subscription_id" value="0" id="radioStandard" class="custom-shutter-radio" checked>
                                        <span class="shutter-plan-title">Single Video</span>
                                    </label>
                                    <div class="text-end">
                                        <div class="shutter-price">Tk {{ $product->price ?? '' }}</div>
                                    </div>
                                </div>
                                <div class="shutter-desc">
                                    Standard License for one-time digital or print use.
                                </div>
                            </div>

                            <!-- Main Subscription Dynamic Card -->
                            @if(isset($subscriptions) && $subscriptions->count() > 0)
                                @php
                                    $defaultSub = $subscriptions->first();
                                @endphp
                                <div class="shutter-plan-card selected" id="planSubscription" onclick="selectPlan('planSubscription')">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <label class="d-flex align-items-center mb-0" style="cursor:pointer;">
                                            <input type="radio" name="subscription_id" value="{{ $defaultSub->id }}" id="radioSubscription" class="custom-shutter-radio">
                                            <span class="shutter-plan-title" id="subTitleText">{{ $defaultSub->name }}</span>
                                        </label>
                                        <div class="text-end">
                                            <div class="shutter-price" id="subPricePerVideo">Tk {{ $defaultSub->price }}</div>
                                        </div>
                                    </div>

                                    <div class="shutter-desc mb-2" id="subCommitmentText">
                                        Tk <strong>{{ $defaultSub->price }}</strong> for {{ $defaultSub->days }} days
                                    </div>
                                    <div class="shutter-desc">
                                        Need multiple videos? Save with a video pack.
                                    </div>

                                    <!-- Dynamic Pack Selector -->
                                    <div class="shutter-pack-selector">
                                        @foreach($subscriptions as $index => $sub)
                                            <div class="shutter-pack-item {{ $index == 0 ? 'active' : '' }}"
                                                 onclick="event.stopPropagation(); changeSubscriptionPack(this, {{ $sub->id }}, '{{ $sub->name }}', {{ $sub->price }}, {{ $sub->total_image }}, {{ $sub->days }})">
                                                {{ $sub->total_image }} {{ $sub->total_image > 1 ? 'videos' : 'video' }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Add to Cart (If not purchased yet) -->
                        @if(!$hasAccess)
                            <div class="mb-3 text-center">
                                <a href="javascript:void(0)" onclick="submitCartForm();" class="text-decoration-none fw-semibold" style="color: #222; font-size: 14px;">
                                    <i class="fa fa-cart-plus me-1"></i> Add to Cart Instead
                                </a>
                            </div>
                        @else

                             <div class="alert alert-success text-center py-3 mb-3" style="font-size: 15px; font-weight: 600;">
                                        <i class="fa fa-check-circle me-1"></i> You have access to Download this image .
                              </div>

                        @endif

                        <!-- Main Download Button -->
                        <button type="submit" class="shutter-download-btn">
                            {{ $hasAccess ? 'Download Now' : 'Download' }}
                        </button>

                    </form>

                    @if(!$hasAccess)
                        <!-- See Pricing Plans link -->
                        <div class="shutter-more-plans">
                            <a href="{{ route('pricing-info') }}" class="btn btn-light shadow-sm fw-bold">See more pricing plans</a>
                        </div>
                    @endif

                    <!-- Business Card Footer -->
                    <a href="{{ route('signup') }}" class="text-decoration-none">
                    <div class="shutter-business-box">
                        <div>
                            <div class="biz-title">Are you a business?</div>
                            <div class="biz-sub">Make sure you have the right choice</div>
                        </div>
                        <i class="fa fa-chevron-right" style="font-size: 14px;"></i>
                    </div>
                    </a>

                    <!-- Hidden Add to cart form -->
                    @if(!$hasAccess)
                    <form action="{{ route('add.to.cart') }}" method="POST" id="addToCartForm" style="display:none;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                    </form>
                    @endif

                </div>
            </div>

        </div>
    </div>

    <!-- Similar Products Section -->
    @if(isset($similarProducts) && count($similarProducts) > 0)
    <section class="py-5" style="background:#fff; border-top: 1px solid #f1f2f6;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="font-weight-bold mb-0" style="color:#2d3436;">Similar Videos</h3>
                <a href="{{ route('category-wise-product', $product->category_id) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4 font-weight-bold">View all</a>
            </div>

            <div class="row">
                @foreach ($similarProducts as $key => $similarProduct)
                    @php
                        $isSimilarPayment = null;
                        $authUser = \Illuminate\Support\Facades\Auth::check() ? Auth::user() : null;
                        if ($authUser) {
                            $isSimilarPayment = \App\Models\Payment::where('product_id', $similarProduct->id)->where('user_id',$authUser->id)->first();
                        }
                    @endphp
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="gallery-item"
                             onmouseenter="const v=this.querySelector('video'); if(v) v.play();"
                             onmouseleave="const v=this.querySelector('video'); if(v){ v.pause(); v.currentTime=0; }">
                            <a href="{{ route('product-details', $similarProduct->id) }}">
                                <video class="w-100 h-100" style="object-fit:cover;" muted playsinline preload="metadata" controlsList="nodownload" oncontextmenu="return false;">
                                    <source src="{{ route('product.view.video', $similarProduct->id) }}" type="{{ $similarProduct->file_type }}">
                                </video>
                            </a>
                            <div class="watermark">CHOBIDOKAN</div>

                            <div class="overlay">
                                <div class="overlay-top">
                                    <div class="overlay-top-left">
                                        <h6>{{ $similarProduct->title ?? 'Beautiful Asset' }}</h6>
                                    </div>
                                    <div class="overlay-top-right">
                                        <!-- Wishlist -->
                                        @if(auth()->check())
                                            <form action="{{ route('wishlist.toggle', $similarProduct->id) }}" method="POST" class="wishlist-btn">
                                                @csrf
                                                <button type="submit" class="action-btn" title="Save">
                                                    <i class="fa {{ $similarProduct->wishlists->where('user_id', auth()->id())->count() ? 'fa-heart text-danger' : 'fa-heart-o' }}"></i>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('signin') }}" class="action-btn">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        @endif

                                        <!-- Cart -->
                                        @if(!$isSimilarPayment)
                                            @if(auth()->check())
                                                <form action="{{ route('add.to.cart') }}" method="POST" class="cart-btn-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $similarProduct->id }}">
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
                                    <div class="overlay-bottom-left">
                                        <a href="{{ route('category-wise-product', $similarProduct->category_id) }}" class="action-btn" title="Find Similar">
                                            <i class="fa fa-clone"></i>
                                        </a>

                                        <a href="{{ route('product-details', $similarProduct->id) }}" class="action-btn" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>

                                    <div class="overlay-bottom-right">
                                        <div class="share-wrapper action-btn">
                                            <i class="fa fa-share-alt share-btn" title="Share"></i>
                                            <div class="share-dropdown">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product-details', $similarProduct->id)) }}" target="_blank">
                                                    <i class="fa fa-facebook"></i> Facebook
                                                </a>
                                                <a href="https://api.whatsapp.com/send?text={{ urlencode(route('product-details', $similarProduct->id)) }}" target="_blank">
                                                    <i class="fa fa-whatsapp"></i> WhatsApp
                                                </a>
                                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('product-details', $similarProduct->id)) }}&text={{ urlencode($similarProduct->title) }}" target="_blank">
                                                    <i class="fa fa-twitter"></i> Twitter
                                                </a>
                                                <a href="javascript:void(0)" onclick="copyToClipboard('{{ route('product-details', $similarProduct->id) }}')">
                                                    <i class="fa fa-link"></i> Copy Link
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Download / Buy -->
                                        @if($isSimilarPayment)
                                            <a href="{{ route('product.video-download', ['id' => base64_encode($similarProduct->id)]) }}" class="action-btn" title="Download">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        @else
                                            <form action="{{ route('product.purchase') }}" method="POST" class="cart-btn-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $similarProduct->id }}">
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
    </section>
    @endif

    <!-- Fullscreen Custom popup -->
    <div id="imagePopup" class="image-popup mb-0 p-0">
        <span class="popup-close" onclick="closeImageModal()"><i class="fa fa-times"></i></span>

        <div class="popup-content-wrapper">
            <div class="popup-image-container">
                <video src="{{ route('product.view.video', $product->id) }}" class="popup-image" id="popupImgEl" controls controlsList="nodownload" oncontextmenu="return false;" autoplay playsinline loop></video>
                <!-- Keep same watermark pattern for popup -->
                <div class="watermark-overlay" style="opacity: 0.9; pointer-events: none;"></div>
            </div>

            <div class="popup-footer">
                <div class="brand">chobidokan</div>
                <div class="image-id">
                    VIDEO ID: {{  $product->asset_id ?? ''}}<br>
                    <span>www.chobidokan.com</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fullscreen Image Modal
        function openImageModal() {
            document.getElementById('imagePopup').style.display = "flex";
            document.body.style.overflow = "hidden"; // prevent background scrolling
        }

        function closeImageModal() {
            document.getElementById('imagePopup').style.display = "none";
            document.body.style.overflow = "auto";
            let v = document.getElementById('popupImgEl');
            if(v) v.pause();
        }

        // Close when clicking outside image
        document.getElementById('imagePopup').addEventListener('click', function(e) {
            if (e.target === this) closeImageModal();
        });

        let singleImagePrice = {{ $product->price ?? 0 }};
        let currentSubPrice = {{ isset($defaultSub) ? $defaultSub->price : 0 }};

        // Plan selector logic
        function selectPlan(planId) {
            document.querySelectorAll('.shutter-plan-card').forEach(el => el.classList.remove('selected'));
            const selectedDiv = document.getElementById(planId);
            if(selectedDiv) {
                selectedDiv.classList.add('selected');
                selectedDiv.querySelector('input[type="radio"]').checked = true;
            }

            // Update Price Input
            if(planId === 'planStandard') {
                document.getElementById('checkoutPrice').value = singleImagePrice;
            } else if(planId === 'planSubscription') {
                document.getElementById('checkoutPrice').value = currentSubPrice;
            }
        }

        // Handle dynamic pack changing
        function changeSubscriptionPack(element, id, name, price, totalImage, days) {
            currentSubPrice = price; // store current selected sub price

            // Update active pill styling
            document.querySelectorAll('.shutter-pack-item').forEach(el => el.classList.remove('active'));
            element.classList.add('active');

            // Re-calculate the math per image cost for beautiful UI
            let pricePerImage = price;

            // Update UI elements dynamically
            document.getElementById('subTitleText').innerText = name;
            document.getElementById('subPricePerVideo').innerText = 'Tk ' + pricePerImage;
            document.getElementById('subCommitmentText').innerHTML = 'Tk <strong>' + price + '</strong> for ' + days + ' days';

            // Update Form input for the request payload
            let radio = document.getElementById('radioSubscription');
            if(radio) {
                radio.value = id;
            }

            // Update checkout price immediately since we interacted with it
            document.getElementById('checkoutPrice').value = currentSubPrice;

            // Ensure the parent plan remains selected if user clicks inner items
            selectPlan('planSubscription');
        }

        // Handle Cart Submission with Price and Plan data
        function submitCartForm() {
            let form = document.getElementById('addToCartForm');
            let planOption = document.querySelector('input[name="subscription_id"]:checked').value;
            let price = document.getElementById('checkoutPrice').value;

            // Append Price
            let priceInput = document.createElement('input');
            priceInput.type = 'hidden';
            priceInput.name = 'price';
            priceInput.value = price;
            form.appendChild(priceInput);

            // Append Subscription ID
            let subInput = document.createElement('input');
            subInput.type = 'hidden';
            subInput.name = 'subscription_id';
            subInput.value = planOption;
            form.appendChild(subInput);

            form.submit();
        }

        // Description Toggle Logic
        function toggleDesc() {
            var shortDesc = document.getElementById("descShort");
            var fullDesc = document.getElementById("descFull");

            if (shortDesc.style.display === "none") {
                shortDesc.style.display = "block";
                fullDesc.style.display = "none";
            } else {
                shortDesc.style.display = "none";
                fullDesc.style.display = "block";
            }
        }

        // Custom Share Dropdown Logic
        function toggleShare(event) {
            event.stopPropagation(); // Prevent document click from immediately firing
            let dropdown = document.getElementById('shareDropdownList');
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex';
            }
        }

        // Hide dropdown on out-click
        document.addEventListener('click', function(event) {
            let dropdown = document.getElementById('shareDropdownList');
            if (dropdown && dropdown.style.display === 'flex') {
                let wrapper = document.querySelector('.share-wrapper');
                if (wrapper && !wrapper.contains(event.target)) {
                    dropdown.style.display = 'none';
                }
            }
        });

        // Copy to Clipboard integration
        function copyToClipboard(text) {
            // Check if modern navigator clipboard is available
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(function() {
                    alert('Link successfully copied to clipboard!');
                }).catch(function() {
                    fallbackCopyTextToClipboard(text);
                });
            } else {
                fallbackCopyTextToClipboard(text);
            }
        }

        // Fallback for older browsers or non-HTTPS connections
        function fallbackCopyTextToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
                alert('Link successfully copied to clipboard!');
            } catch (err) {
                alert('Failed to copy link. Please copy it manually.');
            }
            document.body.removeChild(textArea);
        }

        // Dynamic Video Metadata Extraction
        document.addEventListener('DOMContentLoaded', function() {
            let vid = document.getElementById('productVideo');
            if(vid) {
                vid.addEventListener('loadedmetadata', function() {
                    let w = this.videoWidth;
                    let h = this.videoHeight;
                    let d = this.duration;

                    // Format Dimensions & Quality
                    let quality = 'SD';
                    if (w >= 3800) quality = '4K';
                    else if (w >= 1900) quality = 'Full HD';
                    else if (w >= 1200) quality = 'HD';

                    let extMatch = this.querySelector('source').src.match(/\.([a-zA-Z0-9]+)$/);
                    let ext = extMatch ? extMatch[1].toUpperCase() : 'MP4';

                    let resBadge = document.getElementById('dynamicResBadge');
                    if(resBadge) resBadge.innerText = quality + ' • ' + w + 'x' + h + ' • ' + ext;

                    // Format Duration
                    let minutes = Math.floor(d / 60);
                    let seconds = Math.floor(d % 60);
                    let formattedDur = (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

                    let durBadge = document.getElementById('dynamicDurBadge');
                    if(durBadge) durBadge.innerText = 'Duration: ' + formattedDur;
                });
            }
        });
    </script>
@endsection
