@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-salmon" href="/products">Barang Jadi</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="col-lg-6">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <form action="/products/add-new" method="POST" enctype="multipart/form-data">
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
                        <label for="code" class="form-label small mb-1 text-capitalize">kode</label>
                        <input type="text" class="form-control p-3 @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}" placeholder="misal: PROD001" required>
                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label small mb-1 text-capitalize">satuan</label>
                        <select class="form-select p-3 @error('unit') is-invalid @enderror" aria-label="Default select example" id="unit" name="unit" required>
                            <option value="" selected>-- Pilih Satuan --</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('unit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label small mb-1 text-capitalize">stok</label>
                        <input type="text" class="form-control p-3 @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" placeholder="contoh: 4.4 (pakai titik)" required>
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="minimum_stock" class="form-label small mb-1 text-capitalize">stok minimum</label>
                        <input type="text" class="form-control p-3 @error('minimum_stock') is-invalid @enderror" id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock') }}" placeholder="contoh: 4.4 (pakai titik)" required>
                        @error('minimum_stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="base_price" class="form-label small mb-1 text-capitalize">harga modal</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control p-3 @error('base_price') is-invalid @enderror" placeholder="contoh: 10000" aria-label="base_price" aria-describedby="basic-addon1" id="base_price" name="base_price" value="{{ old('base_price') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="profit" class="form-label small mb-1 text-capitalize">untung</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control p-3 @error('profit') is-invalid @enderror" placeholder="contoh: 5000" aria-label="profit" aria-describedby="basic-addon1" id="profit" name="profit" value="{{ old('profit') }}">
                            @error('profit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>    
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label small mb-1 text-capitalize">gambar</label>
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