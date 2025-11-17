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

        .watermark-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-size: 1rem;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
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
                                                    <a href="{{ route('designer-profile',$uploadData->projectSubmits?->user?->id) }}"
                                                       class="text-decoration-none text-primary">
                                                        {{ $uploadData->projectSubmits?->user?->name }}
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

                                    <!-- Modal -->
                                    <div class="modal fade" id="imageModal{{ $key }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl"> <!-- বড় modal -->
                                            <div class="modal-content bg-dark rounded-0">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title text-white">Preview</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center align-items-center p-0 position-relative"
                                                     style="max-height: 100vh; overflow:hidden;">

                                                    <!-- Image -->
                                                    <img src="{{ asset($uploadData->file_path) }}"
                                                         class="img-fluid"
                                                         style="max-height: 100vh; max-width: 100%; object-fit: contain;"
                                                         alt="Preview">

                                                    <!-- Watermark Overlay -->
                                                    <div class="watermark-text">Chobi Dokan</div>
                                                </div>
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
@endsection
