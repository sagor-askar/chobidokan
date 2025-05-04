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
                    <h3 class="fw-bold mb-3">Seller Login to ChobiDokan</h3>
                </div>
                <form method="POST" action="{{ route('customLogin') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block w-100">Login</button>

                    <p class="text-center text-muted mt-3">
                        Don't have an account? <a href="{{ route('seller-registration') }}">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
