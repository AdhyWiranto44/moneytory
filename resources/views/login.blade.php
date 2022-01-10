@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row position-absolute h-100 w-100 overflow-hidden">
        <div class="col-lg-6 login d-flex align-items-center justify-content-center">
            <form action="/login" method="POST" class="login-form">
                @csrf
                <div class="text-center text-uppercase" style="letter-spacing: 3px;">
                    @include('partials.title')
                </div>
                {{-- <h2 class="text-center fw-bold text-uppercase mb-3">login</h1> --}}
                <div class="mb-3">
                    <label for="username" class="form-label small mb-1">username</label>
                    <input type="text" class="form-control p-3 @error('username') is-invalid @enderror" id="username" name="username" required autofocus>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label small mb-1">password</label>
                    <input type="password" class="form-control p-3 @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                    @enderror
                </div>
                <button type="submit" class="btn btn-salmon w-100 p-3 mt-3 fw-bold text-uppercase">login</button>
            </form>
        </div>
        <div class="col-lg-6 d-none d-lg-block p-0 overflow-hidden">
            <img class="w-100 h-100" src="/img/login_bg.jpg" alt="login_bg" style="object-fit: cover;">
        </div>
    </div>
    @include('partials.alert')
</div>
@endsection