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

        .upload-box {
            border: 2px dashed #0d6efd;
            border-radius: 12px;
            text-align: center;
            padding: 40px 20px;
            margin-bottom: 20px;
            color: #6c757d;
            background: #f9fafc;
            transition: 0.3s ease;
        }

        .upload-box:hover {
            background-color: #eef5ff;
            border-color: #0a58ca;
            color: #0a58ca;
        }

        .upload-box p {
            margin: 0;
            font-weight: 500;
            font-size: 1rem;
        }

        .upload-box small {
            display: block;
            margin-top: 8px;
            font-size: 0.85rem;
            color: #6b7280;
        }
        .btn-primary {
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
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

    <div class="container">
        <div class="row">
            <div class="form-section">
                <div class="card-header">
                    <h4>{{$selectedImages[0]->project?->name}} (Selected Image)</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">


                        @if(count($selectedImages) > 0 )
                            @foreach($selectedImages as $key=>$uploadData)
                                <div class="col-md-4">
                                    <div class="card h-100 border shadow-sm rounded-4 hover-card overflow-hidden">

                                        <!-- Image + Overlay -->
                                        <div class="position-relative">
                                            <div class="card-body  d-flex justify-content-center align-items-center bg-light"
                                                 style="height: 200px; overflow: hidden;">
                                                <img src="{{ asset($uploadData->file_path) }}"
                                                     alt="Request Image"
                                                     class="img-fluid rounded-3"
                                                     style="max-height: 180px; object-fit: cover;" oncontextmenu="return false" draggable="false">
                                            </div>

                                            <!-- Center Overlay Icon -->
                                            <button class="btn btn-light rounded-circle shadow position-absolute top-50 start-50 translate-middle"
                                                    style="color: #0d6efd; font-size: 1.5rem; z-index: 20;"
                                                    onclick="openCustomImageModal('{{ asset($uploadData->file_path) }}', '{{ addslashes($uploadData->projectSubmit?->designer?->name ?? 'File') }}')">
                                                <i class="bi bi-arrows-fullscreen"></i>
                                            </button>
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


            <div class="form-section">
                <h4 class="mb-3"><i class="bi bi-upload me-2 text-success"></i>Upload Original File</h4>
                <form action="{{ route('designer.order.submit',$selectedImages[0]->project_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="upload-box" id="drop-area">
                        <p>
                            <i class="bi bi-cloud-arrow-up text-primary me-2"></i>
                            Drop your files here or
                            <a href="#" onclick="document.getElementById('design_file').click();return false;">click to upload</a>
                        </p>
                        <small>We accept PNG, JPG, JPEG, GIF, ZIP</small>
                        <input type="file" name="design_file[]" id="design_file"
                               class="d-none" accept=".png,.jpg,.jpeg,.gif,.zip" multiple>
                        <div id="preview" class="d-flex flex-wrap mt-3"></div>
                        @error('design_file.*')
                        <span class="text-danger d-block mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" required>
                        <label class="form-check-label">
                            Yes, I understand and accept <a href="{{ route('submission-guidelines') }}" target="_blank">submission guidelines</a>.
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">
                        <i class="bi bi-send-check me-1"></i> SUBMIT ORDER
                    </button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const dropArea = document.getElementById('drop-area');
        const inputFile = document.getElementById('design_file');
        const preview = document.getElementById('preview');

        let filesArray = [];

        // File dragover
        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('border-primary');
        });

        // File dragleave
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('border-primary');
        });

        // Drop files
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('border-primary');
            handleFiles(e.dataTransfer.files);
        });

        // Input file change
        inputFile.addEventListener('change', () => {
            handleFiles(inputFile.files);
        });

        function handleFiles(files) {
            [...files].forEach(file => {
                if (validateFile(file)) {
                    filesArray.push(file);
                }
            });
            updatePreview();
        }

        function validateFile(file) {
            // File type check only, no size limit
            const validTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'application/zip'];

            // Zip detection sometimes comes as 'application/x-zip-compressed' বা 'application/octet-stream'
            if(file.name.toLowerCase().endsWith('.zip')) {
                return true;
            }

            if (!validTypes.includes(file.type)) {
                alert(`${file.name} is not a valid file type`);
                return false;
            }

            return true;
        }

        function updatePreview() {
            preview.innerHTML = '';
            filesArray.forEach((file, index) => {
                const div = document.createElement('div');
                div.classList.add('position-relative', 'm-2');
                div.style.width = "120px";

                // Image file
                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        div.innerHTML = `
                    <img src="${e.target.result}" class="img-thumbnail" style="height:100px; object-fit:cover;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" data-index="${index}">&times;</button>
                `;
                        preview.appendChild(div);

                        div.querySelector('button').addEventListener('click', () => {
                            filesArray.splice(index, 1);
                            updatePreview();
                        });
                    };
                    reader.readAsDataURL(file);

                    // ZIP file
                } else if (file.name.toLowerCase().endsWith(".zip")) {
                    div.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center border rounded bg-light" style="height:100px;">
                    <i class="fa fa-file-archive fa-2x text-warning"></i>
                    <small class="text-truncate" style="max-width:90px;">${file.name}</small>
                </div>
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" data-index="${index}">&times;</button>
            `;
                    preview.appendChild(div);

                    div.querySelector('button').addEventListener('click', () => {
                        filesArray.splice(index, 1);
                        updatePreview();
                    });

                    // Unsupported file
                } else {
                    div.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center border rounded bg-light text-danger" style="height:100px;">
                    <i class="fa fa-times-circle fa-2x"></i>
                    <small>Unsupported</small>
                </div>
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" data-index="${index}">&times;</button>
            `;
                    preview.appendChild(div);

                    div.querySelector('button').addEventListener('click', () => {
                        filesArray.splice(index, 1);
                        updatePreview();
                    });
                }
            });

            // Update input files for form submission
            const dataTransfer = new DataTransfer();
            filesArray.forEach(f => dataTransfer.items.add(f));
            inputFile.files = dataTransfer.files;
        }
    </script>
    <!-- Fullscreen Custom popup matching imageDetails zoom -->
    <div id="customImagePopup" class="image-popup p-0 m-0">
        <span class="popup-close" onclick="closeCustomImageModal()"><i class="fa fa-times"></i></span>

        <div class="popup-content-wrapper">
            <div class="popup-image-container">
                <img id="popupImageElement" src="" alt="Preview" class="popup-image" oncontextmenu="return false" draggable="false">
                <!-- No watermark here as requested -->
            </div>

            <div class="popup-footer">
                <div class="brand">chobidokan</div>
                <div class="image-id">
                    <span id="popupSubmitterName" style="color: #ffffff; font-weight: bold;"></span><br>
                    <span style="color: #9ba0a9; font-weight: normal;">www.chobidokan.com</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openCustomImageModal(imageSrc, submitterName) {
            document.getElementById('popupImageElement').src = imageSrc;
            document.getElementById('popupSubmitterName').innerText = submitterName && submitterName !== 'File' ? 'Project: ' + submitterName : '';
            
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
