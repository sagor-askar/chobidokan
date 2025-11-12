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

        /* Modal image full width */
        .modal-img {
            width: 100%;
            max-height: 80vh;
            object-fit: contain;
        }

        /* Eye icon overlay */
        .card-eye {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.6);
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background 0.3s;
            z-index: 2;
        }
        .card-eye:hover {
            background: rgba(13,110,253,0.8);
        }
        .card-eye i {
            color: #fff;
            font-size: 16px;
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
                                                 style="cursor: pointer;"
                                                 data-toggle="modal"
                                                 data-target="#imageModal"
                                                 onclick="$('#modalImage').attr('src','{{ asset($designerSubmitfile->file_path) }}')">


                                            <!-- Eye Icon -->
                                            <div class="card-eye"
                                                 data-toggle="modal"
                                                 data-target="#imageModal"
                                                 onclick="$('#modalImage').attr('src','{{ asset($designerSubmitfile->file_path) }}')">
                                                <i class="fas fa-eye"></i>
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
                                                {{ $designerSubmitfile->projectSubmit?->user?->name }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="" id="modalImage" class="modal-img rounded shadow">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
