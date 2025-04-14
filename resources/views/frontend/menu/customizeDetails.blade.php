@extends('includes.master')
@section('content')

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<div class="section">
    <div class="container" style="margin-top: 5rem;">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <div class="row">
            <div class="col-md-8">

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Request Title</h5>
                        <hr>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer. (This is the short description)</p>
                        <p class="card-text"><small class="text-muted">Posted On: 12-12-2025</small></p>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <!-- Image at the top -->
                                    <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" alt="Request Image" class="img-fluid mb-1 rounded">
                                </div>

                                <!-- Card footer with designer name and post date -->
                                <div class="card-footer d-flex justify-content-between bg-white border-top">
                                    <small class="text-muted">👤 <a href="{{ route('designer-profile') }}">John Doe</a></small>
                                    <small class="text-muted">📅 12-12-2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <!-- Image at the top -->
                                    <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" alt="Request Image" class="img-fluid mb-1 rounded">
                                </div>

                                <!-- Card footer with designer name and post date -->
                                <div class="card-footer d-flex justify-content-between bg-white border-top">
                                    <small class="text-muted">👤 John Doe</small>
                                    <small class="text-muted">📅 12-12-2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <!-- Image at the top -->
                                    <img src="https://cdn.pixabay.com/photo/2014/08/11/11/50/moon-415501_1280.jpg" alt="Request Image" class="img-fluid mb-1 rounded">
                                </div>

                                <!-- Card footer with designer name and post date -->
                                <div class="card-footer d-flex justify-content-between bg-white border-top">
                                    <small class="text-muted">👤 John Doe</small>
                                    <small class="text-muted">📅 12-12-2025</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- right nav --}}
            <div class="col-12 col-md-4">

                <div class="card">
                    <div class="card-body">
                        <h5>Statistics</h5>
                        <hr />
                        <div class="d-flex flex-column gap-1">
                            <span><b>Budget:</b> 40 Dollars</span>
                            <span><b>Time:</b> 5 Days</span>
                            <span><b>Total Designers:</b> 20 designers</span>
                            <span><b>Total Designs:</b> 50 designs</span>
                        </div>
                    </div>
                </div>
                <br />
                <div class="card">
                    <div class="card-body">
                        <h5>References</h5>
                        <hr />
                        <div class="d-flex flex-column gap-1">
                            <span>Reference 1: ABCD</span>
                            <span>Reference 2: EFGH</span>
                            <span>Reference 3: IJKL</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection
