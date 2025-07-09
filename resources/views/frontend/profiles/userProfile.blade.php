@extends('includes.master')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<style>
    .profile-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
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

</style>

<section style="margin-top: 4rem;">
    <div class="container">
        <div class="row">
            <!-- Left Panel -->
            <div class="col-md-4 left-section text-center">
                <img src="{{ asset('frontend_assets/img/team/team-1.jpg') }}" class="profile-img mb-3" alt="User Image" />
                <h4>John Doe</h4>
                <p>Email: john.doe@example.com</p>
                <p>Phone: +880123456789</p>

                <!-- Tabs below basic info -->
                <ul class="nav nav-tabs flex-column mt-4" id="profileTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="statistics-tab" data-toggle="tab" href="#statistics" role="tab">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#submittedworks" role="tab">Submitted Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab">Log Out</a>
                    </li>
                </ul>
            </div>

            <!-- Right Panel -->
            <div class="col-md-8">
                <!-- Tab Content -->
                <div class="tab-content pt-2" id="profileTabsContent">
                    <div class="tab-pane fade show active" id="about" role="tabpanel">
                        <h5>About Me</h5>
                        <hr />
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec
                            ut mauris eget lorem malesuada fermentum.
                        </p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Full Name</th>
                                    <td>John Doe</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>john@example.com</td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone</th>
                                    <td>+880123456789</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- edit button -->
                        <a href="" class="btn btn-sm btn-success">Edit Profile</a>
                    </div>

                    <!-- 1st tab -->
                    <div class="tab-pane fade" id="statistics" role="tabpanel">
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
                                <div class="col-md-6 mb-2">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('frontend_assets/img/about.jpg') }}" alt="Bologna" />
                                        <div class="card-body">
                                            <h4 class="card-title">Design 1</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                12/04/2024 | Dhaka, Bangladesh
                                            </h6>
                                            <a href="#" class="card-link btn-sm btn-success">Read More</a>
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
