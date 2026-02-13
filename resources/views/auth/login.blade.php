@extends('auth.layouts')

@section('title', 'SIPELAT | Login')

@section('content')
    <div class="main-container">

        <div class="form-side">
            <div class="login-wrapper">

                <div class="brand-header">
                    <h1>SIPELAT</h1>
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
        <div class="image-side"
            style="background-color: rgb(197, 197, 197); background-size: cover; background-position: center;">
        </div>

    </div>
@endsection
