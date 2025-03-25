@extends('includes.master')
@section('content')
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
    </style>

    <main class="main">
        <section class="login-container">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="text-center">
                        <h3 class="fw-bold mb-3">Login to ChobiDokan</h3>
                    </div>
                    <form>
                        <div class="form-group mb-3">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <a href="#" class="text-muted">Forgot password?</a>
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
@endsection
