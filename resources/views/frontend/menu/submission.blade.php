@extends('includes.master')
@section('content')
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

<div class="section mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-section">
                    <h4><strong>Project summary</strong></h4>

                    <p><strong>Name:</strong><br>{{$project->name}}</p>
                    <p><strong>Description:</strong><br>{!! $project->project_description !!}</p>
                    <p><strong>Deadline:</strong><br>{{\Carbon\Carbon::parse($project->expire_date)->format('d-M-Y')}}</p>
                    <p><strong>Budget:</strong><br> {{$project->order?->amount}} Tk</p>

                    <h5><strong>Design guidelines</strong></h5>
                    <ul>
                        <li>Read and follow the full list of <a href="{{ route('submission-guidelines') }}">submission guidelines</a></li>
                        <li>Max file size 15MB, Max 5 files per upload</li>
                        <li>File types: *PNG, *JPG, *JPEG, *GIF</li>
                        <li>Max pixel size: 5000px x 5000px</li>
                        <li>Use a transparent or white background</li>
                        <li>Ensure your artwork is crisp</li>
                        <li>Show one design in each image</li>
                    </ul>
                    <a href="{{ route('submission-guidelines') }}">VIEW FULL LIST OF GUIDELINES</a>
                </div>
            </div>

            <div class="col-md-8">
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
                                   class="d-none" accept=".png,.jpg,.jpeg,.gif" multiple>

                            <small>We accept up to 15MB (PNG, JPG, JPEG, GIF)</small>

                            <div id="preview" class="d-flex flex-wrap mt-3"></div>

                            @error('design_file.*')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group mt-3">
                            <label for="title">Design title *</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter title or description">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="tags">Design tags</label>
                            <input type="text" class="form-control" name="tags" value="{{ old('tags') }}" placeholder="Tags help your design be found">
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Portfolio visibility</label><br>
                                <input type="radio" name="visibility" value="1" {{ old('visibility') == '1' ? 'checked' : '' }}> Yes
                                <input type="radio" name="visibility" value="0" {{ old('visibility') == '0' ? 'checked' : '' }}> No
                            </div>

                            <div class="col-md-6">
                                <label>Stock usage *</label><br>
                                <input type="radio" name="stock" value="1" {{ old('stock') == '1' ? 'checked' : '' }}> Yes
                                <input type="radio" name="stock" value="0" {{ old('stock') == '0' ? 'checked' : '' }}> No
                            </div>
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

                        <button type="submit" class="btn btn-sm btn-primary btn-block mt-3">SUBMIT & UPLOAD</button>
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
        const validTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];
        const maxSize = 15 * 1024 * 1024; // 15MB
        if (!validTypes.includes(file.type)) {
            alert(`${file.name} is not a valid file type`);
            return false;
        }
        if (file.size > maxSize) {
            alert(`${file.name} exceeds 15MB`);
            return false;
        }
        return true;
    }

    function updatePreview() {
        preview.innerHTML = '';
        filesArray.forEach((file, index) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onloadend = () => {
                const div = document.createElement('div');
                div.classList.add('position-relative', 'm-2');
                div.style.width = "120px";

                div.innerHTML = `
                    <img src="${reader.result}" class="img-thumbnail" style="height:100px; object-fit:cover;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" data-index="${index}">&times;</button>
                `;
                preview.appendChild(div);

                // Remove button
                div.querySelector('button').addEventListener('click', (e) => {
                    filesArray.splice(index, 1);
                    updatePreview();
                });
            };
        });

        // Update input files for form submission
        const dataTransfer = new DataTransfer();
        filesArray.forEach(f => dataTransfer.items.add(f));
        inputFile.files = dataTransfer.files;
    }
</script>




@endsection
