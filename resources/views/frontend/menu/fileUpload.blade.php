@extends('includes.master')
@section('content')
<style>
    .sidebar {
        background-color: #fff;
        border-left: 2px solid #ddd;
        padding: 14px;
    }

    .tag-line {
        font-size: 1.25rem;
        margin-top: 20px;
    }

    .upload-preview {
        padding: 60px 0;
        text-align: center;
    }

    .requirement-title {
        font-weight: 600;
        font-size: 0.9rem;
        margin-top: 0px;
    }

    .upload-btn {
        margin-top: 20px;
    }

    @media (min-width: 992px) {
        .sidebar {
            height: 100vh;
            overflow-y: auto;
            position: sticky;
            top: 0;
        }
    }


    @media (max-width: 500px) {
        .topbar {
            margin-top: 20px;
            flex-direction: column !important;
            align-items: center !important;
            text-align: center;
        }

        .topbar .d-flex {
            justify-content: center !important;
        }


        .upload-preview h5 {
            font-size: 1.2rem;
        }

        .upload-preview p {
            font-size: 0.9rem;
        }

        .requirement-title {
            font-size: 0.95rem;
        }

        .sidebar ul {
            padding-left: 18px;
        }

        .btn-sm {
            font-size: 0.8rem;
            padding: 6px 10px;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }
    }

</style>

<div class="container mt-4">
    <div class="container-fluid p-3 p-md-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9 p-3 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap topbar">
                    <h3 class="mb-2 mb-md-0">Upload Your Design</h3>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary">Upload CSV</button>
                        <button class="btn btn-sm btn-primary">Upload files</button>
                    </div>
                </div>

                <div class="upload-preview">
                    <h5>Submit your first work</h5>
                    <p class="text-muted">
                        You’re almost there! <strong>Upload and submit 150 - 200 files for review</strong>.<br>
                        Once they’re approved, you’re all set to start selling your content.
                    </p>
                    <button class="btn btn-primary">Get started</button>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3 sidebar">
                <h6><i class="bi bi-list"></i> Technical Requirements</h6>

                <div class="requirement-title">Vectors (EPS)</div>
                <ul class="small">
                    <li>Must include a JPG preview file</li>
                    <li>Format: EPS (required)</li>
                    <li>File size: 0.5MB – 80MB</li>
                    <li>Color mode: RGB</li>
                </ul>

                <div class="requirement-title">PSD files (PSD)</div>
                <ul class="small">
                    <li>Must include a JPG preview file</li>
                    <li>Format: PSD</li>
                    <li>File size: 1.5MB – 250MB</li>
                    <li>Preview: JPG 4MP – 100MP</li>
                    <li>Color mode: sRGB, Adobe RGB, ProPhoto RGB or P3</li>
                </ul>

                <div class="requirement-title">Photos (JPG)</div>
                <ul class="small">
                    <li>Format: JPG</li>
                    <li>File size: 1.5MB – 250MB</li>
                    <li>Preview resolution: 4MP – 100MP</li>
                    <li>Color mode: sRGB, Adobe RGB, ProPhoto RGB</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
