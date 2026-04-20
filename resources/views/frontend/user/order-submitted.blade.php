@extends('layouts.user_panel')
@section('panel_content')
    <style>
        .form-section {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 1.8rem;
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

    <div class="container">
        <div class="row">

            <div class="form-section">

                @if(count($orderSubmittedFiles) > 0 )
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{$orderSubmittedFiles[0]->project?->name}} (Original Image)</h4>
                    </div>

                    @if($orderSubmittedFiles[0]->project?->status == 1)

                    <div class="approve-reject-btns">
                        <button class="btn btn-sm btn-success btn-lg" data-bs-toggle="modal"
                                data-bs-target="#approveModal">Approve</button>
{{--                        <button class="btn btn-sm btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>--}}
                    </div>
                    @endif
                </div>
                @endif
                <div class="card-body">
                    <div class="row g-3">
                        @if(count($orderSubmittedFiles) > 0 )
                            @foreach($orderSubmittedFiles as $key=>$orderSubmittedFile)

                                @php
                                    $file_type = $orderSubmittedFile->file_type;
                                @endphp
                                <div class="col-md-4">
                                    <div class="card h-100 border shadow-sm rounded-4 hover-card overflow-hidden">
                                        <!-- Image + Overlay -->
                                        <div class="position-relative">
                                            <div class="card-body d-flex justify-content-center align-items-center bg-light"
                                                 style="height: 200px; overflow: hidden;">

                                                @if(Str::startsWith($orderSubmittedFile->file_type, 'image'))
                                                    {{-- Show Image --}}
                                                    <img src="{{ asset($orderSubmittedFile->file_path) }}"
                                                         alt="Request Image"
                                                         class="img-fluid rounded-3"
                                                         style="max-height: 180px; object-fit: cover;">
                                                @elseif($orderSubmittedFile->file_type === 'application/zip')
                                                    {{-- Show ZIP Placeholder --}}
                                                    <img src="{{ asset('uploads/project/approved-file/zip-icon.png') }}"
                                                         alt="Zip File"
                                                         class="img-fluid rounded-3"
                                                         style="max-height: 120px; object-fit: contain;">
                                                @else
                                                    {{-- Default Placeholder --}}
                                                    <img src="{{ asset('images/file-placeholder.png') }}"
                                                         alt="File"
                                                         class="img-fluid rounded-3"
                                                         style="max-height: 120px; object-fit: contain;">
                                                @endif

                                            </div>

                                            {{-- Modal Button only for Images --}}
                                            @if(Str::startsWith($orderSubmittedFile->file_type, 'image'))
                                                <button class="btn btn-light rounded-circle shadow position-absolute top-50 start-50 translate-middle"
                                                        style="color: #0d6efd; font-size: 1.5rem; z-index: 20;"
                                                        onclick="openCustomImageModal('{{ asset($orderSubmittedFile->file_path) }}', '{{ addslashes($orderSubmittedFile->project?->name) }}')">
                                                    <i class="bi bi-arrows-fullscreen"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <a href="{{ asset($orderSubmittedFile->file_path) }}"
                                           download
                                           class="btn btn-success text-center">Download</a>
                                    </div>
                                </div>


                            @endforeach

                                <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                    {{ $orderSubmittedFiles->withQueryString()->links('pagination.custom') }}
                                </div>
                        @else
                            <div class="col-12 text-center py-4">
                                <p class="mb-0 text-danger"> No original file submitted yet!</p>
                            </div>
                        @endif
                    </div>
                </div>


            </div>

                <!-- Approve Modal -->
                @if(count($orderSubmittedFiles) > 0 )
                <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('user.order.project.approve', $orderSubmittedFiles[0]->project_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content" style="width: 180%">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="approveModalLabel">Confirm Approval</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif


                <!-- Reject Modal -->

{{--                <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">--}}
{{--                    <div class="modal-dialog">--}}
{{--                        <form action="{{ route('user.order.submission.reject', $orderSubmittedFiles[0]->project_id) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            @method('PUT')--}}
{{--                            <div class="modal-content" style="width: 180%">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <h5 class="modal-title" id="rejectModalLabel">Confirm Rejection </h5>--}}
{{--                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>--}}
{{--                                </div>--}}
{{--                                <div class="modal-body">--}}
{{--                                    <label for="reason" class="form-label required">Reason for rejection (<small>Mandatory</small>)</label>--}}
{{--                                    <textarea name="comment" id="reason" class="form-control" rows="6" required></textarea>--}}
{{--                                </div>--}}
{{--                                <div class="modal-footer">--}}
{{--                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                                    <button type="submit" class="btn btn-danger">Reject</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}



        </div>
    </div>
    </div>
    </div>

@endsection

    <!-- Fullscreen Custom popup matching imageDetails zoom -->
    <div id="customImagePopup" class="image-popup p-0 m-0">
        <span class="popup-close" onclick="closeCustomImageModal()"><i class="fa fa-times"></i></span>

        <div class="popup-content-wrapper">
            <div class="popup-image-container">
                <img id="popupImageElement" src="" alt="Preview" class="popup-image" oncontextmenu="return false" draggable="false">
                <!-- No watermark here as requested -->
            </div>

            <div class="popup-footer">
                <div class="brand">chobidokan</div>
                <div class="image-id">
                    <span id="popupSubmitterName" style="color: #ffffff; font-weight: bold;"></span><br>
                    <span style="color: #9ba0a9; font-weight: normal;">www.chobidokan.com</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openCustomImageModal(imageSrc, submitterName) {
            document.getElementById('popupImageElement').src = imageSrc;
            document.getElementById('popupSubmitterName').innerText = submitterName ? 'Project: ' + submitterName : '';
            
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

