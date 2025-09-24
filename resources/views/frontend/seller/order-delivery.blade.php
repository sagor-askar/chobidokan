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
            border: 2px dashed #ccc;
            border-radius: 10px;
            text-align: center;
            padding: 30px;
            margin-bottom: 20px;
            color: #6c757d;
        }

        .upload-box:hover {
            background-color: #f1f1f1;
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
                    <h4>Upload Design File</h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{route('job.submit',$project->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-box border p-3 text-center"
                             id="drop-area"
                             style="cursor: pointer; background: #f8f9fa;">

                            <p>
                                Drop your files here or
                                <a href="#" onclick="document.getElementById('design_file').click();return false;">
                                    click to upload
                                </a>
                            </p>

                            <input type="file" name="design_file[]" id="design_file"
                                   class="d-none" accept=".png,.jpg,.jpeg,.gif,.zip" multiple>

                            <small>We accept PNG, JPG, JPEG, GIF, ZIP</small>

                            <div id="preview" class="d-flex flex-wrap mt-3"></div>

                            @error('design_file.*')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <div class="border p-3 bg-light">
                                <p><strong>Your submission must adhere to the following guidelines:</strong></p>
                                <ul>
                                    <li>Submissions must not be blank or placeholder designs.</li>
                                    <li>Submissions must follow the project's brief.</li>
                                    <li>Must adhere to User Agreement and Quality Standards.</li>
                                    <li>All work must be original and owned by you.</li>
                                </ul>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input"  required>
                                <label class="form-check-label">Yes, I understand and accept <a href="{{ route('submission-guidelines') }}">submission guidelines</a>.</label>
                                @error('agree') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary btn-block mt-3">SUBMIT ORDER</button>
                    </form>
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
    @endsection
