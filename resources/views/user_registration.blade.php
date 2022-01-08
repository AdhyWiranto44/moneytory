@extends('layouts.main')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 d-flex align-items-center justify-content-center">
            <form action="/user_registration" method="POST" class="login-form">
                <h2 class="text-center fw-bold text-uppercase mb-3">user registration</h2>
                <div class="mb-3">
                    <label for="full_name" class="form-label small mb-1 text-capitalize">full name</label>
                    <input type="text" class="form-control p-3" id="full_name" name="full_name">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label small mb-1 text-capitalize">phone number</label>
                    <input type="text" class="form-control p-3" id="phone_number" name="phone_number">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label small mb-1 text-capitalize">username</label>
                    <input type="text" class="form-control p-3" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label small mb-1 text-capitalize">password</label>
                    <input type="password" class="form-control p-3" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label small mb-1 text-capitalize">role</label>
                    <select class="form-select p-3" aria-label="Default select example" id="role" name="role">
                        <option selected>-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                        </select>
                </div>
                <button type="submit" class="btn btn-salmon w-100 p-3 mt-3 fw-bold text-uppercase">register</button>
                <p class="mt-4 text-center small">Already have an account? <a href="/login">Login</a></p>
            </form>
        </div>
    </div>
</div>
@endsection