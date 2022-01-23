@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-salmon" href="/users">Pengguna</a></li>
          <li class="breadcrumb-item active" aria-current="page">Registrasi</li>
        </ol>
    </nav>
    <div class="col-lg-6">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <form action="/users/register" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label small mb-1 text-capitalize">nama lengkap</label>
                        <input type="text" class="form-control p-3 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
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
                        <label for="email" class="form-label small mb-1 text-capitalize">email</label>
                        <input type="email" class="form-control p-3 @error('email') is-invalid @enderror" id="email" name="email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label small mb-1 text-capitalize">address</label>
                        <input type="text" class="form-control p-3 @error('address') is-invalid @enderror" id="address" name="address">
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label small mb-1 text-capitalize">username <div class="text-danger d-inline">*</div></label>
                        <input type="text" class="form-control p-3 @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>        
                        @else
                            <small class="text-danger">* Username minimal 5 karakter.</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label small mb-1 text-capitalize">password <div class="text-danger d-inline">**</div></label>
                        <input type="password" class="form-control p-3 @error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @else
                            <small class="text-danger">** Password minimal 8 karakter.</small>
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
                    <div class="mb-3">
                        <label for="image" class="form-label small mb-1 text-capitalize">photo</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    @include('partials.add_button')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection