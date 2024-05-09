@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; margin-top: 100px;">
        <div class="col-lg-5">
            <main class="form-signin">
                <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
                <form action="/register" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="name"
                            class="form-control rounded-top @error('name') is-invalid @enderror" id="name"
                            placeholder="Name" required value="{{ old('name') }}">
                        <label for="name">Name</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password"
                            class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password"
                            placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="confirm-password"
                            class="form-control rounded-bottom @error('confirm-password') is-invalid @enderror"
                            id="confirm-password" placeholder="Confirm Password" required>
                        <label for="confirm-password">Confirm Password</label>
                        @error('confirm-password')
                            <div class="invalid-feedback">
                                The confirm password field must match the password.
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nomor_handphone"
                            class="form-control @error('nomor_handphone') is-invalid @enderror" id="nomor_handphone"
                            placeholder="nomor_handphone" required value="{{ old('nomor_handphone') }}">
                        <label for="nomor_handphone">Nomor Handphone</label>
                        @error('nomor_handphone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary w-50 py-2" type="submit">Register</button>
                    </div>
                </form>
                <small class="d-block text-center mt-3">Already have an account? <a href="/login">Login</a></small>
            </main>
        </div>
    </div>
@endsection
