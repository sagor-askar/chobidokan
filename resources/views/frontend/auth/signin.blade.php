@extends('includes.master')
@section('content')
<style>
    * {
        text-decoration: none;
    }
    .chobidokan-login { 
        padding: 28px 12px;
        margin-top: 5rem; 
    }
    .chobidokan-login .login-wrap { max-width: 920px; margin: 0 auto; }
    .chobidokan-login .left-panel {
        background: linear-gradient(135deg,#f6fbff 0%, #eef7ff 100%);
        border-radius: 12px 0 0 12px;
        padding: 2.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 320px;
    }
    .chobidokan-login .left-panel .ill {
        max-width: 240px;
        width: 100%;
        height: auto;
        opacity: .98;
    }

    .chobidokan-login .right-panel {
        background: var(--chobi-card-bg, #ffffff);
        border-radius: 0 12px 12px 0;
        padding: 2rem;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
    }

    .chobidokan-login .input-icon {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #fbfeff;
        border: 1px solid #e6eefb;
        padding: 10px 12px;
        border-radius: 10px;
    }
    .chobidokan-login .input-icon svg { width:18px; height:18px; flex: 0 0 18px; opacity: .7; }
    .chobidokan-login .input-icon input {
        border: 0;
        padding: 0;
        background: transparent;
        outline: none;
        width: 100%;
        font-size: 0.95rem;
    }
    .chobidokan-login .input-helper { font-size: .82rem; color: #d9534f; margin-top: 6px; }

    .chobidokan-login .brand-head { text-align:center; margin-bottom: .6rem; }
    .chobidokan-login .brand-head img { height:42px; object-fit:contain; display:inline-block; }

    .chobidokan-login .lead { color: #6b7280; font-size: .95rem; margin-bottom: 1.2rem; }

    .chobidokan-login .btn-primary {
        background: linear-gradient(90deg,#1565ff,#0053c7);
        border: none;
        padding: 10px 14px;
        border-radius: 10px;
        font-weight: 600;
        box-shadow: 0 8px 20px rgba(16, 52, 166, 0.08);
    }

    .chobidokan-login a.small-link { font-size: .9rem; color: #2563eb; text-decoration: none; }
    .chobidokan-login a.small-link:hover { text-decoration: underline; }

    @media (max-width: 767px) {
        .chobidokan-login .left-panel { display: none; }
        .chobidokan-login .right-panel { border-radius: 12px; }
        .chobidokan-login .login-wrap { padding: 0 8px; }
    }
</style>

<main>
    <section class="chobidokan-login">
        <div class="login-wrap">
            <div class="row g-0 align-items-center">
                <!-- Left illustration: hidden on small screens -->
                <div class="col-md-6 d-none d-md-flex">
                    <div class="left-panel">
                        <!-- Inline lightweight SVG illustration (safe, no external file) -->
                        <svg class="ill" viewBox="0 0 600 400" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
                            <defs>
                                <linearGradient id="g1" x1="0" x2="1">
                                    <stop offset="0" stop-color="#e6f0ff"/>
                                    <stop offset="1" stop-color="#ffffff"/>
                                </linearGradient>
                            </defs>
                            <rect width="100%" height="100%" rx="12" fill="url(#g1)"/>
                            <g transform="translate(60,40)" fill="none" stroke="#cfe5ff" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" opacity="0.9">
                                <path d="M20 80 C120 10, 240 10, 340 80" />
                                <path d="M20 160 C120 90, 240 90, 340 160" />
                            </g>
                            <g transform="translate(180,110)">
                                <circle cx="0" cy="0" r="36" fill="#fff" stroke="#cfe5ff"/>
                                <rect x="80" y="-24" width="140" height="120" rx="12" fill="#fff" stroke="#cfe5ff"/>
                            </g>
                        </svg>
                    </div>
                </div>

                <!-- Right: form -->
                <div class="col-12 col-md-6">
                    <div class="right-panel">
                        <div class="brand-head">
                            <!-- Optional: if you don't have a logo, leave this img tag but point to a small placeholder or remove -->
                            <img src="{{ asset('images/logo.png') }}" alt="ChobiDokan logo" onerror="this.style.display='none'">
                            <h5 class="mt-2 mb-0">Welcome back</h5>
                            <p class="lead">Sign in to continue to <strong>ChobiDokan</strong></p>
                        </div>

                        <form method="POST" action="{{ route('customLogin') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="visually-hidden">Email</label>
                                <div class="input-icon">
                                    <!-- mail icon -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7"/>
                                        <path d="M21 7l-9 6L3 7"/>
                                    </svg>
                                    <input id="email" name="email" type="email" placeholder="Email address" required value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <div class="input-helper">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="visually-hidden">Password</label>
                                <div class="input-icon">
                                    <!-- lock icon -->
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <rect x="3" y="11" width="18" height="10" rx="2"/>
                                        <path d="M7 11V8a5 5 0 0 1 10 0v3"/>
                                    </svg>

                                    <input id="password" name="password" type="password" placeholder="Password" required autocomplete="current-password">

                                    <button type="button" id="pwdToggle" style="background:transparent;border:0;padding:0;margin:0;display:flex;align-items:center;" aria-label="Toggle password visibility" onclick="togglePassword('password','pwdToggle')">
                                        <!-- eye icon (initial) -->
                                        <svg id="pwdIcon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="input-helper">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="small-link">Forgot password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Sign in</button>

                            <div class="text-center mt-3 small" style="color:#6b7280;">
                                Don't have an account? <a href="{{ route('signup') }}" class="small-link">Register</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<script>
    // Minimal toggle that replaces only the inner SVG (no dependency on font libs)
    const EYE_SVG = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>';
    const EYE_SLASH_SVG = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-6 0-10-7-10-7a18.31 18.31 0 0 1 4.11-4.78"/><path d="M1 1l22 22"/><path d="M9.88 9.88A3 3 0 0 0 14.12 14.12"/></svg>';

    function togglePassword(inputId, btnId) {
        const pwd = document.getElementById(inputId);
        const btn = document.getElementById(btnId);
        const icon = document.getElementById('pwdIcon');

        if (!pwd) return;
        if (pwd.type === 'password') {
            pwd.type = 'text';
            if (icon) icon.outerHTML = EYE_SLASH_SVG;
        } else {
            pwd.type = 'password';
            if (icon) icon.outerHTML = EYE_SVG;
        }
    }
</script>
@endsection
