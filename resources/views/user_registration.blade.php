@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-salmon" href="/users">Pengguna</a></li>
          <li class="breadcrumb-item active" aria-current="page">Registrasi</li>
        </ol>
    </nav>
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <form action="/registration/user" method="POST" class="login-form">
                    @csrf
                    <div class="mb-3">
                        <label for="full_name" class="form-label small mb-1 text-capitalize">nama lengkap</label>
                        <input type="text" class="form-control p-3 @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}">
                        @error('full_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label small mb-1 text-capitalize">no. telepon</label>
                        <input type="text" class="form-control p-3 @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label small mb-1 text-capitalize">username</label>
                        <input type="text" class="form-control p-3 @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label small mb-1 text-capitalize">password</label>
                        <input type="password" class="form-control p-3 @error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label small mb-1 text-capitalize">konfirmasi password</label>
                        <input type="password" class="form-control p-3 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label small mb-1 text-capitalize">role</label>
                        <select class="form-select p-3 @error('role') is-invalid @enderror" aria-label="Default select example" id="role" name="role">
                            <option value="" selected>-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-salmon w-100 p-3 mt-3 fw-bold text-uppercase">register</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection