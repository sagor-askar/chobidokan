@extends('includes.master')
@section('content')
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 10px;
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
        <div class="col-md-5">
            <div class="card p-4">
                <div class="text-center">
                    <h3 class="fw-bold mb-3">Login to ChobiDokan</h3>
                </div>
                <form method="POST" action="{{ route('customLogin') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
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

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block w-100">Login</button>

                    <p class="text-center text-muted mt-3">
                        Don't have an account? <a href="{{ route('signup') }}">Register</a>
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
