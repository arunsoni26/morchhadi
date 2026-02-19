@extends('auth.app')

@section('content')
<main style="display:flex; justify-content:center; align-items:center; min-height:80vh; background: linear-gradient(135deg, #f7f6f2 0%, #e3f4f1 100%);">
    <div class="card shadow-lg rounded" style="width: 400px; border-radius: 15px;">
        <div class="card-header text-center text-white" style="background: linear-gradient(90deg, #1A5E63, #53B8A3); font-weight:600; font-size:1.2rem; border-top-left-radius:15px; border-top-right-radius:15px;">
            {{ __('Login') }}
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required autocomplete="current-password">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Remember Me --}}
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                </div>

                {{-- Buttons --}}
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn" style="background: linear-gradient(90deg,#1A5E63,#53B8A3); color:#fff; font-weight:600; border-radius:10px; padding:8px;">
                        {{ __('Login') }}
                    </button>
                </div>

                <div class="mt-3 text-center">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link p-0" href="{{ route('password.request') }}" style="color:#53B8A3; font-size:0.9rem;">{{ __('Forgot Your Password?') }}</a>
                    @endif
                    <span style="margin:0 5px;">|</span>
                    <a class="btn btn-link p-0" href="{{ route('register') }}" style="color:#53B8A3; font-size:0.9rem;">{{ __('Register') }}</a>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
