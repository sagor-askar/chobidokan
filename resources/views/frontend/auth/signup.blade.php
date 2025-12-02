@extends('includes.master')

@section('content')
<style>
    /* Global style cleanup */
    * {
        box-sizing: border-box; /* Ensures padding doesn't affect total width */
    }

    /* Main Layout & Container */
    .chobidokan-signup {
        /* Increased padding and margin for better vertical centering */
        padding: 40px 15px;
        margin-top: 5rem;
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .chobidokan-signup .signup-wrap {
        max-width: 960px;
        margin: 0 auto;
        width: 100%;
    }

    /* Right Panel (Form Container) */
    .chobidokan-signup .right-panel {
        background: #ffffff;
        /* Larger border radius for a softer look */
        border-radius: 16px;
        padding: 3rem; /* Increased padding */
        /* Enhanced, deeper shadow for a floating, premium look */
        box-shadow: 0 12px 40px rgba(15, 23, 42, 0.12);
    }

    /* Header/Branding */
    .chobidokan-signup .brand-head {
        text-align:center;
        margin-bottom: 2rem; /* Increased spacing */
    }
    .chobidokan-signup .brand-head h3 {
        font-weight: 800; /* Bolder heading */
        color: #1f2937; /* Darker, more professional color */
        font-size: 2rem; /* Larger font size */
    }
    .chobidokan-signup .brand-head p {
        color: #6b7280;
        font-size: 1rem;
        margin-top: 5px;
    }

    /* Input Field Group */
    .chobidokan-signup .input-icon {
        display: flex;
        align-items: center;
        gap: 12px;
        /* Cleaner background and border */
        background: #ffffff;
        border: 1px solid #c2d4ec;
        padding: 12px 18px; /* Increased padding */
        border-radius: 12px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    /* Focus state enhancement */
    .chobidokan-signup .input-icon:focus-within {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15); /* Subtle focus ring */
    }
    .chobidokan-signup .input-icon svg {
        width:20px; /* Larger icon */
        height:20px;
        flex: 0 0 20px;
        opacity: .8;
        color: #4a5568; /* Darker icon color */
    }
    .chobidokan-signup .input-icon input {
        border: 0;
        padding: 0;
        background: transparent;
        outline: none;
        width: 100%;
        font-size: 1rem; /* Slightly larger input text */
    }
    .chobidokan-signup .input-helper {
        font-size: .85rem;
        color: #e3342f; /* Standard error color */
        margin-top: 8px;
        font-weight: 500;
    }

    /* Primary Button */
    .chobidokan-signup .btn-primary {
        /* Enhanced gradient and shadow for a 'pop' effect */
        background: linear-gradient(90deg, #1d4ed8, #2563eb);
        border: none;
        padding: 12px 24px; /* Increased vertical padding */
        border-radius: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        /* Stronger, premium shadow */
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
        transition: all 0.2s ease-in-out;
    }
    .chobidokan-signup .btn-primary:hover {
        background: linear-gradient(90deg, #2563eb, #1d4ed8);
        box-shadow: 0 6px 15px rgba(37, 99, 235, 0.4);
        transform: translateY(-2px); /* Subtle lift on hover */
    }

    /* Links and Checkbox Text */
    .chobidokan-signup a.small-link {
        font-size: .95rem;
        color: #2563eb;
        font-weight: 600; /* Bolder link text */
        text-decoration: none;
    }
    .chobidokan-signup a.small-link:hover {
        text-decoration: underline;
        color: #1e40af;
    }
    .form-check-label {
        color: #4b5563; /* Darker text for readability */
        font-size: 0.95rem;
    }

    /* Responsive adjustments */
    @media (max-width: 767px) {
        .chobidokan-signup .right-panel { padding: 2.5rem; }
        .chobidokan-signup .brand-head h3 { font-size: 1.75rem; }
        .chobidokan-signup .btn-primary { width: 100% !important; } /* Make button full width on mobile */
        .chobidokan-signup .d-flex.justify-content-center { justify-content: flex-start !important; }
    }
</style>

<main>
    <section class="chobidokan-signup">
        <div class="signup-wrap">
            <div class="right-panel">
                <div class="brand-head">
                    <h3>Sign Up to ChobiDokan</h3>
                    <p>Create your account in just a few steps</p>
                </div>

                <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-4"> <div class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a9 9 0 0 1 13 0"/></svg>
                                <input type="text" name="name" id="fullname" placeholder="Full Name" value="{{ old('name') }}">
                            </div>
                            @error('name') <div class="input-helper">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 9.5 12 3l9 6.5V21H3z"/><path d="M9 21V12h6v9"/></svg>
                                <input type="text" name="address" id="address" placeholder="Your Address" value="{{ old('address') }}">
                            </div>
                            @error('address') <div class="input-helper">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M22 16.92V21a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2 4.18 2 2 0 0 1 4 2h4.09a2 2 0 0 1 2 1.72c.12.81.36 1.6.72 2.32a2 2 0 0 1-.45 2.11l-1.27 1.27a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.72.36 1.51.6 2.32.72a2 2 0 0 1 1.72 2z"/></svg>
                                <input type="number" name="phone" id="phone" placeholder="Phone No." value="{{ old('phone') }}">
                            </div>
                            @error('phone') <div class="input-helper">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V8a5 5 0 0 1 10 0v3"/></svg>
                                <input type="password" name="password" id="password" placeholder="Password" required autocomplete="new-password">
                                <button type="button" id="pwdToggle" style="background:transparent;border:0;padding:0;margin:0;display:flex;align-items:center; cursor:pointer;" onclick="togglePassword('password','pwdToggle')" aria-label="Toggle password visibility">
                                    <svg id="pwdIcon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                            </div>
                            @error('password') <div class="input-helper">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7"/><path d="M21 7l-9 6L3 7"/></svg>
                                <input type="email" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
                            </div>
                            @error('email') <div class="input-helper">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V8a5 5 0 0 1 10 0v3"/></svg>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                <button type="button" id="pwdToggleConfirm" style="background:transparent;border:0;padding:0;margin:0;display:flex;align-items:center; cursor:pointer;" onclick="togglePassword('password_confirmation','pwdToggleConfirm')" aria-label="Toggle confirm password visibility">
                                    <svg id="pwdIconConfirm" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                            </div>
                            @error('password_confirmation') <div class="input-helper">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="d-flex align-items-start">
                            <input type="checkbox" class="form-check-input me-2 mt-1" name="terms_conditiond" id="exampleCheck1" required style="cursor:pointer;">
                            <label class="form-check-label mb-0" for="exampleCheck1">
                                By signing up, you agree to our
                                <a href="{{ route('terms-of-use') }}" class="small-link">Terms and Conditions</a>
                            </label>
                        </div>
                        </div>

                    <div class="d-flex flex-column align-items-center mb-3">
                        <button type="submit" class="btn btn-primary w-50">
                            Sign Up
                        </button>
                        <a href="{{ route('password.request') }}" class="small-link mt-3">Forgot password?</a>
                    </div>

                    <div class="text-center mt-3 small" style="color:#6b7280;">
                        Already have an account? <a href="{{ route('signin') }}" class="small-link">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    const EYE_SVG = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>';
    const EYE_SLASH_SVG = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-6 0-10-7-10-7a18.31 18.31 0 0 1 4.11-4.78"/><path d="M1 1l22 22"/><path d="M9.88 9.88A3 3 0 0 0 14.12 14.12"/></svg>';

    function togglePassword(inputId, btnId) {
        const pwd = document.getElementById(inputId);
        const btn = document.getElementById(btnId);

        if (!pwd || !btn) return;

        if (pwd.type === 'password') {
            pwd.type = 'text';
            btn.innerHTML = EYE_SLASH_SVG;
        } else {
            pwd.type = 'password';
            btn.innerHTML = EYE_SVG;
        }
    }
</script>
@endsection
