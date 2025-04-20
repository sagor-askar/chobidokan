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

                    <p><strong>Name:</strong><br>Looking for a graphic designer to design a brochure-like introduction of our real estate business</p>
                    <p><strong>Description:</strong><br>AL QASR PROPERTIES LTD. is a new real estate investment business that is just starting. We are looking for the best graphic design to present the company...</p>
                    <p><strong>Deadline:</strong><br>19 Apr 2025 03:37:57 UTC</p>
                    <p><strong>Budget:</strong><br>US$110</p>

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

                    <form>
                        <div class="upload-box">
                            <p>Drop your files here or <a href="#">click to upload</a></p>
                            <small>We accept 5 file(s) up to 15MB and 5000x5000 pixels of type *PNG, *JPG, *JPEG, *GIF</small>
                        </div>

                        <div class="form-group">
                            <label for="title">Design title *</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter title or description">
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="tags">Design tags</label>
                            <input type="text" class="form-control" id="tags" placeholder="Tags help your design be found">
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Portfolio visibility</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="visibility" id="visibilityYes" value="yes">
                                        <label class="form-check-label" for="visibilityYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="visibility" id="visibilityNo" value="no">
                                        <label class="form-check-label" for="visibilityNo">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stock usage *</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="stock" id="stockYes" value="yes">
                                        <label class="form-check-label" for="stockYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="stock" id="stockNo" value="no">
                                        <label class="form-check-label" for="stockNo">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="border p-3 bg-light">
                                <p><strong>Your submission must adhere to the following guidelines:</strong></p>
                                <ul>
                                    <li>Submissions must not be blank or placeholder designs.</li>
                                    <li>Submissions must follow the project's brief.</li>
                                    <li>Must adhere to DesignCrowd’s User Agreement and Quality Standards.</li>
                                    <li>All work must be original and owned by you.</li>
                                    <li>No soliciting work off DesignCrowd.</li>
                                </ul>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="agree">
                                <label class="form-check-label" for="agree">Yes, I understand and accept that my submission meets this criteria.</label>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-sm btn-primary btn-block text-center">SUBMIT & UPLOAD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


@endsection
