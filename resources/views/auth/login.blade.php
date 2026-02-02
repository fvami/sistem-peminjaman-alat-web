@extends('auth.layouts')

@section('title', 'Sewalat | Login')

@section('content')
    <div class="main-container">

        <div class="form-side">
            <div class="login-wrapper">

                <div class="brand-header">
                    <h1>Sewalat</h1>
                    <p>Sign In to your account.</p>
                </div>

                <form action="{{ url('/login') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="" autofocus required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="password" class="form-label">Password</label>
                            {{-- <a href="#"
                                style="font-size: 0.65rem; text-decoration: none; color: var(--text-gray); margin-bottom: 6px; font-weight: 600; letter-spacing: 0.5px;">FORGOT?</a> --}}
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="" required>
                    </div>

                    <button class="btn btn-submit">SIGN IN</button>

                    <div class="footer-link">
                        Don't have an account? <a href="{{ url('/register') }}">REGISTER</a>
                    </div>
                </form>

            </div>
        </div>

        {{-- <div class="image-side"
            style="background-image: url('{{ $setting && $setting->log_img ? asset('storage/' . $setting->log_img) : 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=1200' }}'); background-size: cover; background-position: center;">
            <div class="image-content text-end">
                <h2>Welcome Back.</h2>
                <p class="opacity-75">Your professional workspace awaits.</p>
            </div>
        </div> --}}
        <div class="image-side"
            style="background-color: rgb(197, 197, 197); background-size: cover; background-position: center;">
            {{-- <div class="image-content text-end">
                <h2>Welcome Back.</h2>
                <p class="opacity-75">Your professional workspace awaits.</p>
            </div> --}}
        </div>

    </div>
@endsection
