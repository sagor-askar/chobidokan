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
        <form method="POST" action="{{ route('seller.register') }}" enctype="multipart/form-data">
            @csrf
            <h2 class="form-title text-center mb-4">Seller Registration to ChobiDokan</h2>
            <div class="carousel">
                <div class="inner">
                    <div class="sub-forms">
                        {{-- 1st form --}}
                        <div class="sub-form" data-index="0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="name" id="fullname" placeholder="Full Name" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Your Address">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                           </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <div class="form-group mp-3">
                                            <input type="password" placeholder="Password" id="password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror" required
                                                   autocomplete="new-password">
                                              <span class="position-absolute" onclick="togglePassword('password', 'togglePasswordIcon')"
                                                  style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                                                     <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                               </span>
                                             @error('password')
                                               <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone No.">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <div class="form-group pb-3">
                                            <input type="password" placeholder="Confirm Password" id="password_confirmation"
                                                   name="password_confirmation"
                                                   class="form-control @error('password_confirmation') is-invalid @enderror" required
                                                   autocomplete="new-password">
                                            <span class="position-absolute"
                                                  onclick="togglePassword('password_confirmation', 'toggleConfirmPasswordIcon')"
                                                  style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                                                  <i class="fa fa-eye" id="toggleConfirmPasswordIcon"></i>
                                           </span>
                                            @error('password_confirmation')
                                              <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sub-form" data-index="1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="bank_name" id="" placeholder="Bank Name">
                                        @error('bank_name')
                                        <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="branch_name" id="" placeholder="Branch Name">
                                        @error('branch_name')
                                        <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="account_holder_name" id="" placeholder="Account Holder Name">
                                        @error('account_holder_name')
                                        <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="number" class="form-control" name="account_number" id="account_no" placeholder="Account No">
                                        @error('account_number')
                                        <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="number" class="form-control" name="routing_no" id="" placeholder="Routing No.">
                                        @error('routing_no')
                                        <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="number" class="form-control" name="mobile_banking_no" id="" placeholder="Mobile Banking No.">
                                        @error('mobile_banking_no')
                                        <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <select class="form-control" id="account_type" name="account_type">
                                            <option value="" disabled selected>Select Payment Method</option>
                                            <option value="bkash">bKash</option>
                                            <option value="rocket">Rocket</option>
                                            <option value="rocket">Nagad</option>
                                            <option value="rocket">Upay</option>
                                        </select>
                                        @error('account_type')
                                        <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <input type="checkbox" class="form-check-input me-2" name="terms_conditiond" id="exampleCheck1" required>
                    <label class="form-check-label mb-0" for="exampleCheck1">
                        By signing up, you agree to our
                        <a href="{{ route('terms-of-use') }}"
                           style="color: orange; font-weight: bold;">
                            Terms and Conditions
                        </a>
                    </label>
                </div>
                <a href="{{ route('password.request') }}"  class="text-muted"> <b>Forgot password?</b></a>
            </div>
            <div class="form-actions mt-1">
                <button id="prev" class="btn btn-secondary d-none">Previous</button>
                <button id="next" class="btn btn-primary">Next</button>
            </div>
            <p class="text-muted mt-1">
                Already have an account? <a href="{{ route('seller-login') }}">Login</a>
            </p>

        </form>
    </div>
</div>

<script>
    const subForms = document.querySelectorAll(".sub-form");
    const subFormsWrapper = document.querySelector(".sub-forms");
    const nextBtn = document.getElementById("next");
    const prevBtn = document.getElementById("prev");
    let index = 0;

    nextBtn.addEventListener("click", (e) => {
        const currentForm = subForms[index];
        const inputs = currentForm.querySelectorAll("input, select");
        let valid = true;
        inputs.forEach((input) => {
            if (!input.checkValidity()) {
                input.classList.add("is-invalid");
                valid = false;
            } else {
                input.classList.remove("is-invalid");
            }
        });

        if (!valid) {
            e.preventDefault();
            return;
        }
        if (index < subForms.length - 1) {
            e.preventDefault();
            index++;
            updateForm();
        }
    });

    prevBtn.addEventListener("click", (e) => {
        e.preventDefault();
        if (index > 0) {
            index--;
            updateForm();
        }
    });

    function updateForm() {
        subFormsWrapper.style.transform = `translateX(${-index * 100}%)`;

        // Show or hide 'Previous' button
        prevBtn.classList.toggle("d-none", index === 0);

        // Change button text and type
        if (index === subForms.length - 1) {
            nextBtn.innerText = "Submit";
            nextBtn.type = "submit";
        } else {
            nextBtn.innerText = "Next";
            nextBtn.type = "button";
        }
    }
</script>


<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>

@endsection
