@extends('includes.master')
@section('content')
    <style>
        .list-group-item.active {
            background: #06C167 !important;
        }

        .bg-warning {
            background: #06C167 !important;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 4% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 70%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
            /*transform: translateY(-100%);*/
        }

        .close {
            float: right;
            text-align: right;
            font-size: 30px;
        }

        .modal-content h2 {
            text-align: center;
            margin-top: -35px;
        }

        .button_div {
            justify-content: center;
            text-align: center;
        }

        .button_div button {
            margin-right: 10px;
            background: #06C167;
            border: 1px solid #06C167;
            padding: 5px 15px;
            color: #FFFFFF;
            border-radius: 2px;
        }

        #addAddressForm input {
            padding: 5px;
        }

        .nice-select {
            padding: 0px !important;
            height: 38px !important;
            line-height: 38px !important;
        }

        .add_address_button {
            background: #06C167;
            border: 1px solid #06C167;
            padding: 5px 15px;
            color: #FFFFFF;
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .main_flex_div {
                display: flex;
                flex-direction: column;
            }

            .inner_flex_div {
                min-width: 100% !important;
            }

            .modal-content {
                padding: 10px 0px !important;
                min-width: 95% !important;
                height: 700px;
                overflow: scroll;
            }

            .close {
                margin-right: 10px;
            }
        }

        .list-group-item.active {
            background: #ffc107;
        }

        /* end common class */
        .top-status ul {
            list-style: none;
            display: flex;
            justify-content: space-around;
            justify-content: center;
            flex-wrap: wrap;
            padding: 0;
            margin: 0;
        }

        .top-status ul li {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            border: 8px solid #ddd;
            box-shadow: 1px 1px 10px 1px #ddd inset;
            margin: 10px 5px;
        }

        .top-status ul li.active {
            border-color: #06C167;
            box-shadow: 1px 1px 20px 1px #ffc107 inset;
        }

        /* end top status */

        ul.timeline {
            list-style-type: none;
            position: relative;
        }

        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }

        ul.timeline>li {
            margin: 20px 0;
            padding-left: 30px;
        }

        ul.timeline>li:before {
            content: '\2713';
            background: #fff;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 0;
            left: 5px;
            width: 50px;
            height: 50px;
            z-index: 400;
            text-align: center;
            line-height: 50px;
            color: #d4d9df;
            font-size: 24px;
            border: 2px solid var(--ogenix-primary);
        }

        ul.timeline>li.active:before {
            content: '\2713';
            background: #28a745;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 0;
            left: 5px;
            width: 50px;
            height: 50px;
            z-index: 400;
            text-align: center;
            line-height: 50px;
            color: #fff;
            font-size: 30px;
            border: 2px solid var(--ogenix-primary);
        }

        /* end timeline */
    </style>

    <section class="mt-5">
        <div class="container">
            <div class="main-body mt-5">
                <div class="row">
                    <!-- left side -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtbEsykx-0fhTred6UwHDYtMFd2UgTJCG4gaklT1dx4suRO4_n5LJr4Gg28kquSX5fpNo&usqp=CAU"
                                        alt="Admin" class="p-1" width="110">
                                    <div class="mt-3">
                                        <h4>Mr. Seller</h4>
                                        <p class="text-secondary mb-1">+91 7493658737</p>
                                        <p class="text-muted font-size-sm">Banani, Dhaka</p>
                                    </div>
                                </div>

                                {{-- Left side menu --}}
                                <div class="list-group list-group-flush text-center mt-4">
                                    <a href="#" class="list-group-item list-group-item-action border-0 active"
                                        onclick="showDashboard()">Dashboard</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"
                                        onclick="showEarning()">Earnings</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"
                                        onclick="showDownloads()">Downloads</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"
                                        onclick="showFiles()">Files</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"
                                        onclick="logout()">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- right side -->
                    <div class="col-lg-8">
                        <!-- Dashboard -->
                        <div id="dashboardSection" class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h5 class="mb-0">Welcome to the Seller Panel</h5>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a class="btn btn-sm btn-success" href="{{ route('designer-profile') }}">View Public
                                            Profile</a>
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <p><i class="fa fa-book" aria-hidden="true"></i> To make sure your resources are
                                        accepted, read first our
                                        <a href="">Guidlines.</a>
                                    </p>
                                    <p><i class="fa fa-upload" aria-hidden="true"></i> <a
                                            href="{{ route('uploads') }}">Upload</a> your 150-200 best resources
                                        only. Quality is a must: Let's see how amaxing you
                                        are.</p>
                                    <p><i class="fa fa-star" aria-hidden="true"></i> We believe in second chances, so you
                                        have two attempts to show your true potentials.
                                    </p>
                                </div>
                                <hr>
                                <div>
                                    <h5>Performance Overview</h5>
                                    <div class="container mt-2">
                                        <div class="row g-3">
                                            <!-- Earnings Card -->
                                            <div class="col-md-3">
                                                <div class="card p-3">
                                                    <h6 class="mb-1"><i class="fa fa-money" aria-hidden="true"></i>
                                                        Earnings</h6>
                                                    <p class="mb-0">100 TK</p>
                                                    <hr>
                                                    <div class="small-text mt-2">Last Month</div>
                                                    <p class="mb-0">1000 TK</p>
                                                </div>
                                            </div>

                                            <!-- Downloads Card -->
                                            <div class="col-md-3">
                                                <div class="card p-3">
                                                    <h6 class="mb-1"><i class="fa fa-download" aria-hidden="true"></i>
                                                        Downloads</h6>
                                                    <p class="mb-0">5000</p>
                                                    <hr>
                                                    <div class="small-text mt-2">Last Month</div>
                                                    <p class="mb-0">6500</p>
                                                </div>
                                            </div>

                                            <!-- Likes Card -->
                                            <div class="col-md-3">
                                                <div class="card p-3">
                                                    <h6 class="mb-1"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                        Likes</h6>
                                                    <p class="mb-0">105</p>
                                                    <hr>
                                                    <div class="small-text mt-2">Last Month</div>
                                                    <p class="mb-0">105</p>
                                                </div>
                                            </div>

                                            <!-- Files Card -->
                                            <div class="col-md-3">
                                                <div class="card p-3">
                                                    <h6 class="mb-1"><i class="fa fa-file" aria-hidden="true"></i> Files
                                                    </h6>
                                                    <p class="mb-0">405</p>
                                                    <hr>
                                                    <div class="small-text mt-2">Last Month</div>
                                                    <p class="mb-0">505</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings -->
                        <div id="earningsSection" class="card" style="display: none;">
                            <div class="card-body">
                                <h5 class="mb-0">Earnings</h5>
                                <hr>
                                <p>Your earnings details will be shown here.</p>
                            </div>
                        </div>

                        <!-- Downloads -->
                        <div id="downloadsSection" class="card" style="display: none;">
                            <div class="card-body">
                                <h5 class="mb-0">Downloads</h5>
                                <hr>
                                <p>Your downloaded files will be shown here.</p>
                            </div>
                        </div>

                        <!-- Files -->
                        <div id="filesSection" class="card" style="display: none;">
                            <div class="card-body">
                                <h5 class="mb-0">Files</h5>
                                <hr>
                                <p>Your files will be shown here.</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        function showDashboard() {
            hideAllSections();
            document.getElementById('dashboardSection').style.display = 'block';
            setActiveLink(0);
        }

        function showEarning() {
            hideAllSections();
            document.getElementById('earningsSection').style.display = 'block';
            setActiveLink(1);
        }

        function showDownloads() {
            hideAllSections();
            document.getElementById('downloadsSection').style.display = 'block';
            setActiveLink(2);
        }

        function showFiles() {
            hideAllSections();
            document.getElementById('filesSection').style.display = 'block';
            setActiveLink(3);
        }

        function logout() {
            alert('Logging out...');
            setActiveLink(4);
        }

        function hideAllSections() {
            document.getElementById('dashboardSection').style.display = 'none';
            document.getElementById('earningsSection').style.display = 'none';
            document.getElementById('downloadsSection').style.display = 'none';
            document.getElementById('filesSection').style.display = 'none';
        }

        function setActiveLink(index) {
            const links = document.querySelectorAll('.list-group-item');
            links.forEach(link => link.classList.remove('active'));
            links[index].classList.add('active');
        }

        // Show Dashboard by default
        showDashboard();
    </script>
@endsection
