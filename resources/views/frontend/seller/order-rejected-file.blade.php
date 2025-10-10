@extends('layouts.designer_panel')
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

                @if(count($orderRejectedFiles) > 0 )
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4>{{$orderRejectedFiles[0]->project?->name}} (Sample Image)</h4>
                        </div>
                    </div>
                @endif
                <div class="card-body">
                    <div class="row g-3">
                        @if(count($orderRejectedFiles) > 0 )
                            @foreach($orderRejectedFiles as $key=>$orderRejectedFile)

                                @php
                                    $file_type = $orderRejectedFile->file_type;
                                @endphp
                                <div class="col-md-4">
                                    <div class="card h-100 border shadow-sm rounded-4 hover-card overflow-hidden">
                                        <!-- Image + Overlay -->
                                        <div class="position-relative">
                                            <div class="card-body d-flex justify-content-center align-items-center bg-light"
                                                 style="height: 200px; overflow: hidden;">

                                                @if(Str::startsWith($orderRejectedFile->file_type, 'image'))
                                                    {{-- Show Image --}}
                                                    <img src="{{ asset($orderRejectedFile->file_path) }}"
                                                         alt="Request Image"
                                                         class="img-fluid rounded-3"
                                                         style="max-height: 180px; object-fit: cover;">
                                                @elseif($orderRejectedFile->file_type === 'application/zip')
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
                                            @if(Str::startsWith($orderRejectedFile->file_type, 'image'))
                                                <button class="btn btn-light rounded-circle shadow position-absolute top-50 start-50 translate-middle"
                                                        style="color: #0d6efd; font-size: 1.5rem;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#imageModal{{ $key }}">
                                                    <i class="bi bi-arrows-fullscreen"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <a href="{{ asset($orderRejectedFile->file_path) }}"
                                           download
                                           class="btn btn-success text-center">Download</a>
                                    </div>
                                </div>

                                <!-- Modal -->
                                @if(Str::startsWith($orderRejectedFile->file_type, 'image'))
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
                                                    <img src="{{ asset($orderRejectedFile->file_path) }}"
                                                         class="modal-preview-img"
                                                         alt="Preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                                <div class="pagination-wrapper d-flex justify-content-center mt-4">
                                    {{ $orderRejectedFiles->withQueryString()->links('pagination.custom') }}
                                </div>
                        @else
                            <div class="col-12 text-center py-4">
                                <p class="mb-0 text-danger"> No Sample file submitted yet!</p>
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
