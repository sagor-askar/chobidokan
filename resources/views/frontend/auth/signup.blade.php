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
                <form>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" placeholder="Full Name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Your Address">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control" id="phone" placeholder="Phone No.">
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
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Email Address">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="text-muted">Forgot password?</a>
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
@endsection
