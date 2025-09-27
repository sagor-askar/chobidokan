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

        .modal-preview-img {
            max-width: 80%;
            max-height: 80vh;
            object-fit: contain;
            border-radius: 6px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }

        .modal-dialog {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <div class="container">
        <div class="row">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-section">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{$orderSubmittedFiles[0]->project?->name}} (Original Image)</h4>
                    </div>

                    <div class="approve-reject-btns">
                        <button class="btn btn-sm btn-success btn-lg" data-bs-toggle="modal"
                                data-bs-target="#approveModal">Approve</button>
                        <button class="btn btn-sm btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>
                    </div>
                </div>
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
                                                        style="color: #0d6efd; font-size: 1.5rem;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#imageModal{{ $key }}">
                                                    <i class="bi bi-arrows-fullscreen"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <a href="{{ asset($orderSubmittedFile->file_path) }}"
                                           download
                                           class="btn btn-success text-center">Download</a>
                                    </div>
                                </div>

                                <!-- Modal -->
                                @if(Str::startsWith($orderSubmittedFile->file_type, 'image'))
                                    <!-- Modal -->
                                    <div class="modal fade" id="imageModal{{ $key }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content bg-dark border-0 rounded-3 shadow-lg">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title text-white">Preview</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center align-items-center bg-black"
                                                     style="padding: 15px;">
                                                    <img src="{{ asset($orderSubmittedFile->file_path) }}"
                                                         class="modal-preview-img"
                                                         alt="Preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="col-12 text-center py-4">
                                <p class="mb-0 text-danger">No submissions available yet.</p>
                            </div>
                        @endif
                    </div>
                </div>


            </div>

                <!-- Approve Modal -->
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
                                <div class="modal-body">
                                    <label for="reason" class="form-label required">Comments (<small>Not Mandatory</small>)</label>
                                    <textarea name="comment" id="reason" class="form-control" rows="6"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Reject Modal -->

                <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('user.order.submission.reject', $orderSubmittedFiles[0]->project_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content" style="width: 180%">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rejectModalLabel">Confirm Rejection </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <label for="reason" class="form-label required">Reason for rejection (<small>Mandatory</small>)</label>
                                    <textarea name="comment" id="reason" class="form-control" rows="6" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



        </div>
    </div>
    </div>
    </div>

@endsection
