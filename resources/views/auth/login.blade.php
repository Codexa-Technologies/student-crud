@extends('layouts.app')

@section('title','Login')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="auth-card" style="width:420px;">
        <div class="text-center" style="background:#3b82f6;padding:28px;border-top-left-radius:8px;border-top-right-radius:8px;color:#fff;">
            <i class="fas fa-user-circle fa-3x mb-2"></i>
            <h3 class="mb-0">Welcome Back</h3>
            <p class="small mb-0">Sign in to your account</p>
        </div>

        <div class="p-4" style="background:#fff;border:1px solid rgba(0,0,0,0.03);border-bottom-left-radius:8px;border-bottom-right-radius:8px;">
            @if(session('success'))
                <div class="alert-enhanced alert-success-enhanced mb-3">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-enhanced alert-danger-enhanced mb-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control-enhanced" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control-enhanced" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="form-check-input me-2">
                        <span class="small">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small">Forgot your password?</a>
                    @endif
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn-enhanced btn-primary-enhanced"><i class="fas fa-sign-in-alt me-1"></i>Login</button>
                </div>
            </form>

            <div class="text-center mt-3 small">
                Don't have an account? <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>
</div>
@endsection
