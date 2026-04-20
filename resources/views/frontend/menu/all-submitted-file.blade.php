@extends('includes.master')
@section('content')
    <!-- Custom CSS for Hover -->
    <style>
        .hover-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        /* Repeating Watermark Pattern over image - higher visibility */
        .watermark-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 10;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="350" height="250"><g transform="translate(175, 125) rotate(-25) translate(-175, -125)"><text x="175" y="125" font-size="30" font-family="Arial, sans-serif" font-weight="600" fill="rgba(255,255,255,0.7)" text-anchor="middle" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.5);">CHOBIDOKAN</text></g></svg>');
            background-repeat: repeat;
        }

        /* Custom Popup matching ImageDetails zoom exactly */
        .image-popup {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(0,0,0,0.88);
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
            background: #ffffff; /* transparent PNG fix */
        }
        .popup-image-container {
            position: relative;
            background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAOElEQVQYV2N89erVfwY0ICYmxhhgxKphGAWjYEwB5y5dumSEcRmN7u7uRjTNKF4YZoGwi+DqkAIA1z8kR+H/TngAAAAASUVORK5CYII='), #ffffff;
            background-repeat: repeat;
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
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 Bundle JS (Popper সহ) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <div class="section">
        <div class="container" style="margin-top: 5rem;">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card shadow-sm border-0 rounded-3">
                        <!-- Header -->
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="bi bi-archive me-2"></i> Submitted Files
                            </h5>
                        </div>

                    <!-- Body -->
                    <!-- Card Section -->
                    <div class="card-body mt-2">
                        <div class="row g-3">
                            @if(count($allSubmittedFiles) > 0 )
                                @foreach($allSubmittedFiles as $key=>$uploadData)
                                    <div class="col-md-3">
                                        <div class="card h-100 border shadow-sm rounded-4 hover-card overflow-hidden">

                                            <!-- Image + Overlay -->
                                            <div class="position-relative">
                                                <!-- Watermark Overlay added here -->
                                                <div class="watermark-overlay" style="border-radius: 0.5rem;"></div>

                                                <div class="card-body p-2 d-flex justify-content-center align-items-center bg-light"
                                                     style="height: 200px; overflow: hidden; position: relative;">
                                                    <img src="{{ asset($uploadData->file_path) }}"
                                                         alt="Request Image"
                                                         class="img-fluid rounded-3"
                                                         style="max-height: 180px; object-fit: cover;" oncontextmenu="return false" draggable="false">
                                                </div>

                                                <!-- Center Overlay Icon -->
                                                <button class="btn btn-light rounded-circle shadow position-absolute top-50 start-50 translate-middle"
                                                        style="color: #0d6efd; font-size: 1.5rem; z-index: 20;"
                                                        onclick="openCustomImageModal('{{ asset($uploadData->file_path) }}', '{{ addslashes($uploadData->projectSubmit?->designer?->name) }}')">
                                                    <i class="bi bi-arrows-fullscreen"></i>
                                                </button>
                                            </div>

                                            <!-- Footer -->
                                            <div class="card-footer bg-white border-top text-center small">
                                                <div class="fw-semibold mb-1">
                                                    <a href="{{ route('designer-profile',$uploadData->projectSubmit?->designer?->id) }}"
                                                       class="text-decoration-none text-primary">
                                                        {{ $uploadData->projectSubmit?->designer?->name }}
                                                    </a>
                                                </div>
                                                <div class="text-muted mb-2">
                                                    📅 {{ \Carbon\Carbon::parse($uploadData->projectSubmit?->submit_date)->format('d M, Y') }}
                                                </div>

                                                <!-- Confirm Button -->

                                                @if(\Illuminate\Support\Facades\Auth::user()->role_id == 3)
                                                <a href="{{ route('project.submitted-file.confirm',$uploadData->id) }}" class="btn btn-success btn-sm w-100 rounded-pill shadow-sm" onclick="return confirm('Are you sure to confirm !');">
                                                    <i class="bi bi-check-circle me-1"></i> Confirm
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>



                                @endforeach

                                    <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                        {{ $allSubmittedFiles->withQueryString()->links('pagination.custom') }}
                                    </div>
                            @else
                                <div class="col-12 text-center py-4">
                                    <p class="mb-0 text-danger">No submissions available yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Fullscreen Custom popup matching imageDetails zoom -->
    <div id="customImagePopup" class="image-popup p-0 m-0">
        <span class="popup-close" onclick="closeCustomImageModal()"><i class="fa fa-times"></i></span>

        <div class="popup-content-wrapper">
            <div class="popup-image-container">
                <img id="popupImageElement" src="" alt="Preview" class="popup-image" oncontextmenu="return false" draggable="false">
                <div class="watermark-overlay"></div>
            </div>

            <div class="popup-footer">
                <div class="brand">chobidokan</div>
                <div class="image-id">
                    Submitted by: <span id="popupSubmitterName" style="color: #ffffff; font-weight: bold;"></span><br>
                    <span style="color: #9ba0a9; font-weight: normal;">www.chobidokan.com</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openCustomImageModal(imageSrc, submitterName) {
            document.getElementById('popupImageElement').src = imageSrc;
            document.getElementById('popupSubmitterName').innerText = submitterName;
            
            let popup = document.getElementById('customImagePopup');
            popup.style.display = "flex";
            document.body.style.overflow = "hidden"; // prevent background scrolling
        }

        function closeCustomImageModal() {
            let popup = document.getElementById('customImagePopup');
            popup.style.display = "none";
            document.body.style.overflow = "auto";
        }

        // Close when clicking outside content
        document.getElementById('customImagePopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCustomImageModal();
            }
        });
    </script>
@endsection
