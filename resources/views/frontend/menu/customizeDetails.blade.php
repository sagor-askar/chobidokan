@extends('includes.master')
@section('content')
    <!-- Custom CSS for Hover -->
    <style>
        .hover-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <div class="section">
        <div class="container" style="margin-top: 5rem;">
            <!-- Stack the columns on mobile by making one full-width and the other half-width -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Title </strong> : {{ $project?->name }}</h5>
                            <h6 class="card-title"> <strong>Category</strong> : {{ $project?->category->name }}</h6>
                            <p class="card-text">{!! $project->project_description !!}</p>

                            <h6 class="card-title"> <strong>Attachment</strong> : <a target="_blank"
                                    href="{{ asset($project->project_file) }}" class=" btn btn-sm btn-success text-center">
                                    <i class="bi bi-file-earmark-fill"></i>Download</a></h6>
                            <p class="card-text">
                                <small class="text-muted"> <strong>Posted On:</strong> :
                                    {{ \Carbon\Carbon::parse($project->publish_date)->format('d-M-Y') }}</small>
                                <br>
                                <small class="text-muted"> <strong>Expire Date:</strong> :
                                    {{ \Carbon\Carbon::parse($project->expire_date)->format('d-M-Y') }}</small>
                            </p>
                        </div>
                    </div>
                    @php
                        $subscriptions = json_decode($project->subscription?->points);
                        $subscriptionDesigner = $project->subscription->designer;
                        $subscriptionDesign = $project->subscription->design;

                        $expireDate = \Carbon\Carbon::parse($project->expire_date)->startOfDay();
                        $today = \Carbon\Carbon::now()->startOfDay();
                        $daysLeft = $today->gt($expireDate) ? 'Expired' : $today->diffInDays($expireDate);

                        $expireSubmitDate = \Carbon\Carbon::parse($project->expire_date);
                        $currentDate = \Carbon\Carbon::now();
                        $isParticipatingDesigner = false;
                        $userUploadsCount = 0;
                        $maxPerDesigner = 0;

                        $authUser = \Illuminate\Support\Facades\Auth::user();

                        if ($authUser) {
                            $isParticipatingDesigner = $project->projectSubmit->contains('designer_id', $authUser->id);

                            if ($subscriptionDesigner > 0) {
                                $maxPerDesigner = floor($subscriptionDesign / $subscriptionDesigner);
                                $userUploadsCount = \App\Models\Upload::whereHas('projectSubmit', function($q) use ($project, $authUser) {
                                    $q->where('project_id', $project->id)
                                      ->where('designer_id', $authUser->id);
                                })->count();
                            }
                        }
                    @endphp

                    <div class="card">
                        <div class="card-body">
                            <h5>Statistics</h5>
                            <hr />
                            <div class="d-flex flex-column gap-1">
                                <span>Budget: <b>{{ $project->order?->amount }} Tk</b></span>

                                @if ($daysLeft == 'Expired')
                                    <span>Time: <strong class="text-danger"> Expired</strong> </span>
                                @else
                                    <span>Time: <strong>{{ $daysLeft }}</strong> days left</span>
                                @endif

                                <span>Total Designers: <b>{{ $project->subscription->designer ?? '0' }}</b></span>
                                <span>Total Designs: <b>{{ $project->subscription->design ?? '0' }}</b></span>


                                <span class="sidebar-info">Submitted Designer :
                                    <strong>{{ $project->total_designer ?? '0' }}</strong> </span>
                                <span class="sidebar-info"> Submitted design :
                                    <strong>{{ $project->total_submitted_design ?? '0' }}</strong></span>
                            </div>
                        </div>
                    </div>
                    <br />

                    <div class="card">
                        <div class="card-body">
                            <h5>References</h5>
                            <hr />
                            <div class="d-flex flex-column gap-1">
                                <span>Reference 1: -</span>
                                <span>Reference 2: -</span>
                                <span>Reference 3: -</span>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- right nav --}}
                <div class="col-12 col-md-8">
                    <div class="card shadow-sm border-0 rounded-3">
                        <!-- Header -->
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-archive me-2"></i> Submitted Files
                            </h5>

                            <a href="{{ route('submitted-file-view-all', $project->id) }}"
                                class="text-decoration-underline">
                                View all ({{ $project->uploads->count() }})
                            </a>

                            @if ($authUser && $authUser->role_id == 2)
                                @php
                                    $hasTimeLeft = $currentDate->lte($expireSubmitDate);
                                    $hasDesignSlots = $subscriptionDesign > $project->total_submitted_design;
                                    $hasDesignerSlots = $subscriptionDesigner > $project->total_designer;

                                    // Make sure individual designer does not exceed their allotted limit (e.g. 6 limit / 2 designers = 3 max per designer)
                                    $hasUserDesignSlots = $userUploadsCount < $maxPerDesigner;

                                    $canSubmit = $hasTimeLeft && $hasDesignSlots && $hasUserDesignSlots && ($isParticipatingDesigner || $hasDesignerSlots);
                                @endphp
                                @if ($canSubmit)
                                    <div>
                                        <a href="{{ route('job-submission', $project->id) }}"
                                            class="btn btn-sm btn-primary">
                                            Submit Your Design
                                        </a>
                                    </div>
                                @else
                                    <div>
                                        <button class="btn btn-sm btn-secondary" disabled
                                            style="cursor: not-allowed; opacity: 0.7;">
                                            Submission Closed
                                        </button>
                                    </div>
                                @endif
                            @endif

                        </div> <!-- Correct place -->
                    </div>


                    <!-- Body -->
                    <div class="card-body mt-2">
                        @if ($authUser && $authUser->role_id == 2)
                            @php
                                $uploadsLeft = max(0, $maxPerDesigner - $userUploadsCount);
                                $alertClass = $uploadsLeft > 0 ? 'alert-info' : 'alert-danger';
                                $iconClass = $uploadsLeft > 0 ? 'bi-info-circle-fill' : 'bi-exclamation-triangle-fill';
                            @endphp
                            <div class="alert {{ $alertClass }} d-flex align-items-center shadow-sm mb-4" role="alert" style="border-left: 4px solid {{ $uploadsLeft > 0 ? '#0dcaf0' : '#dc3545' }};">
                                <i class="bi {{ $iconClass }} me-3 fs-4"></i>
                                <div>
                                    <strong>Designer Quota:</strong> You have submitted <b>{{ $userUploadsCount }}</b> out of your max <b>{{ $maxPerDesigner }}</b> allowed designs. 
                                    @if($uploadsLeft > 0)
                                        You can still upload <b class="text-primary">{{ $uploadsLeft }}</b> more.
                                    @else
                                        Your upload limit for this project is <b class="text-danger">Full</b>.
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="row g-3">

                            @if (count($project->uploads) > 0)
                                @foreach ($project->uploads as $key => $uploadData)
                                    <div class="col-md-4">
                                        <div class="card h-100 border shadow-sm rounded-4 hover-card overflow-hidden">

                                            <!-- Image + Overlay -->
                                            <div class="position-relative">
                                                <!-- Watermark Overlay added here -->
                                                <div class="watermark-overlay" style="border-radius: 0.5rem;"></div>

                                                <div class="card-body p-2 d-flex justify-content-center align-items-center bg-light"
                                                    style="height: 200px; overflow: hidden; position: relative;">
                                                    <img src="{{ asset($uploadData->file_path) }}" alt="Request Image"
                                                        class="img-fluid rounded-3"
                                                        style="max-height: 180px; object-fit: cover;" oncontextmenu="return false" draggable="false">
                                                </div>

                                                <!-- Center Overlay Icon -->
                                                <button
                                                    class="btn btn-light rounded-circle shadow position-absolute top-50 start-50 translate-middle"
                                                    style="color: #0d6efd; font-size: 1.5rem; z-index: 20;"
                                                    onclick="openCustomImageModal('{{ asset($uploadData->file_path) }}', '{{ addslashes($uploadData->projectSubmit?->designer?->name) }}')">
                                                    <i class="bi bi-arrows-fullscreen"></i>
                                                </button>
                                            </div>

                                            <!-- Footer -->
                                            <div class="card-footer bg-white border-top text-center small">
                                                <div class="fw-semibold mb-1">
                                                    <a href="{{ route('designer-profile', $uploadData->projectSubmit?->designer?->id) }}"
                                                        class="text-decoration-none text-primary">
                                                        {{ $uploadData->projectSubmit?->designer?->name }}
                                                    </a>
                                                </div>
                                                <div class="text-muted mb-2">
                                                    📅
                                                    {{ \Carbon\Carbon::parse($uploadData->projectSubmit?->submit_date)->format('d M, Y') }}
                                                </div>

                                                <!-- Confirm Button -->
                                                @if (\Illuminate\Support\Facades\Auth::user()->role_id == 3)
                                                    <a href="{{ route('project.submitted-file.confirm', $uploadData->id) }}"
                                                        class="btn btn-success btn-sm w-100 rounded-pill shadow-sm"
                                                        onclick="return confirm('Are you sure to confirm !');">
                                                        <i class="bi bi-check-circle me-1"></i> Confirm
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
