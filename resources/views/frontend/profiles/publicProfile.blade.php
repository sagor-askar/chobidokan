@extends('includes.master')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<style>
    .profile-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
    }

    .left-section {
        border-right: 2px solid #dee2e6;
        background-color: #f2f2f2;
        padding: 10px;
    }

    .nav-tabs .nav-link {
        border: none;
        border-bottom: 2px solid transparent;
    }

    .nav-tabs .nav-link.active {
        border-bottom: 1px solid #007bff;
        font-weight: bold;
    }

    /* counter card */
    .card-counter {
        box-shadow: 2px 2px 10px #dadada;
        margin: 5px;
        padding: 20px 10px;
        background-color: #fff;
        height: 100px;
        border-radius: 5px;
        transition: 0.3s linear all;
    }

    .card-counter:hover {
        box-shadow: 4px 4px 20px #dadada;
        transition: 0.3s linear all;
    }

    .card-counter.primary {
        background-color: #007bff;
        color: #fff;
    }

    .card-counter.danger {
        background-color: #ef5350;
        color: #fff;
    }

    .card-counter.success {
        background-color: #66bb6a;
        color: #fff;
    }

    .card-counter.info {
        background-color: #26c6da;
        color: #fff;
    }

    .card-counter i {
        font-size: 5em;
        opacity: 0.2;
    }

    .card-counter .count-numbers {
        position: absolute;
        right: 35px;
        top: 20px;
        font-size: 32px;
        display: block;
    }

    .card-counter .count-name {
        position: absolute;
        right: 35px;
        top: 65px;
        font-style: italic;
        text-transform: capitalize;
        opacity: 0.5;
        display: block;
        font-size: 18px;
    }
    .card-title {
        font-size: 18px;
    }
    .card-subtitle {
        font-size: 15px;
    } 
    .card-body {
        padding: 7px;
    }

</style>

<section style="margin-top: 4rem;">
    <div class="container">
        <div class="row">
            <!-- Left Panel -->
            <div class="col-md-2 left-section text-center">
                <img src="{{ asset($user->image ?? 'frontend_assets/img/team/team-1.jpg') }}" class="profile-img mb-3" alt="User Image" />
                <h4>User Name</h4>

                <!-- Tabs below basic info -->
                <ul class="nav nav-tabs flex-column mt-2" id="profileTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="statistics-tab" data-toggle="tab" href="#statistics" role="tab">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#submittedworks" role="tab">Submitted Works</a>
                    </li>
                </ul>
            </div>

            <!-- Right Panel -->
            <div class="col-md-10">
                <!-- Tab Content -->
                <div class="tab-content pt-2" id="profileTabsContent">

                    <!-- 1st tab -->
                    <div class="tab-pane fade show active" id="statistics" role="tabpanel">
                        <h5>Statistics</h5>
                        <hr />
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card-counter primary">
                                        <i class="fa fa-code-fork"></i>
                                        <span class="count-numbers">12</span>
                                        <span class="count-name">Flowz</span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card-counter danger">
                                        <i class="fa fa-ticket"></i>
                                        <span class="count-numbers">599</span>
                                        <span class="count-name">Instances</span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card-counter success">
                                        <i class="fa fa-database"></i>
                                        <span class="count-numbers">6875</span>
                                        <span class="count-name">Data</span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card-counter info">
                                        <i class="fa fa-users"></i>
                                        <span class="count-numbers">35</span>
                                        <span class="count-name">Users</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 2nd tab -->
                    <div class="tab-pane fade" id="submittedworks" role="tabpanel">
                        <h5>Submitted Works</h5>
                        <hr />
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('frontend_assets/img/about.jpg') }}" alt="Bologna" />
                                        <div class="card-body">
                                            <h4 class="card-title">Design 1</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                12/04/2024
                                            </h6>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('frontend_assets/img/about.jpg') }}" alt="Bologna" />
                                        <div class="card-body">
                                            <h4 class="card-title">Design 2</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                12/04/2024
                                            </h6>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('frontend_assets/img/about.jpg') }}" alt="Bologna" />
                                        <div class="card-body">
                                            <h4 class="card-title">Design 3</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                12/04/2025
                                            </h6>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('frontend_assets/img/about.jpg') }}" alt="Bologna" />
                                        <div class="card-body">
                                            <h4 class="card-title">Design 4</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                12/04/2024
                                            </h6>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('frontend_assets/img/about.jpg') }}" alt="Bologna" />
                                        <div class="card-body">
                                            <h4 class="card-title">Design 5</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                12/04/2024
                                            </h6>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('frontend_assets/img/about.jpg') }}" alt="Bologna" />
                                        <div class="card-body">
                                            <h4 class="card-title">Design 6</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                12/04/2025
                                            </h6>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('frontend_assets/img/about.jpg') }}" alt="Bologna" />
                                        <div class="card-body">
                                            <h4 class="card-title">Design 7</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                12/04/2024
                                            </h6>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS + jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
