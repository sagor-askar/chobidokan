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
    </style>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 Bundle JS (Popper সহ) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="section">
    <div class="container" style="margin-top: 5rem;">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <div class="row">
            <div class="col-md-4">

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$project?->name}}</h5>
                        <hr>
                        <p class="card-text">{!! $project->project_description !!}</p>
                        <p class="card-text"><small class="text-muted">Posted On: {{\Carbon\Carbon::parse($project->publish_date)->format('d-m-Y')}}</small></p>
                    </div>
                </div>
                @php
                    $subscriptions = json_decode($project->subscription?->points);
                    $subscriptionDesigner = $project->subscription->designer;

                     $expireDate = \Carbon\Carbon::parse($project->expire_date)->startOfDay();
                     $today = \Carbon\Carbon::now()->startOfDay();
                     $daysLeft = $today->gt($expireDate)? 'Expired': $today->diffInDays($expireDate);


                    $expireSubmitDate = \Carbon\Carbon::parse($project->expire_date);
                    $currentDate = \Carbon\Carbon::now();
                    $authUser = \Illuminate\Support\Facades\Auth::user();
                @endphp

                <div class="card">
                    <div class="card-body">
                        <h5>Statistics</h5>
                        <hr />
                        <div class="d-flex flex-column gap-1">
                            <span>Budget: <b>{{$project->order?->amount}} Tk</b></span>

                            @if($daysLeft == 'Expired')
                                <span>Time: <strong class="text-danger"> Expired</strong> </span>
                            @else
                                <span>Time:  <strong>{{$daysLeft}}</strong>  days left</span>
                            @endif

                            <span>Total Designers:  <b>{{$project->total_designer ?? '0'}}</b></span>
                            <span>Total Designs: <b>{{$project->total_submitted_design ?? '0'}}</b></span>
                        </div>
                    </div>
                </div>
                <br />

                <div class="card">
                    <div class="card-body">
                        <h5>References</h5>
                        <hr />
                        <div class="d-flex flex-column gap-1">
                            <span>Reference 1: ABCD</span>
                            <span>Reference 2: EFGH</span>
                            <span>Reference 3: IJKL</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- right nav --}}
            <div class="col-12 col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <!-- Header -->
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-archive me-2"></i> Submitted Files
                        </h5>
                        <a href="#" class="text-decoration-underline">
                            View all ({{ $project->uploads->count() }})
                        </a>


                        @if($authUser->role_id == 2)
                            @if($currentDate->lte($expireSubmitDate) && $subscriptionDesigner > $project->total_designer)
                                    <div>
                                        <a href="{{ route('job-submission',$project->id) }}" class="btn btn-sm btn-primary">Submit Your Design</a>
                                    </div>
                            @else
                                <div>
                                        <button class="btn btn-sm btn-secondary" disabled style="cursor: not-allowed; opacity: 0.7;">
                                            Submission Closed
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>

                    <!-- Body -->
                    <!-- Card Section -->
                    <div class="card-body mt-2">
                        <div class="row g-4">


                            @if(count($project->uploads) > 0 )
                                @foreach($project->uploads as $key=>$uploadData)
                                <div class="col-md-4">
                                    <div class="card h-100 border shadow-sm rounded-4 hover-card overflow-hidden">

                                        <!-- Image + Overlay -->
                                        <div class="position-relative">
                                            <div class="card-body p-2 d-flex justify-content-center align-items-center bg-light"
                                                 style="height: 200px; overflow: hidden;">
                                                <img src="{{ asset($uploadData->file_path) }}"
                                                     alt="Request Image"
                                                     class="img-fluid rounded-3"
                                                     style="max-height: 180px; object-fit: cover;">
                                            </div>

                                            <!-- Center Overlay Icon -->
                                            <button class="btn btn-light rounded-circle shadow position-absolute top-50 start-50 translate-middle"
                                                    style="color: #0d6efd; font-size: 1.5rem;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#imageModal{{ $key }}">
                                                <i class="bi bi-arrows-fullscreen"></i>
                                            </button>
                                        </div>

                                        <!-- Footer -->
                                        <div class="card-footer bg-white border-top text-center small">
                                            <div class="fw-semibold mb-1">
                                                <a href="{{ route('designer-profile',$uploadData->projectSubmit?->user?->id) }}"
                                                   class="text-decoration-none text-primary">
                                                    {{ $uploadData->projectSubmit?->user?->name }}
                                                </a>
                                            </div>
                                            <div class="text-muted mb-2">
                                                📅 {{ \Carbon\Carbon::parse($uploadData->projectSubmit?->submit_date)->format('d M, Y') }}
                                            </div>

                                            <!-- Confirm Button -->
                                            <a href="#"
                                               class="btn btn-success btn-sm w-100 rounded-pill shadow-sm">
                                                <i class="bi bi-check-circle me-1"></i> Confirm
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="imageModal{{ $key }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered"> <!-- large modal, centered -->
                                        <div class="modal-content bg-dark rounded-0">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title text-white">Preview</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-center align-items-center p-0" style="max-height: 100vh;">
                                                <img src="{{ asset($uploadData->file_path) }}"
                                                     class="img-fluid"
                                                     style="max-height: 100vh; max-width: 100%; object-fit: contain;"
                                                     alt="Preview">
                                            </div>
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


@endsection
