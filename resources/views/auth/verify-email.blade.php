@extends('includes.master')

@section('content')
    <style>
        .chobidokan-verify {
            padding: 40px 15px;
            margin-top: 5rem;
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chobidokan-verify .verify-wrap {
            max-width: 500px;
            margin: 0 auto;
            width: 100%;
        }

        .chobidokan-verify .verify-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(15, 23, 42, 0.1);
            border: 1px solid #c2d4ec;
        }

        .chobidokan-verify .input-icon {
            background: #ffffff;
            border: 1px solid #c2d4ec;
            padding: 12px 18px;
            border-radius: 12px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chobidokan-verify .input-icon:focus-within {
            border-color: #0056b3;
            box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.1);
        }

        .chobidokan-verify .input-icon input {
            border: 0;
            padding: 0;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 1.25rem;
            text-align: center;
            letter-spacing: 4px;
            font-weight: 700;
        }

        .chobidokan-verify .brand-head {
            text-align: center;
            margin-bottom: 2rem;
        }

        .chobidokan-verify .brand-head h5 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
        }

        .chobidokan-verify .lead {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .chobidokan-verify .btn-primary {
            background: linear-gradient(90deg, #1d4ed8, #2563eb);
            border: none;
            padding: 12px 14px;
            border-radius: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease-in-out;
            color: #ffffff;
            width: 100%;
            cursor: pointer;
        }

        .chobidokan-verify .btn-primary:hover {
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.4);
        }

        .chobidokan-verify .resend-link {
            background: none;
            border: none;
            color: #2563eb;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            font-size: 0.95rem;
            text-decoration: none;
        }

        .chobidokan-verify .resend-link:hover {
            text-decoration: underline;
            color: #1e40af;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }
        .alert-warning {
            background-color: #fff3cd;
            color: #664d03;
            border: 1px solid #ffecb5;
        }
    </style>

    <main>
        <section class="chobidokan-verify">
            <div class="verify-wrap">
                <div class="verify-card">
                    <div class="brand-head">
                        <img src="{{ asset('images/logo.png') }}" alt="ChobiDokan logo" onerror="this.style.display='none'">
                        <h5 class="mt-2 mb-0">Verify Your Email</h5>
                        <p class="lead">We've sent a 6-digit verification code to <strong>{{ $email }}</strong>. Please enter the code below to verify your account.</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verify.email') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="mb-4">
                            <div class="input-icon">
                                <input id="code" name="code" type="text" maxlength="6" placeholder="******" required autocomplete="off" autofocus>
                            </div>
                            @error('code')
                                <div style="color: #e3342f; font-size: 0.85rem; margin-top: 8px; text-align: center;">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mb-4">Verify Account</button>
                    </form>

                    <div class="text-center mt-3">
                        <form method="POST" action="{{ route('verify.email.resend') }}" style="display: inline;">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <span style="color:#6b7280; font-size:0.95rem;">Didn't receive the code?</span>
                            <button type="submit" class="resend-link">Resend Code</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
