@extends('includes.master')

@section('content')
    <style>
        /* Global Reset/Base */
        * {
            text-decoration: none;
            box-sizing: border-box;
            /* Good practice */
        }

        /* Variables (using the existing ones for consistency) */
        :root {
            --chobi-card-bg: #ffffff;
        }

        /* Main Layout & Spacing */
        .chobidokan-login {
            /* Increased padding and margin for more breathing room and centering */
            padding: 40px 15px;
            margin-top: 5rem;
            min-height: 90vh;
            display: flex;
            align-items: center;
            /* Vertically center the whole login box */
            justify-content: center;
        }

        .chobidokan-login .login-wrap {
            max-width: 960px;
            /* Slightly wider login box */
            margin: 0 auto;
            width: 100%;
        }

        /* Left Panel (Illustration) */
        .chobidokan-login .left-panel {
            /* Enhanced gradient and border-radius for a smoother, premium look */
            background: linear-gradient(135deg, #f0f7ff 0%, #dceaff 100%);
            border-radius: 16px 0 0 16px;
            /* Slightly larger radius */
            padding: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 400px;
            /* Increased height for prominence */
            /* Added a subtle inner shadow for depth */
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.03);
        }

        .chobidokan-login .left-panel .ill {
            max-width: 300px;
            /* Larger illustration */
            width: 100%;
            height: auto;
            opacity: 1;
        }

        /* Right Panel (Form) */
        .chobidokan-login .right-panel {
            background: var(--chobi-card-bg, #ffffff);
            border-radius: 0 16px 16px 0;
            /* Slightly larger radius */
            padding: 3rem;
            /* Increased padding */
            /* Enhanced, softer shadow for a floating effect */
            box-shadow: 0 10px 40px rgba(15, 23, 42, 0.1);
        }

        /* Input Fields */
        .chobidokan-login .input-icon {
            /* Updated border and background for a cleaner, modern look */
            background: #ffffff;
            border: 1px solid #c2d4ec;
            /* Slightly darker border for contrast */
            padding: 12px 18px;
            /* Increased padding */
            border-radius: 12px;
            /* Smoother corners */
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            /* Ensure the original structure is maintained */
            align-items: center;
            gap: 12px;
        }

        .chobidokan-login .input-icon:focus-within {
            border-color: #0056b3;
            /* Darker blue on focus */
            box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.1);
            /* Subtle focus ring */
        }

        .chobidokan-login .input-icon svg {
            width: 20px;
            /* Larger icon */
            height: 20px;
            flex: 0 0 20px;
            opacity: .75;
            color: #4a5568;
            /* Darker color for icons */
        }

        .chobidokan-login .input-icon input {
            border: 0;
            padding: 0;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 1rem;
            /* Slightly larger font */
        }

        .chobidokan-login .input-helper {
            font-size: .85rem;
            color: #e3342f;
            /* Standard error color */
            margin-top: 8px;
            font-weight: 500;
        }

        /* Typography & Headings */
        .chobidokan-login .brand-head {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .chobidokan-login .brand-head h5 {
            /* Targeting the existing h5, but with larger style */
            font-size: 1.75rem;
            font-weight: 700;
            color: #1f2937;
            margin-top: 1rem !important;
        }

        .chobidokan-login .lead {
            color: #6b7280;
            font-size: 1rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        /* Primary Button */
        .chobidokan-login .btn-primary {
            /* Enhanced gradient and shadow for a 'pop' effect */
            background: linear-gradient(90deg, #1d4ed8, #2563eb);
            border: none;
            padding: 12px 14px;
            border-radius: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease-in-out;
        }

        .chobidokan-login .btn-primary:hover {
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.4);
        }

        /* Links */
        .chobidokan-login a.small-link {
            font-size: .95rem;
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .chobidokan-login a.small-link:hover {
            text-decoration: underline;
            color: #1e40af;
        }

        .chobidokan-login .form-check-label {
            color: #4b5563;
        }

        /* Responsive */
        @media (max-width: 767px) {
            .chobidokan-login {
                margin-top: 2rem;
            }

            .chobidokan-login .right-panel {
                border-radius: 16px;
                padding: 2.5rem;
            }

            .chobidokan-login .login-wrap {
                padding: 0;
            }

            .chobidokan-login .brand-head h5 {
                font-size: 1.5rem;
            }
        }
    </style>

    <main>
        <section class="chobidokan-login">
            <div class="login-wrap">
                <div class="row g-0 align-items-center">
                    <div class="col-md-6 d-none d-md-flex">
                        <div class="left-panel">
                            <svg class="ill" viewBox="0 0 600 400" xmlns="http://www.w3.org/2000/svg" role="img"
                                aria-hidden="true">
                                <defs>
                                    <linearGradient id="g1" x1="0" x2="1">
                                        <stop offset="0" stop-color="#e6f0ff" />
                                        <stop offset="1" stop-color="#ffffff" />
                                    </linearGradient>
                                </defs>
                                <rect width="100%" height="100%" rx="12" fill="url(#g1)" />
                                <g transform="translate(60,40)" fill="none" stroke="#b3d4ff" stroke-width="12"
                                    stroke-linecap="round" stroke-linejoin="round" opacity="0.9">
                                    <path d="M20 80 C120 10, 240 10, 340 80" />
                                    <path d="M20 160 C120 90, 240 90, 340 160" />
                                </g>
                                <g transform="translate(180,110)">
                                    <circle cx="0" cy="0" r="40" fill="#fff" stroke="#90bfff"
                                        stroke-width="8" />
                                    <rect x="80" y="-24" width="160" height="130" rx="16" fill="#fff"
                                        stroke="#90bfff" stroke-width="8" />
                                </g>
                            </svg>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="right-panel">
                            <div class="brand-head">
                                <img src="{{ asset('images/logo.png') }}" alt="ChobiDokan logo"
                                    onerror="this.style.display='none'">
                                <h5 class="mt-2 mb-0">Welcome back</h5>
                                <p class="lead">Sign in to continue to <strong>ChobiDokan</strong></p>
                            </div>

                            <form method="POST" action="{{ route('customLogin') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="visually-hidden">Email</label>
                                    <div class="input-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7" />
                                            <path d="M21 7l-9 6L3 7" />
                                        </svg>
                                        <input id="email" name="email" type="email" placeholder="Email address"
                                            required value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <div class="input-helper">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="visually-hidden">Password</label>
                                    <div class="input-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <rect x="3" y="11" width="18" height="10" rx="2" />
                                            <path d="M7 11V8a5 5 0 0 1 10 0v3" />
                                        </svg>

                                        <input id="password" name="password" type="password" placeholder="Password"
                                            required autocomplete="current-password">

                                        <button type="button" id="pwdToggle"
                                            style="background:transparent;border:0;padding:0;margin:0;display:flex;align-items:center;cursor:pointer;"
                                            aria-label="Toggle password visibility"
                                            onclick="togglePassword('password','pwdToggle')">
                                            <svg id="pwdIcon" viewBox="0 0 24 24" width="20" height="20"
                                                fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                aria-hidden="true">
                                                <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="input-helper">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="small-link">Forgot password?</a>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Sign in</button>

                                <div class="text-center mt-4 small" style="color:#6b7280;"> Don't have an account? <a
                                        href="{{ route('signup') }}" class="small-link">Register</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script>
        // Minimal toggle that replaces only the inner SVG
        const EYE_SVG =
            '<svg id="pwdIcon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>';
        const EYE_SLASH_SVG =
            '<svg id="pwdIcon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-6 0-10-7-10-7a18.31 18.31 0 0 1 4.11-4.78"/><path d="M1 1l22 22"/><path d="M9.88 9.88A3 3 0 0 0 14.12 14.12"/></svg>';

        function togglePassword(inputId, btnId) {
            const pwd = document.getElementById(inputId);
            const iconContainer = document.getElementById(btnId);

            // Find the current icon inside the button
            let currentIcon = iconContainer ? iconContainer.querySelector('#pwdIcon') : null;

            if (!pwd) return;
            if (pwd.type === 'password') {
                pwd.type = 'text';
                if (currentIcon) {
                    // Replace the entire SVG element
                    currentIcon.outerHTML = EYE_SLASH_SVG;
                }
            } else {
                pwd.type = 'password';
                if (currentIcon) {
                    // Replace the entire SVG element
                    currentIcon.outerHTML = EYE_SVG;
                }
            }
        }
    </script>
@endsection
