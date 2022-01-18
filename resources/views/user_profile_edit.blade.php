@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-salmon" href="/settings">Pengaturan</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md-6">
                <form action="/settings/user-profile/{{ $username }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label small mb-1 text-capitalize">nama lengkap</label>
                        <input type="text" class="form-control p-3 @error('name') is-invalid @enderror" id="name" name="name" value="{{ $userUpdate->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label small mb-1 text-capitalize">no. telepon</label>
                        <input type="text" class="form-control p-3 @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ $userUpdate->phone_number }}" required>
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label small mb-1 text-capitalize">email</label>
                        <input type="email" class="form-control p-3 @error('email') is-invalid @enderror" id="email" name="email" value="{{ $userUpdate->email }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label small mb-1 text-capitalize">address</label>
                        <input type="text" class="form-control p-3 @error('address') is-invalid @enderror" id="address" name="address" value="{{ $userUpdate->address }}">
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label small mb-1 text-capitalize">username</label>
                        <input type="text" class="form-control p-3 @error('username') is-invalid @enderror" id="username" name="username" value="{{ $userUpdate->username }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label small mb-1 text-capitalize">photo</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                        <div class="previous-image">
                            <p class="mb-0">Foto Sekarang</p>
                            @if ($userUpdate->image)
                                <img class="rounded-circle me-2 d-none d-md-block" src="{{ asset('storage/img/' . $userUpdate->image) }}" alt="Company Logo" width="36" height="36">
                            @else
                                <img class="rounded-circle me-2 d-none d-md-block" src="/img/default.jpg" alt="default" width="36" height="36">
                            @endif
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-salmon w-100 p-3 my-3 fw-bold text-uppercase"><i class="bi bi-pencil me-md-2"></i> ubah</button>
                </form>
            </div>
            <div class="col-md-6">
                <form action="/settings/user-profile/{{ $username }}/update-password" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="password" class="form-label small mb-1 text-capitalize">password</label>
                        <input type="password" class="form-control p-3 @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label small mb-1 text-capitalize">konfirmasi password</label>
                        <input type="password" class="form-control p-3 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-salmon w-100 p-3 mt-3 fw-bold text-uppercase"><i class="bi bi-pencil me-md-2"></i> ubah password</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection