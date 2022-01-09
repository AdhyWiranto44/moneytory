@extends('layouts.main')

@section('content')
<div class="container-fluid my-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 d-flex align-items-center justify-content-center">
            <form action="/registration/company" method="POST" enctype="multipart/form-data" class="login-form">
                @csrf
                <h2 class="text-center fw-bold text-uppercase mb-3">company registration</h2>
                <div class="mb-3">
                    <label for="name" class="form-label small mb-1 text-capitalize">company name</label>
                    <input type="text" class="form-control p-3 @error('name') is-invalid @enderror" id="name" name="name" required autofocus>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label small mb-1 text-capitalize">company phone number</label>
                    <input type="text" class="form-control p-3 @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label small mb-1 text-capitalize">company email</label>
                    <input type="email" class="form-control p-3 @error('email') is-invalid @enderror" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label small mb-1 text-capitalize">company address</label>
                    <input type="text" class="form-control p-3 @error('address') is-invalid @enderror" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label small mb-1 text-capitalize">company logo</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-salmon w-100 p-3 mt-3 fw-bold text-uppercase">register</button>
            </form>
        </div>
    </div>
</div>
@endsection