@extends('layouts.designer_panel')
@section('panel_content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
        .ck-editor__editable {
            min-height: 150px; /* চাইলে height বাড়াও, যেমন 400px */
        }
        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }

        .tags-input {
            display: flex;
            flex-wrap: wrap;
            border: 1px solid #ced4da;
            padding: 5px;
            border-radius: 5px;
            cursor: text;
        }

        .tags-input input {
            border: none;
            outline: none;
            flex: 1;
            min-width: 100px;
        }

        .tag {
            background-color: #5bc0de;
            color: white;
            padding: 5px 10px;
            margin: 2px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
        }

        .tag i {
            margin-left: 8px;
            font-weight: bold;
            cursor: pointer;
            color: white;
        }

        .tag i:hover {
            color: #d9534f;
        }
    </style>

    <div class="container py-4">
        <div class="row gx-4">

            <!-- Main Upload Form -->
            <div class="col-lg-9 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h3 class="mb-0">Update Your Design</h3>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                            <form action="{{ route('designer.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row g-3">
                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <label for="designTitle" class="form-label">Design Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               id="designTitle" name="title" value="{{ old('title', $product->title) }}" required>
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-6">
                                        <label for="category-select" class="form-label">Design Category</label>
                                        <select id="category-select" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option disabled>All Categories ({{ count($categories) }})</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3 form-group position-relative">
                                            <label for="type-select" class="form-label">Type</label>
                                            <select id="type-select" name="type" class="form-control @error('type') is-invalid @enderror" required>
                                                <option selected disabled>Select Type</option>
                                                <option value="1"{{ (old('type', $product->type) == 1) ? 'selected' : '' }}>Image</option>
                                                <option value="2"{{ (old('type', $product->type) == 2) ? 'selected' : '' }}> Video</option>
                                            </select>
                                            @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <i class="fa fa-chevron-down position-absolute" style="top: 40px; right: 20px; pointer-events: none; color: #aaa;"></i>
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="col-md-6">
                                        <label for="designPrice" class="form-label">Design Price</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                               id="designPrice" name="price" value="{{ old('price', $product->price) }}" required>
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                  <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tags" class="form-label"> Tags  <small class="text-muted ms-1">(Press 'Enter' or ',' to add)</small></label>
                                        <div class="tags-input" id="tags-input">
                                            <input type="text" id="tag-input-field" placeholder="Type and press Enter" class="form-control border-0 shadow-none p-0">
                                        </div>
                                    </div>
                                  </div>


                                    <!-- Description -->
                                    <div class="col-12">
                                        <label for="description" class="form-label">Description (Optional)</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label for="designFile" class="form-label">Upload File (<small>Accepted: EPS, PSD, JPG</small>)</label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                               id="designFile" name="file">
                                        @if($product->file_path)
                                            <div class="mb-2">
                                                <img src="{{ asset($product->file_path) }}"
                                                     alt="User Image"
                                                     class="img-thumbnail"
                                                     style="max-width: 150px; max-height: 90px;">
                                            </div>
                                        @else
                                            <p class="text-muted">No image uploaded yet.</p>
                                        @endif

                                        @error('file')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success btn-lg w-100">Update Design</button>
                                </div>
                            </form>

                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Technical Requirements</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-3">
                            <strong>Vectors (EPS)</strong>
                            <ul class="small ps-3 mb-0">
                                <li>Must include a JPG preview file</li>
                                <li>Format: EPS (required)</li>
                                <li>File size: 0.5MB – 80MB</li>
                                <li>Color mode: RGB</li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <strong>PSD files (PSD)</strong>
                            <ul class="small ps-3 mb-0">
                                <li>Must include a JPG preview file</li>
                                <li>Format: PSD</li>
                                <li>File size: 1.5MB – 250MB</li>
                                <li>Preview: JPG 4MP – 100MP</li>
                                <li>Color mode: sRGB, Adobe RGB, ProPhoto RGB or P3</li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <strong>Photos (JPG)</strong>
                            <ul class="small ps-3 mb-0">
                                <li>Format: JPG</li>
                                <li>File size: 1.5MB – 250MB</li>
                                <li>Preview resolution: 4MP – 100MP</li>
                                <li>Color mode: sRGB, Adobe RGB, ProPhoto RGB</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => { console.error(error); });
    </script>

    <script>
        const tagsInput = document.getElementById('tags-input');
        const inputField = document.getElementById('tag-input-field');
        const initialTags = {!! $product->tags ?? '[]' !!};  // Decode JSON tags or default to an empty array
        initialTags.forEach(tag => createTag(tag));

        function createTag(text) {
            const tag = document.createElement('span');
            tag.classList.add('tag');
            tag.innerHTML = `${text} <i class="bi bi-x"></i>`;

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'tags[]';
            hiddenInput.value = text;
            tagsInput.appendChild(hiddenInput);

            const closeButton = tag.querySelector('i');
            closeButton.addEventListener('click', () => {
                tag.remove();
                hiddenInput.remove();
            });
            tagsInput.insertBefore(tag, inputField);
        }

        inputField.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ',') {
                event.preventDefault(); // Prevent form submission
                const tagText = inputField.value.trim();
                if (tagText !== '') {
                    createTag(tagText);
                    inputField.value = '';
                }
            }
        });
    </script>

@endsection
