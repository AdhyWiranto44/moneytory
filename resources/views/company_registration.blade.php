@extends('layouts.main')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 d-flex align-items-center justify-content-center">
            <form action="/user_registration" method="POST" enctype="multipart/form-data" class="login-form">
                <h2 class="text-center fw-bold text-uppercase mb-3">company registration</h2>
                <div class="mb-3">
                    <label for="company_name" class="form-label small mb-1 text-capitalize">company name</label>
                    <input type="text" class="form-control p-3" id="company_name" name="company_name" required>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label small mb-1 text-capitalize">company phone number</label>
                    <input type="text" class="form-control p-3" id="phone_number" name="phone_number">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label small mb-1 text-capitalize">company email</label>
                    <input type="email" class="form-control p-3" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label small mb-1 text-capitalize">company address</label>
                    <input type="text" class="form-control p-3" id="address" name="address">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label small mb-1 text-capitalize">company logo</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-salmon w-100 p-3 mt-3 fw-bold text-uppercase">register</button>
            </form>
        </div>
    </div>
</div>
@endsection