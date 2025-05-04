@extends('includes.master')

@section('content')
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding-top: 7vw;
    }

    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
            padding-top: 15vw;
        }
    }

</style>

<main class="main">
    <section class="login-container">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="text-center">
                    <h3 class="fw-bold mb-3">Sign Up to ChobiDokan</h3>
                </div>
                <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" id="fullname" name="name"  placeholder="Full Name">

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
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                                @error('email')
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

                    <button type="submit" class="btn btn-primary btn-block w-100">Sign Up</button>

                    <p class="text-center text-muted mt-3">
                        Already have an account? <a href="{{ route('signin') }}">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


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
