@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; margin-top: 200px;">
        <div class="col-md-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin">
                <h1 class="h3 mb-3 fw-normal text-center">Login Page</h1>
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="email" autofocus required value="{{ old('email') }}">
                        <label for="floatingInput">Email</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                            required>
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary w-50 py-2" type="submit">Login</button>
                    </div>
                </form>
                <small class="d-block text-center mt-3">Don't have an account? <a href="/register">Register
                        Now!</a></small>
            </main>
        </div>
    </div>
@endsection
