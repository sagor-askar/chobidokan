@extends('includes.master')
@section('content')

<style>
    /* this is custom css, no need to copy this into main css file */
    .form-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: auto;
        margin: 3vh;
    }

    .form-container {
        width: auto;
        background-color: white;
        padding: 3rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, .2);
        margin-top: 6vw;
    }

    .carousel .inner {
        overflow: hidden;
    }

    .carousel .inner .sub-forms {
        display: flex;
        transform: translateX(0);
        transition: all .5s ease;
    }

    .carousel .inner .sub-forms .sub-form {
        flex-basis: 100%;
        flex-shrink: 0;
        padding: .5rem;
    }

</style>

<div class="form-wrapper">
    <div class="form-container">
        <form class="form">
            <h2 class="form-title text-center mb-4">Seller Registration to ChobiDokan</h2>
            <div class="carousel">
                <div class="inner">
                    <div class="sub-forms">
                        {{-- 1st form --}}
                        <div class="sub-form" data-index="0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="fullname">Full Name</label>
                                        <input type="text" class="form-control" id="fullname" placeholder="Full Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="number" class="form-control" id="phone" placeholder="Phone No.">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email Address">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Username">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-1 gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="">
                                    <label class="form-check-label" for="">I am a Customer</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="">
                                    <label class="form-check-label" for="">I am a Seller</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="">
                                    <label class="form-check-label" for="">By proceding, you accept our
                                        <a href="{{ route('terms-of-use') }}">Terms & Conditions</a></label>
                                </div>
                            </div>

                            <p class="text-muted mt-1">
                                Already have an account? <a href="{{ route('seller-login') }}">Login</a>
                            </p>

                        </div>

                        {{-- 2nd form --}}
                        <div class="sub-form" data-index="1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="bank_name">Bank Name</label>
                                        <input type="text" class="form-control" id="bank_name" placeholder="Bank Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="account_no">Account No.</label>
                                        <input type="number" class="form-control" id="account_no" placeholder="Account No">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="bkash">bKash No.</label>
                                        <input type="number" class="form-control" id="bkash" placeholder="bKash No.">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="rocket">Rocket No.</label>
                                        <input type="number" class="form-control" id="rocket" placeholder="Rocket No.">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nagad">Nagad No.</label>
                                        <input type="number" class="form-control" id="nagad" placeholder="Nagad No.">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="upay">Upay No.</label>
                                        <input type="number" class="form-control" id="upay" placeholder="Upay No.">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="form-actions mt-1">
                <button id="prev" class="btn btn-secondary d-none">Previous</button>
                <button id="next" class="btn btn-primary">Next</button>
            </div>

        </form>
    </div>
</div>

<script>
    const subForms = document.querySelectorAll(".sub-form");
    const indicators = document.querySelectorAll(".step-indicator");
    const subFormsWrapper = document.querySelector(".sub-forms");
    let index = 0;

    document.getElementById("next").addEventListener("click", (e) => {
        e.preventDefault();
        if (index < subForms.length - 1) {
            index++;
            updateForm();
        }
    });

    document.getElementById("prev").addEventListener("click", (e) => {
        e.preventDefault();
        if (index > 0) {
            index--;
            updateForm();
        }
    });

    function updateForm() {
        subFormsWrapper.style.transform = `translateX(${-index * 100}%)`;
        indicators.forEach((btn, i) => btn.classList.toggle("active", i === index));
        document.getElementById("prev").classList.toggle("d-none", index === 0);
        document.getElementById("next").innerText = index === subForms.length - 1 ? "Submit" : "Next";
    }

</script>

@endsection
