@extends('auth.layouts')

@section('title', 'Sewalat | Register')

@section('content')
    <div class="main-container">

        <div class="image-side"
            style="background-color: rgb(197, 197, 197); background-size: cover; background-position: center;">
            {{-- <div class="image-content">
                <h2>The New Standard.</h2>
                <p class="opacity-75">Professional tools for the next generation.</p>
            </div> --}}
        </div>

        <div class="form-side">
            <div class="register-wrapper">

                <div class="brand-header">
                    <h1>Sewalat</h1>
                    <p>Create your account.</p>
                </div>

                <form action="{{ url('/register') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter your name" value="{{ old('name') }}" required>

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="name@example.com" value="{{ old('email') }}" required>

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password" required>

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-submit">CREATE ACCOUNT</button>

                    <div class="footer-link">
                        Already joined? <a href="{{ url('/login') }}">SIGN IN</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
