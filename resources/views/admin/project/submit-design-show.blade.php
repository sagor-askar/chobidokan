@extends('layouts.admin')
@section('content')
    <style>
        .card {
            border: 2px solid #e0e0e0; /* subtle light border */
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            height: 250px; /* fixed height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.2);
            border-color: #0d6efd; /* highlight border on hover */
        }

        .card-img-top {
            height: 180px; /* fixed image height */
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .card-title {
            font-weight: 600;
            font-size: 16px;
            color: #343a40;
        }

        .project-header {
            background-color: #f8f9fa;
            padding: 20px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .project-header h3 {
            font-size: 22px;
            font-weight: 700;
            color: #343a40;
            margin: 0;
        }

        .project-title {
            color: #0d6efd;
        }

        /* Center Overlay Icon */
        .card-eye {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #f8f9fa;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: background 0.3s, transform 0.3s;
            z-index: 2;
        }
        .card-eye:hover {
            background: #fff;
            transform: translate(-50%, -50%) scale(1.1);
        }
        .card-eye i {
            color: #0d6efd;
            font-size: 20px;
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
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Designer List</div>
                    <div class="panel-body">

                        <div class="card-header text-center project-header">
                            <h3>
                                Project: <span class="project-title">
                                {{ @$designerSubmitfiles[0]->project?->name ?? 'N/A' }}
                            </span>
                            </h3>
                        </div>
                        <br>

                        <div class="row">
                            @foreach($designerSubmitfiles as $designerSubmitfile)
                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-sm">
                                        @if($designerSubmitfile->file_path)
                                            <img src="{{ asset($designerSubmitfile->file_path) }}"
                                                 alt="Image"
                                                 class="card-img-top"
                                                 oncontextmenu="return false" draggable="false">


                                            <!-- Fullscreen Center Icon -->
                                            <div class="card-eye"
                                                 onclick="openCustomImageModal('{{ asset($designerSubmitfile->file_path) }}', '{{ addslashes($designerSubmitfile->projectSubmit?->designer?->name ?? 'Designer') }}')">
                                                <i class="fas fa-expand-arrows-alt"></i>
                                            </div>
                                        @else
                                            <div class="card-body text-center">
                                                <span class="badge bg-danger">No Logo Attached!</span>
                                            </div>
                                        @endif

                                        <div class="card-body text-center">
                                            @if($designerSubmitfile->status == 1)
                                                <div class="text-start">
                                                    <span class="badge badge-success" style="background-color: green">Selected</span>
                                                </div>
                                            @endif
                                            <h6 class="card-title mb-1">
                                                {{ $designerSubmitfile->projectSubmit?->designer?->name }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                <!-- No watermark here -->
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
