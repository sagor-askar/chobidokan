@extends('includes.master')

@section('content')
    <!-- FontAwesome 6 for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        .profile-img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #007bff;
            margin-bottom: 15px;
        }

        .left-section {
            border-right: 1px solid #dee2e6;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        .social-links a {
            margin: 0 8px;
            font-size: 18px;
            color: #495057;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: #007bff;
        }

        .card-counter {
            position: relative;
            padding: 20px;
            border-radius: 12px;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform .2s ease-in-out;
        }

        .card-counter:hover {
            transform: translateY(-5px);
        }

        .card-counter i {
            font-size: 2.2rem;
            opacity: 0.35;
        }

        .count-numbers {
            font-size: 26px;
            font-weight: bold;
            margin-left: 10px;
        }

        .count-name {
            font-size: 13px;
            opacity: 0.85;
            margin-left: 10px;
        }

        /* Repeating Watermark Pattern over image */
        .watermark-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 10;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="350" height="250"><g transform="translate(175, 125) rotate(-25) translate(-175, -125)"><text x="175" y="125" font-size="30" font-family="Arial, sans-serif" font-weight="600" fill="rgba(255,255,255,0.7)" text-anchor="middle" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.5);">CHOBIDOKAN</text></g></svg>');
            background-repeat: repeat;
        }

        /* Pure Image Card Grid Styling matching category-product layout */
        .media-card {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            background: #212529;
            cursor: pointer;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .media-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.2);
        }

        .media-thumb-container {
            position: relative;
            height: 220px;
            width: 100%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1a1a1a;
        }

        .media-thumb-container img, 
        .media-thumb-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .media-card:hover img,
        .media-card:hover video {
            transform: scale(1.05);
            filter: brightness(0.92);
        }

        /* Zoom Overlay Icon */
        .zoom-overlay-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 20;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.95);
            color: #0d6efd;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            box-shadow: 0 4px 18px rgba(0,0,0,0.35);
            cursor: pointer;
            transition: all 0.25s ease;
            opacity: 0.85;
        }

        .media-card:hover .zoom-overlay-btn {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.12);
            background: #ffffff;
        }

        /* Custom Tabs Styling */
        .custom-designer-tabs .nav-link {
            color: #495057;
            font-size: 15px;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 12px 24px;
            background: transparent;
            transition: all 0.25s ease;
        }

        .custom-designer-tabs .nav-link:hover {
            color: #0d6efd;
            border-bottom-color: #cbdcf7;
        }

        .custom-designer-tabs .nav-link.active {
            color: #0d6efd;
            background: transparent;
            border-bottom: 3px solid #0d6efd;
        }

        /* Fullscreen Large Modal Preview Popup */
        .image-popup {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(0, 0, 0, 0.94);
            justify-content: center;
            align-items: center;
        }

        .popup-content-wrapper {
            display: flex;
            flex-direction: column;
            width: 95vw;
            height: 92vh;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.8);
            background: #111;
        }

        .popup-image-container {
            position: relative;
            background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAOElEQVQYV2N89erVfwY0ICYmxhhgxKphGAWjYEwB5y5dumSEcRmN7u7uRjTNKF4YZoGwi+DqkAIA1z8kR+H/TngAAAAASUVORK5CYII=') repeat, #111111;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            width: 100%;
            height: 100%;
            padding: 10px;
        }

        .popup-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .popup-footer {
            background: #1c1e22;
            padding: 14px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #333;
        }

        .popup-footer .brand {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .popup-close {
            position: absolute;
            top: 18px;
            right: 25px;
            font-size: 36px;
            color: #fff;
            cursor: pointer;
            transition: color 0.2s;
            z-index: 10000;
            line-height: 1;
        }

        .popup-close:hover {
            color: #ff3b3f;
        }
    </style>

    <section class="py-5" style="margin-top: 3rem;">
        <div class="container">
            <div class="row">
                <!-- Left Panel -->
                <div class="col-md-3 text-center left-section mb-4 mb-md-0">
                    <img src="{{ asset($user->image ?? 'frontend_assets/img/team/team-1.jpg') }}" class="profile-img" alt="User Image"/>
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted small mb-3">{!! strip_tags($user->bio ?? 'Designer Profile') !!}</p>

                    <div class="social-links">
                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="col-md-9">
                    <!-- Statistics Section -->
                    <div class="card shadow-sm mb-4 border-0 rounded-3">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-chart-line text-primary me-2"></i>Statistics</h5>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row text-center">
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="card-counter bg-primary">
                                        <i class="fas fa-briefcase"></i>
                                        <div class="count-numbers">{{ $totalProject }}</div>
                                        <div class="count-name">Jobs</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="card-counter bg-info">
                                        <i class="fas fa-folder-open"></i>
                                        <div class="count-numbers">{{ $totalSubmit }}</div>
                                        <div class="count-name">Custom Submissions</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="card-counter bg-success">
                                        <i class="fas fa-image"></i>
                                        <div class="count-numbers">{{ $totalImages }}</div>
                                        <div class="count-name">Stock Images</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="card-counter bg-danger">
                                        <i class="fas fa-video"></i>
                                        <div class="count-numbers">{{ $totalVideos }}</div>
                                        <div class="count-name">Stock Videos</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabbed Products Section -->
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-header bg-white border-bottom-0 pb-0">
                            <ul class="nav nav-tabs custom-designer-tabs border-bottom" id="designerProfileTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-bold" id="images-tab" data-bs-toggle="tab" data-bs-target="#images-tab-pane" type="button" role="tab" aria-controls="images-tab-pane" aria-selected="true">
                                        <i class="fas fa-image me-2 text-primary"></i> Images ({{ $totalImages }})
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-bold" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos-tab-pane" type="button" role="tab" aria-controls="videos-tab-pane" aria-selected="false">
                                        <i class="fas fa-video me-2 text-danger"></i> Videos ({{ $totalVideos }})
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-bold" id="submissions-tab" data-bs-toggle="tab" data-bs-target="#submissions-tab-pane" type="button" role="tab" aria-controls="submissions-tab-pane" aria-selected="false">
                                        <i class="fas fa-tasks me-2 text-info"></i> Custom Submissions ({{ $totalSubmit }})
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body pt-4">
                            <div class="tab-content" id="designerProfileTabContent">
                                
                                <!-- Tab 1: Images -->
                                <div class="tab-pane fade show active" id="images-tab-pane" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="row g-3">
                                        @forelse($imageProducts as $product)
                                            @php
                                                $imgSrc = route('product.file.view', $product->id);
                                            @endphp
                                            <div class="col-6 col-sm-4 col-md-3 mb-3">
                                                <div class="media-card border shadow-sm" onclick="openMediaModal('{{ $imgSrc }}', '{{ addslashes($product->title ?? 'Product Image') }}', 'image')">
                                                    <div class="media-thumb-container">
                                                        <div class="watermark-overlay"></div>
                                                        <img src="{{ $imgSrc }}" alt="{{ $product->file_name ?? 'Image' }}" oncontextmenu="return false" draggable="false" onerror="this.onerror=null;this.src='{{ asset($product->file_path) }}';"/>
                                                        <button class="zoom-overlay-btn" title="Zoom Preview" onclick="event.stopPropagation(); openMediaModal('{{ $imgSrc }}', '{{ addslashes($product->title ?? 'Product Image') }}', 'image')">
                                                            <i class="fas fa-search-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-5">
                                                <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                                <p class="text-muted mb-0">No stock image products available for this designer.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                    @if($imageProducts->hasPages())
                                        <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                            {{ $imageProducts->withQueryString()->links('pagination.custom') }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Tab 2: Videos -->
                                <div class="tab-pane fade" id="videos-tab-pane" role="tabpanel" aria-labelledby="videos-tab">
                                    <div class="row g-3">
                                        @forelse($videoProducts as $product)
                                            @php
                                                $videoSrc = route('product.view.video', $product->id);
                                            @endphp
                                            <div class="col-6 col-sm-4 col-md-3 mb-3">
                                                <div class="media-card border shadow-sm" onclick="openMediaModal('{{ $videoSrc }}', '{{ addslashes($product->title ?? 'Product Video') }}', 'video')">
                                                    <div class="media-thumb-container">
                                                        <div class="watermark-overlay"></div>
                                                        <video muted playsinline preload="metadata" controlsList="nodownload" disablePictureInPicture oncontextmenu="return false;">
                                                            <source src="{{ $videoSrc }}" type="{{ $product->file_type }}">
                                                            <source src="{{ asset($product->file_path) }}">
                                                        </video>
                                                        <span class="badge bg-dark position-absolute top-0 end-0 m-2 px-2 py-1" style="z-index: 15;"><i class="fas fa-play me-1"></i></span>
                                                        <button class="zoom-overlay-btn" title="Preview Video" onclick="event.stopPropagation(); openMediaModal('{{ $videoSrc }}', '{{ addslashes($product->title ?? 'Product Video') }}', 'video')">
                                                            <i class="fas fa-expand"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-5">
                                                <i class="fas fa-video fa-3x text-muted mb-3"></i>
                                                <p class="text-muted mb-0">No stock video products available for this designer.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                    @if($videoProducts->hasPages())
                                        <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                            {{ $videoProducts->withQueryString()->links('pagination.custom') }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Tab 3: Custom Submissions -->
                                <div class="tab-pane fade" id="submissions-tab-pane" role="tabpanel" aria-labelledby="submissions-tab">
                                    <div class="row g-3">
                                        @forelse($uploads as $upload)
                                            @php
                                                $uploadSrc = asset($upload->file_path);
                                            @endphp
                                            <div class="col-6 col-sm-4 col-md-3 mb-3">
                                                <div class="media-card border shadow-sm" onclick="openMediaModal('{{ $uploadSrc }}', '{{ addslashes($upload->project?->name ?? 'Custom Submission') }}', 'image')">
                                                    <div class="media-thumb-container">
                                                        <div class="watermark-overlay"></div>
                                                        <img src="{{ $uploadSrc }}" alt="Custom Submission" oncontextmenu="return false" draggable="false"/>
                                                        <button class="zoom-overlay-btn" title="Zoom Preview" onclick="event.stopPropagation(); openMediaModal('{{ $uploadSrc }}', '{{ addslashes($upload->project?->name ?? 'Custom Submission') }}', 'image')">
                                                            <i class="fas fa-search-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-5">
                                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                                <p class="text-muted mb-0">No custom project submissions available.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                    @if($uploads->hasPages())
                                        <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                            {{ $uploads->withQueryString()->links('pagination.custom') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dynamic Large Media Preview Modal -->
    <div id="mediaZoomModal" class="image-popup p-0 m-0">
        <span class="popup-close" onclick="closeMediaModal()"><i class="fas fa-times"></i></span>
        <div class="popup-content-wrapper">
            <div class="popup-image-container position-relative">
                <img id="modalImageElement" src="" alt="Preview" class="popup-image" oncontextmenu="return false" draggable="false" style="display: none;"/>
                <video id="modalVideoElement" src="" controls controlsList="nodownload" disablePictureInPicture oncontextmenu="return false;" class="popup-image" style="display: none; max-height: 100%; width: 100%;"></video>
                <div class="watermark-overlay"></div>
            </div>
            <div class="popup-footer">
                <div class="brand">chobidokan</div>
                <div class="image-id text-end">
                    <span id="modalMediaTitle" style="color: #ffffff; font-weight: bold; font-size: 15px;"></span><br>
                    <span style="color: #9ba0a9; font-weight: normal;">www.chobidokan.com</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openMediaModal(mediaSrc, title, type) {
            const imgEl = document.getElementById('modalImageElement');
            const videoEl = document.getElementById('modalVideoElement');
            const titleEl = document.getElementById('modalMediaTitle');
            const popup = document.getElementById('mediaZoomModal');

            titleEl.innerText = title;

            if (type === 'video') {
                imgEl.style.display = 'none';
                imgEl.src = '';
                videoEl.src = mediaSrc;
                videoEl.style.display = 'block';
            } else {
                if (videoEl) {
                    videoEl.pause();
                    videoEl.style.display = 'none';
                    videoEl.src = '';
                }
                imgEl.src = mediaSrc;
                imgEl.style.display = 'block';
            }

            popup.style.display = "flex";
            document.body.style.overflow = "hidden";
        }

        function closeMediaModal() {
            const popup = document.getElementById('mediaZoomModal');
            const videoEl = document.getElementById('modalVideoElement');
            if (videoEl) {
                videoEl.pause();
            }
            popup.style.display = "none";
            document.body.style.overflow = "auto";
        }

        // Close when clicking background outside container
        document.getElementById('mediaZoomModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeMediaModal();
            }
        });

        // Auto activate active tab when paginating
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('videos_page')) {
                const videoTabBtn = document.getElementById('videos-tab');
                if (videoTabBtn && window.bootstrap) {
                    new bootstrap.Tab(videoTabBtn).show();
                }
            } else if (urlParams.has('uploads_page')) {
                const uploadTabBtn = document.getElementById('submissions-tab');
                if (uploadTabBtn && window.bootstrap) {
                    new bootstrap.Tab(uploadTabBtn).show();
                }
            }
        });
    </script>
@endsection
