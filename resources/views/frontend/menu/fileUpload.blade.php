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
        padding: 15px 0;
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

    .topbar {
        border-bottom: 1px solid black;
    }

    @media (min-width: 992px) {
        .sidebar {
            height: 80vh;
            overflow-y: auto;
            position: sticky;
            top: 0;
            margin-top: 1.5rem;
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


     .ck-editor__editable {
         min-height: 150px; /* চাইলে height বাড়াও, যেমন 400px */
     }


</style>

<div class="container mt-4">
    <div class="container-fluid p-3 p-md-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9 p-3 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap topbar">
                    <h3 class="mb-2 mb-md-0">Upload Your Design</h3>
                    <hr>
                </div>

                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="upload-preview">
                    <h5>Submit your first work</h5>
                    <p class="text-muted">
                        You’re almost there! <strong>Upload and submit 150 - 200 files for review</strong>.<br>
                        Once they’re approved, you’re all set to start selling your content.
                    </p>
                </div>


                <!-- Upload Form (Hidden initially) -->
                <div class="container" id="uploadForm">
                    <div class="card shadow p-4">
                        <h4>Upload Design</h4>
                        <hr>
                        <form action="{{ route('designer.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="designTitle" class="form-label">Design Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               id="designTitle" name="title" value="{{ old('title') }}" placeholder="Enter Design Title" required>
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="col-md-4">
                                    <div class="mb-3 form-group position-relative">
                                        <label for="category-select" class="form-label">Category</label>
                                        <select id="category-select" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                            <option selected disabled>All Categories ({{ count($categories) }})</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <i class="fa fa-chevron-down position-absolute" style="top: 40px; right: 20px; pointer-events: none; color: #aaa;"></i>
                                    </div>
                                </div>

                                <!-- Type -->
                                <div class="col-md-4">
                                    <div class="mb-3 form-group position-relative">
                                        <label for="type-select" class="form-label">Type</label>
                                        <select id="type-select" name="type" class="form-control @error('type') is-invalid @enderror" required>
                                            <option selected disabled>Select Type</option>
                                            <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Image</option>
                                            <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Video</option>
                                        </select>
                                        @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <i class="fa fa-chevron-down position-absolute" style="top: 40px; right: 20px; pointer-events: none; color: #aaa;"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Price -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="designPrice" class="form-label">Design Price</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                               id="designPrice" name="price" value="{{ old('price') }}" placeholder="Enter Design Price" required>
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- File Upload -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="designFile" class="form-label">Upload File</label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                               id="designFile" name="file" accept="image/*,video/*" required>
                                        <div class="form-text">Accepted: Image / Video</div>
                                        @error('file')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description (Optional)</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="3" placeholder="Type Design Description">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Submit Design</button>
                        </form>


                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3 sidebar">
                <h6><i class="bi bi-list"></i> Technical Requirements</h6>
                <hr>
                <div class="requirement-title">Photos (JPG)</div>
                <ul class="small">
                    <li>Format: JPG</li>
                    <li>File size: 1.5MB – 250MB</li>
                    <li>Preview resolution: 4MP – 100MP</li>
                    <li>Color mode: sRGB, Adobe RGB, ProPhoto RGB</li>
                </ul>

                <div class="requirement-title">Videos</div>
                <ul class="small">
                    <li>Must include a JPG preview file</li>
                    <li>Format: PSD</li>
                    <li>File size: 1.5MB – 250MB </li>
                    <li>Preview: JPG 4MP – 100MP </li>
                    <li>Color mode: sRGB, Adobe RGB, ProPhoto RGB or P3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>


@endsection
