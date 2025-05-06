@extends('includes.master')
@section('content')
{{-- custom css --}}
<style>
    #progressbar {
        padding: 0;
        margin-bottom: 20px;
        list-style: none;
        display: flex;
        justify-content: space-between;
    }

    #progressbar li {
        width: 25%;
        position: relative;
        text-align: center;
        font-size: 14px;
        color: lightgrey;
    }

    #progressbar .active {
        color: black;
        font-weight: bold;
    }

    fieldset {
        display: none;
        animation: fadeIn 0.5s ease-in-out;
    }

    fieldset:first-of-type {
        display: block;
    }

    .headerTop {
        margin-top: 1.5rem;
        margin-bottom: 2rem;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* design type */
    .design-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 100%;
        text-align: center;
    }

    .design-card.selected {
        border: 2px solid #007bff;
        background-color: #e9f5ff;
        position: relative;
    }

    .design-card.selected::after {
        content: "✔";
        color: #007bff;
        font-size: 24px;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .design-card img {
        width: 50px;
        height: 50px;
        margin-bottom: 10px;
    }

</style>

<section class="mt-5">
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <form id="multiStepForm">

                    {{-- top level --}}
                    <!-- Progress Bar Visual -->
                    <div class="progress mb-4" style="height: 20px;">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%;">
                            Step 1 of 4
                        </div>
                    </div>

                    <!-- Step Labels -->
                    <ul id="progressbar" class="text-center mb-4">
                        <li class="active" id="project"><strong>Project Details</strong></li>
                        <li id="brief"><strong>Creative Brief</strong></li>
                        <li id="design"><strong>Design Options</strong></li>
                        <li id="payment"><strong>Payment Options</strong></li>
                    </ul>

                    <!-- Step 1: Project Details -->
                    <fieldset class="m-3 mb-3">
                        <div class="text-center headerTop">
                            <h4>What design do you need?</h4>
                            <h5>Select the type of design you need designed</h5>
                        </div>

                        <div class="row g-3">

                            <div class="col-md-3">
                                <div class="design-card" onclick="selectCard(this)">
                                    <img src="{{ asset('frontend_assets/img/requests/logo-design.png') }}" alt="Logo Design">
                                    <h5 class="mt-2">Logo Design</h5>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="design-card" onclick="selectCard(this)">
                                    <img src="{{ asset('frontend_assets/img/requests/code.png') }}" alt="Web Design">
                                    <h5 class="mt-2">Web Design</h5>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="design-card" onclick="selectCard(this)">
                                    <img src="{{ asset('frontend_assets/img/requests/t-shirt.png') }}" alt="T-Shirt">
                                    <h5 class="mt-2">T-Shirt Design</h5>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="design-card" onclick="selectCard(this)">
                                    <img src="{{ asset('frontend_assets/img/requests/flyer.png') }}" alt="Flyer">
                                    <h5 class="mt-2">Flyer Design</h5>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="design-card" onclick="selectCard(this)">
                                    <img src="{{ asset('frontend_assets/img/requests/business-card-design.png') }}" alt="Business Card">
                                    <h5 class="mt-2">Business Card Design</h5>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="design-card" onclick="selectCard(this)">
                                    <img src="{{ asset('frontend_assets/img/requests/stationary.png') }}" alt="Stationery">
                                    <h5 class="mt-2">Stationery Design</h5>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="design-card" onclick="selectCard(this)">
                                    <img src="{{ asset('frontend_assets/img/requests/graphic.png') }}" alt="Graphic">
                                    <h5 class="mt-2">Graphic Design</h5>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="design-card" onclick="selectCard(this)">
                                    <img src="{{ asset('frontend_assets/img/requests/else.png') }}" alt="Other">
                                    <h5 class="mt-2">Something else?</h5>
                                </div>
                            </div>

                        </div>

                        <button type="button" class="mt-2 next btn btn-primary">Next</button>
                    </fieldset>

                    <!-- Step 2: Creative Brief -->
                    <fieldset class="m-3 mb-3">
                        <div class="text-center headerTop">
                            <h4>Describe the Design You Need</h4>
                            <h5>Let's get started with some basic information about your project</h5>
                        </div>

                        <div class="row g-3">
                            <div class="mb-3">
                                <label for="">Project Name</label>
                                <input class="form-control" type="text" placeholder="Name of Your Project">
                            </div>
                            <div class="mb-3">
                                <label>Project Description</label>
                                <textarea class="form-control required" name="project_description" rows="4" placeholder="Tell us a bit about your requirements"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Logo Text</label>
                                <input type="text" class="form-control" name="logo_text" placeholder="Tell us about the logo">
                            </div>
                            <div class="mb-3">
                                <label>Upload files (Optional)</label>
                                <input type="file" class="form-control" name="attached_files">
                            </div>
                        </div>


                        <button type="button" class="previous btn btn-secondary">Previous</button>
                        <button type="button" class="next btn btn-primary">Next</button>
                    </fieldset>

                    <!-- Step 3: Design Options -->
                    <fieldset class="m-3 mb-3">
                        <div class="text-center headerTop">
                            <h4>Which package do you prefer?</h4>
                            <h5>Choose a package that will get the results you desire</h5>
                        </div>

                        <div class="row g-3">
                            <section id="pricing">

                                <div class="row">
                                    <div class="pricing-column col-lg-4 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Basic</h3>
                                            </div>
                                            <div class="card-body">
                                                <h2>৳ 10</h2>
                                                <p>3 Designers</p>
                                                <p>Expect 6+ Designs</p>
                                                <p>Unlimited Revisions</p>
                                                <p>Money Back Guarantee</p>
                                                <p>Industry Standard Files</p>
                                                <button class="btn btn-sm btn-block btn-dark" type="button">Select</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pricing-column col-lg-4 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Standard</h3>
                                            </div>
                                            <div class="card-body">
                                                <h2>৳ 20</h2>
                                                <p>Unlimited Designers</p>
                                                <p>Expect 50+ Designs</p>
                                                <p>Unlimited Revisions</p>
                                                <p>Money Back Guarantee</p>
                                                <p>Industry Standard Files</p>
                                                <button class="btn btn-sm btn-block btn-dark" type="button">Select</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pricing-column col-lg-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Premium</h3>
                                            </div>
                                            <div class="card-body">
                                                <h2>৳ 30</h2>
                                                <p>Unlimited Designers</p>
                                                <p>Expect 100+ Designs</p>
                                                <p>Unlimited Revisions</p>
                                                <p>Money Back Guarantee</p>
                                                <p>Industry Standard Files</p>
                                                <button class="btn btn-sm btn-block btn-dark" type="button">Select</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </section>
                        </div>

                        <button type="button" class="previous btn btn-secondary">Previous</button>
                        <button type="button" class="next btn btn-primary">Next</button>
                    </fieldset>

                    <!-- Step 4: Payment Options -->
                    <fieldset class="m-3 mb-3">
                        <div class="text-center headerTop">
                            <h4>Confirm Project Details</h4>
                            <h5>Review your project details below</h5>
                        </div>

                        <div class="container mt-5">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <table class="table text-center">
                                        <tbody>
                                            <tr>
                                                <th class="text-start">Name</th>
                                                <td class="text-start">display the project name here</td>
                                            </tr>
                                            <tr>
                                                <th class="text-start">Design Required</th>
                                                <td class="text-start">Logo</td>
                                            </tr>
                                            <tr>
                                                <th class="text-start">Project Cost</th>
                                                <td class="text-start">$20</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="text-center headerTop">
                            <h4>Payment Method</h4>
                            <h5>Select a payment option to continue</h5>
                        </div>


                        <div class="row">
                            <!-- Payment Form -->
                            <div class="col-md-8">
                                <div class="card p-4">
                                    <div class="form-group">

                                        {{-- cards images will be displayed here --}}
                                        <div class="mb-3">
                                            <img src="{{ asset('frontend_assets/payments/bkash.jpg') }}" alt="Cards" class="img-fluid" style="max-height: 4rem;">
                                            <img src="{{ asset('frontend_assets/payments/rocket.jpg') }}" alt="Cards" class="img-fluid" style="max-height: 4rem;">
                                            <img src="{{ asset('frontend_assets/payments/nagad.jpg') }}" alt="Cards" class="img-fluid" style="max-height: 4rem;">
                                            <img src="{{ asset('frontend_assets/payments/upay.jpg') }}" alt="Cards" class="img-fluid" style="max-height: 4rem;">
                                            <img src="{{ asset('frontend_assets/payments/tap.jpg') }}" alt="Cards" class="img-fluid" style="max-height: 4rem;">
                                            <img src="{{ asset('frontend_assets/payments/wallet.jpg') }}" alt="Cards" class="img-fluid" style="max-height: 4rem;">
                                            <img src="{{ asset('frontend_assets/payments/dbbl.jpg') }}" alt="Cards" class="img-fluid" style="max-height: 4rem;">
                                            <img src="{{ asset('frontend_assets/payments/master_card.jpg') }}" alt="Cards" class="img-fluid" style="max-height: 4rem;">
                                            <img src="{{ asset('frontend_assets/payments/visa.jpg') }}" alt="Cards" class="img-fluid" style="max-height: 4rem;">

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>Card Number</label>
                                                <input type="text" class="form-control" placeholder="Your credit card number">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Expiry Date</label>
                                                <input type="text" class="form-control" placeholder="mm / yy">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>CVV</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="CVV">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" data-toggle="tooltip" title="The 3 digits on the back of your card">?</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <button class="btn btn-primary btn-primary btn-block mt-4">SUBMIT PAYMENT</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Side Info -->
                            <div class="col-md-4">
                                <div class="text-center">
                                    <img src="{{ asset('frontend_assets/img/requests/money-back.jpg') }}" alt="Money Back Guarantee" class="img-fluid" style="max-height:10rem; width: auto;">
                                    <h6 class="mt-3">Money Back Guarantee</h6>
                                    <p class="small">Get the design you want or your money back. Conditions apply - <a href="#">see our refund policy</a>.</p>
                                </div>
                            </div>
                        </div>


                        <button type="button" class="mt-2 previous btn btn-secondary">Previous</button>
                        <button type="submit" class="mt-2 btn btn-success">Submit</button>
                    </fieldset>

                </form>
            </div>
        </div>
    </div>
</section>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JavaScript -->
<script>
    $(document).ready(function() {
        var currentStep = 0;
        var steps = $("fieldset");
        var totalSteps = steps.length;

        $(".next").click(function() {
            if (!validateFields()) return;

            $(steps[currentStep]).hide();
            currentStep++;
            $(steps[currentStep]).fadeIn();
            updateProgress();
        });

        $(".previous").click(function() {
            $(steps[currentStep]).hide();
            currentStep--;
            $(steps[currentStep]).fadeIn();
            updateProgress();
        });

        function updateProgress() {
            var items = $("#progressbar li");
            items.removeClass("active");
            for (var i = 0; i <= currentStep; i++) {
                $(items[i]).addClass("active");
            }
            var progress = ((currentStep + 1) / totalSteps) * 100;
            $("#progressBar")
                .css("width", progress + "%")
                .text("Step " + (currentStep + 1) + " of " + totalSteps);
        }

        function validateFields() {
            var isValid = true;
            $(steps[currentStep]).find(".required").each(function() {
                if ($(this).val().trim() === "") {
                    $(this).addClass("is-invalid");
                    isValid = false;
                } else {
                    $(this).removeClass("is-invalid");
                }
            });
            return isValid;
        }

        $("#multiStepForm").on('submit', function(e) {
            e.preventDefault();
            alert('Form submitted successfully!');
        });
    });

</script>

{{-- for design type cards --}}
<script>
    function selectCard(card) {
        // Remove "selected" class from all cards
        document.querySelectorAll('.design-card').forEach(function(c) {
            c.classList.remove('selected');
        });
        // Add "selected" to the clicked one
        card.classList.add('selected');
    }

</script>
@endsection
