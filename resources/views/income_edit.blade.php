@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-salmon" href="/incomes">Pemasukan</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="col-lg-6">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <form action="/incomes/{{ $income->code }}/edit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="code" class="form-label small mb-1 text-capitalize">kode</label>
                        <input type="text" class="form-control p-3 @error('code') is-invalid @enderror" id="code" name="code" value="{{ $income->code }}" placeholder="misal: INC001" autofocus required>
                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="products" class="form-label small mb-1 text-capitalize">daftar produk <div class="text-danger d-inline">*</div></label>
                        <input type="text" class="form-control p-3 @error('products') is-invalid @enderror" id="products" name="products" value="{{ $income->products }}" placeholder="contoh: PROD001,PROD002,PROD003" required>
                        @error('products')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amounts" class="form-label small mb-1 text-capitalize">daftar jumlah <div class="text-danger d-inline">**</div></label>
                        <input type="text" class="form-control p-3 @error('amounts') is-invalid @enderror" id="amounts" name="amounts" value="{{ $income->amounts }}" placeholder="contoh: 1,2,3" required>
                        @error('amounts')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="prices" class="form-label small mb-1 text-capitalize">daftar harga <div class="text-danger d-inline">***</div></label>
                        <input type="text" class="form-control p-3 @error('prices') is-invalid @enderror" id="prices" name="prices" value="{{ $income->prices }}" placeholder="contoh: 10000,15000,20000" autofocus required>
                        @error('prices')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="total_price" class="form-label small mb-1 text-capitalize">total harga</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control p-3 @error('total_price') is-invalid @enderror" placeholder="contoh: 45000" aria-label="total_price" aria-describedby="basic-addon1" id="total_price" name="total_price" value="{{ $income->total_price }}">
                            @error('total_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>    
                            @enderror
                        </div>
                    </div>
                    <small class="text-danger">* Input kode produknya saja.</small><br>
                    <small class="text-danger">** Input jumlah masing-masing produk.</small><br>
                    <small class="text-danger">*** Input harga dalam bentuk angka.</small>
                    @include('partials.edit_button')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection