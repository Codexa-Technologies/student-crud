@extends('layouts.app')

@section('title','Register')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="auth-card" style="width:520px;">
        <div class="text-center" style="background:#0ea5e9;padding:28px;border-top-left-radius:8px;border-top-right-radius:8px;color:#fff;">
            <i class="fas fa-user-plus fa-3x mb-2"></i>
            <h3 class="mb-0">Create Account</h3>
            <p class="small mb-0">Register a new account</p>
        </div>

        <div class="p-4" style="background:#fff;border:1px solid rgba(0,0,0,0.03);border-bottom-left-radius:8px;border-bottom-right-radius:8px;">
            @if($errors->any())
                <div class="alert-enhanced alert-danger-enhanced mb-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control-enhanced" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control-enhanced" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control-enhanced" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control-enhanced" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn-enhanced btn-primary-enhanced"><i class="fas fa-user-plus me-1"></i>Register</button>
                </div>
            </form>

            <div class="text-center mt-3 small">
                Already have an account? <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>
</div>
@endsection
