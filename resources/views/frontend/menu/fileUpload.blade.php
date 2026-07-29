@extends('includes.master')
@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --primary-hover: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
        --card-border: #e2e8f0;
        --input-focus: rgba(99, 102, 241, 0.15);
    }

    .upload-page-wrapper {
        background-color: #f8fafc;
        min-height: 100vh;
        padding-top: 1rem;
        padding-bottom: 3rem;
    }

    .upload-card {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 20px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        padding: 2rem;
        transition: all 0.3s ease;
    }

    .section-header {
        border-bottom: 2px dashed #edf2f7;
        padding-bottom: 1.25rem;
        margin-bottom: 2rem;
    }

    .section-title {
        font-weight: 700;
        color: #1e293b;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--primary-gradient);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #334155;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border: 1.5px solid #cbd5e1;
        border-radius: 10px;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s ease-in-out;
        color: #1e293b;
    }

    .form-control:focus, .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px var(--input-focus);
        outline: none;
    }

    /* Custom Switch Styling */
    .free-toggle-wrapper {
        background: #f8fafc;
        padding: 0.6rem 1rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1.5px solid #cbd5e1;
        min-height: 48px;
    }

    .form-check-input {
        width: 2.6rem;
        height: 1.4rem;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #ea580c;
        border-color: #ea580c;
    }

    .badge-status {
        font-size: 0.78rem;
        font-weight: 700;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        transition: all 0.2s;
    }

    /* Free badge Orange/Red color */
    .badge-free {
        background-color: #ffedd5;
        color: #c2410c;
        border: 1px solid #fed7aa;
    }

    .badge-paid {
        background-color: #dbeafe;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }

    /* Dropzone Styling */
    .dropzone-box {
        border: 2px dashed #a5b4fc;
        border-radius: 16px;
        background: #f8fafc;
        padding: 2.25rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .dropzone-box:hover, .dropzone-box.dragover {
        border-color: #6366f1;
        background: #eef2ff;
    }

    .dropzone-icon {
        font-size: 2.5rem;
        color: #6366f1;
        margin-bottom: 0.5rem;
        transition: transform 0.2s ease;
    }

    .dropzone-box:hover .dropzone-icon {
        transform: translateY(-4px);
    }

    .file-preview-info {
        display: none;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        margin-top: 0.75rem;
        padding: 0.65rem 1rem;
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        font-size: 0.9rem;
        font-weight: 500;
        color: #334155;
    }

    /* Tags Input Styling */
    .tags-input-container {
        border: 1.5px solid #cbd5e1;
        border-radius: 10px;
        padding: 0.5rem;
        min-height: 48px;
        background-color: #ffffff;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        align-items: center;
        cursor: text;
        transition: all 0.2s;
    }

    .tags-input-container:focus-within {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px var(--input-focus);
    }

    .tag-badge {
        background: var(--primary-gradient);
        color: white;
        padding: 0.35rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        box-shadow: 0 2px 6px rgba(79, 70, 229, 0.2);
    }

    .tag-badge i {
        cursor: pointer;
        font-size: 0.9rem;
        opacity: 0.85;
        transition: opacity 0.2s;
    }

    .tag-badge i:hover {
        opacity: 1;
        color: #fecaca;
    }

    /* Sidebar Styling */
    .sidebar-card {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    .sidebar-header {
        font-weight: 700;
        font-size: 1.1rem;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 1rem;
    }

    .req-item-card {
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .req-title {
        font-weight: 600;
        font-size: 0.95rem;
        color: #334155;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .req-list {
        padding-left: 1.25rem;
        margin-bottom: 0;
        font-size: 0.85rem;
        color: #64748b;
    }

    .req-list li {
        margin-bottom: 0.35rem;
    }

    /* Button Gradient Styling */
    .btn-submit-gradient {
        background: var(--primary-gradient);
        color: #ffffff;
        border: none;
        font-weight: 600;
        font-size: 1rem;
        padding: 0.85rem 2.25rem;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-submit-gradient:hover {
        background: var(--primary-hover);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45);
    }

    .ck-editor__editable {
        min-height: 140px;
        border-bottom-left-radius: 10px !important;
        border-bottom-right-radius: 10px !important;
    }

    /* Modal z-index fix */
    #addCategoryModal {
        z-index: 2050 !important;
    }

    .modal-backdrop {
        z-index: 2040 !important;
    }

    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    @media (min-width: 992px) {
        .sticky-sidebar {
            position: sticky;
            top: 2rem;
        }
    }
</style>

<div class="upload-page-wrapper">
    <div class="container py-4 mt-4">
        <div class="row g-2">
            <!-- Main Content -->
            <div class="col-lg-8 col-xl-9">
                <div class="upload-card" id="uploadForm">
                    <div class="section-header">
                        <div class="section-title">
                            <div class="section-title-icon">
                                <i class="bi bi-cloud-upload-fill"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 font-weight-bold" style="color: #0f172a;">Upload Your Asset</h4>
                                <p class="text-muted small mb-0">Share your image or video artwork with our global creative community.</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('designer.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="designTitle" class="form-label">Design Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="designTitle" name="title" value="{{ old('title') }}" placeholder="Enter the title" required>
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label for="category-select" class="form-label mb-0">Category <span class="text-danger">*</span></label>
                                        <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2 rounded-pill" style="font-size: 0.78rem;" data-bs-toggle="modal" data-bs-target="#addCategoryModal" data-toggle="modal" data-target="#addCategoryModal">
                                            <i class="bi bi-plus-lg me-1"></i>Add Category
                                        </button>
                                    </div>
                                    <select id="category-select" name="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type-select" class="form-label">Media Type <span class="text-danger">*</span></label>
                                    <select id="type-select" name="type" class="form-select @error('type') is-invalid @enderror" required>
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>🖼️ Image</option>
                                        <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>🎥 Video</option>
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pricing Section -->
                            <div class="col-md-6">

                                        <label class="form-label">Is Free</label>
                                        <div class="free-toggle-wrapper">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="is_free" name="is_free" value="1" {{ (old('_token') ? old('is_free') == '1' : true) ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                            <span id="badge-status-text" class="badge-status badge-free">
                                                🔥 Free
                                            </span>
                                        </div>
                                        @error('is_free')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                            </div>

                            <div class="col-md-6 mb-3" id="price-container" style="display: none;">
                                <label for="price-select" class="form-label">Standard Price</label>
                                <div class="position-relative">
                                    <select id="price-select" class="form-select @error('price') is-invalid @enderror" disabled style="background-color: #e9ecef; cursor: not-allowed;">
                                        <option value="" selected disabled>Select Price</option>
                                        <option value="{{ $settings->image_price ?? 0 }}">Image Price - {{ $settings->image_price ?? 0 }}</option>
                                        <option value="{{ $settings->video_price ?? 0 }}">Video Price - {{ $settings->video_price ?? 0 }}</option>
                                    </select>
                                    <input type="hidden" name="price" id="price-hidden" value="{{ old('price', '0') }}">
                                </div>
                                @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tags -->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="tag-input-field" class="form-label">
                                        Tags / Keywords
                                        <span class="text-muted fw-normal ms-1" style="font-size: 0.82rem;">(Press 'Enter' or ',' to add tags)</span>
                                    </label>
                                    <div class="tags-input-container" id="tags-input">
                                        <input type="text" id="tag-input-field" class="border-0 shadow-none p-0 flex-grow-1" style="outline: none; min-width: 140px;" placeholder="e.g. vector, wallpaper, 3d">
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="text-muted fw-normal">(Optional)</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="3" placeholder="Provide a brief overview of your design...">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- File Upload Area -->
                            <div class="col-12">
                                <div class="mb-4">
                                    <label class="form-label">Upload File <span class="text-danger">*</span></label>
                                    <div class="dropzone-box" onclick="document.getElementById('designFile').click();">
                                        <div class="dropzone-icon">
                                            <i class="bi bi-cloud-arrow-up"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1" style="color: #1e293b;">Click to upload or drag & drop file</h6>
                                        <p class="text-muted small mb-2">Supported formats: Images (JPG, PNG, GIF) or Videos (MP4, MOV)</p>
                                        <span class="badge bg-light text-secondary border px-3 py-1">Max File Size: 250MB</span>
                                        <input type="file" class="d-none @error('file') is-invalid @enderror"
                                               id="designFile" name="file" accept="image/*,video/*" required>
                                    </div>
                                    <div class="file-preview-info" id="file-preview-box">
                                        <i class="bi bi-file-earmark-check-fill text-success fs-5"></i>
                                        <span id="file-name-text">No file selected</span>
                                        <span class="badge bg-success ms-auto">Ready to upload</span>
                                    </div>
                                    @error('file')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end pt-2">
                            <button type="submit" class="btn btn-submit-gradient">
                                <i class="bi bi-rocket-takeoff-fill"></i> Submit Asset
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 col-xl-3">
                <div class="sidebar-card sticky-sidebar">
                    <div class="sidebar-header">
                        <i class="bi bi-shield-check text-primary fs-5"></i>
                        <span>Technical Guidelines</span>
                    </div>

                    <div class="req-item-card">
                        <div class="req-title">
                            <i class="bi bi-image text-indigo fs-6"></i> Photos & Images
                        </div>
                        <ul class="req-list">
                            <li>Format: JPG, PNG</li>
                            <li>File size: 1.5MB – 250MB</li>
                            <li>Resolution: 4MP – 100MP</li>
                            <li>Color mode: sRGB, Adobe RGB</li>
                        </ul>
                    </div>

                    <div class="req-item-card">
                        <div class="req-title">
                            <i class="bi bi-camera-video text-purple fs-6"></i> Video Footage
                        </div>
                        <ul class="req-list">
                            <li>Format: MP4, MOV, PSD</li>
                            <li>Include preview JPG image</li>
                            <li>File size: 1.5MB – 250MB</li>
                            <li>Color mode: sRGB or P3</li>
                        </ul>
                    </div>

                    <div class="p-3 rounded-3 bg-light border border-info-subtle">
                        <div class="d-flex gap-2">
                            <i class="bi bi-lightbulb-fill text-warning fs-5"></i>
                            <div>
                                <h6 class="fw-bold mb-1" style="font-size: 0.88rem;">Creator Tip</h6>
                                <p class="text-muted mb-0" style="font-size: 0.8rem; line-height: 1.4;">Adding relevant tags and detailed titles helps buyers find your artwork faster!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal (Placed at root level outside wrapper) -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title font-weight-bold" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <form id="categoryForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" id="categoryName"
                               class="form-control"
                               placeholder="e.g. 3D Illustrations"
                               required>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light border px-3" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit-gradient">
                            Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    // Tags Input Handling
    const tagsInput = document.getElementById('tags-input');
    const inputField = document.getElementById('tag-input-field');

    inputField.addEventListener('keydown', function(event) {
        if (event.key === 'Enter' || event.key === ',') {
            event.preventDefault();
            const tagText = inputField.value.trim();
            if (tagText !== '') {
                createTag(tagText);
                inputField.value = '';
            }
        }
    });

    function createTag(text) {
        const tag = document.createElement('span');
        tag.classList.add('tag-badge');
        tag.innerHTML = `${text} <i class="bi bi-x-circle-fill"></i>`;

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
</script>

<script>
    // Add Category Modal AJAX & Reliable Dismiss Function
    function hideCategoryModal() {
        const modalEl = document.getElementById('addCategoryModal');
        if (window.bootstrap && bootstrap.Modal) {
            const instance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            if (instance) instance.hide();
        }
        if (typeof $ !== 'undefined' && $.fn.modal) {
            $('#addCategoryModal').modal('hide');
        }
        modalEl.classList.remove('show');
        modalEl.style.display = 'none';
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) backdrop.remove();
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }

    document.getElementById('categoryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let name = document.getElementById('categoryName').value;
        fetch("{{ route('designer.add.category') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                name: name
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                let select = document.getElementById('category-select');
                let option = document.createElement("option");
                option.value = data.category.id;
                option.text = data.category.name;
                option.selected = true;
                select.appendChild(option);
                document.getElementById('categoryForm').reset();
                hideCategoryModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Category Added',
                    text: 'New category created successfully',
                    confirmColor: '#4f46e5'
                });
            }
        });
    });
</script>

<script>
    // Is Free & Price Logic + File Upload Preview
    document.addEventListener('DOMContentLoaded', function () {
        const isFreeCheckbox = document.getElementById('is_free');
        const badgeStatusText = document.getElementById('badge-status-text');
        const priceContainer = document.getElementById('price-container');
        const priceSelect = document.getElementById('price-select');
        const priceHidden = document.getElementById('price-hidden');
        const typeSelect = document.getElementById('type-select');

        const imagePrice = "{{ $settings->image_price ?? 0 }}";
        const videoPrice = "{{ $settings->video_price ?? 0 }}";

        function updatePriceState() {
            if (isFreeCheckbox.checked) {
                priceContainer.style.display = 'none';
                priceHidden.value = '0';
                priceSelect.value = '';
                badgeStatusText.className = 'badge-status badge-free';
                badgeStatusText.innerHTML = '🔥 Free';
            } else {
                priceContainer.style.display = 'block';
                badgeStatusText.className = 'badge-status badge-paid';
                badgeStatusText.innerHTML = '💎 Paid';
                autoSelectPrice();
            }
        }

        function autoSelectPrice() {
            if (isFreeCheckbox.checked) return;

            const selectedType = typeSelect.value;
            if (selectedType === '1') {
                priceSelect.value = imagePrice;
                priceHidden.value = imagePrice;
            } else if (selectedType === '2') {
                priceSelect.value = videoPrice;
                priceHidden.value = videoPrice;
            } else {
                priceSelect.value = '';
                priceHidden.value = '';
            }
        }

        isFreeCheckbox.addEventListener('change', updatePriceState);
        typeSelect.addEventListener('change', autoSelectPrice);

        updatePriceState();

        // File Selection Drag & Drop Preview
        const fileInput = document.getElementById('designFile');
        const filePreviewBox = document.getElementById('file-preview-box');
        const fileNameText = document.getElementById('file-name-text');

        fileInput.addEventListener('change', function() {
            if (fileInput.files && fileInput.files[0]) {
                const file = fileInput.files[0];
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                fileNameText.textContent = `${file.name} (${sizeInMB} MB)`;
                filePreviewBox.style.display = 'flex';
            }
        });
    });
</script>
@endsection
