@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-salmon" href="/debts">Hutang</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="col-lg-6">
        <div class="d-flex align-items-center">
            @include('partials.title')
            <h6 class="text-secondary fw-bold ms-2">Hutang</h6>
        </div>
        <div class="row">
            <div class="col-md">
                <form action="/debts/add-new" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label small mb-1 text-capitalize">nama</label>
                        <input type="text" class="form-control p-3 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" autofocus required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label small mb-1 text-capitalize">deskripsi</label>
                        <input type="text" class="form-control p-3 @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label small mb-1 text-capitalize">biaya</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control p-3 @error('price') is-invalid @enderror" placeholder="contoh: 10000" aria-label="price" aria-describedby="basic-addon1" id="price" name="price" value="{{ old('price') }}">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>    
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="on_behalf_of" class="form-label small mb-1 text-capitalize">atas nama</label>
                        <input type="text" class="form-control p-3 @error('on_behalf_of') is-invalid @enderror" id="on_behalf_of" name="on_behalf_of" value="{{ old('on_behalf_of') }}" required>
                        @error('on_behalf_of')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label small mb-1 text-capitalize">no. telepon</label>
                        <input type="text" class="form-control p-3 @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label small mb-1 text-capitalize">alamat</label>
                        <input type="text" class="form-control p-3 @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="debt_type" class="form-label small mb-1 text-capitalize">jenis hutang</label>
                        <select class="form-select p-3 @error('debt_type') is-invalid @enderror" aria-label="Default select example" id="debt_type" name="debt_type" required>
                            <option value="" selected>-- Pilih Jenis Hutang --</option>
                            @foreach ($debtTypes as $debtType)
                                <option value="{{ $debtType->id }}">{{ $debtType->name }}</option>
                            @endforeach
                        </select>
                        @error('debt_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="debt_status" class="form-label small mb-1 text-capitalize">status hutang</label>
                        <select class="form-select p-3 @error('debt_status') is-invalid @enderror" aria-label="Default select example" id="debt_status" name="debt_status" required>
                            <option value="" selected>-- Pilih Status Hutang --</option>
                            @foreach ($debtStatuses as $debtStatus)
                                <option value="{{ $debtStatus->id }}">{{ $debtStatus->name }}</option>
                            @endforeach
                        </select>
                        @error('debt_status')
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