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
        <div class="d-flex align-items-center">
            @include('partials.title')
            <h6 class="text-secondary fw-bold ms-2">Barang Jadi</h6>
        </div>
        <div class="row">
            <div class="col-md">
                <form action="/products/{{ $product->code }}/edit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label small mb-1 text-capitalize">nama</label>
                        <input type="text" class="form-control p-3 @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name }}" autofocus required>
                        @error('name')
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
                                @if ($unit->id == $product->unit_id)
                                    <option value="{{ $unit->id }}" selected>{{ $unit->name }}</option>
                                @else
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endif
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
                        <input type="text" class="form-control p-3 @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ $product->stock }}" placeholder="contoh: 4.4 (pakai titik)" required>
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="minimum_stock" class="form-label small mb-1 text-capitalize">stok minimum</label>
                        <input type="text" class="form-control p-3 @error('minimum_stock') is-invalid @enderror" id="minimum_stock" name="minimum_stock" value="{{ $product->minimum_stock }}" placeholder="contoh: 4.4 (pakai titik)" required>
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
                            <input type="number" class="form-control p-3 @error('base_price') is-invalid @enderror" placeholder="contoh: 10000" aria-label="base_price" aria-describedby="basic-addon1" id="base_price" name="base_price" value="{{ $product->base_price }}">
                            @error('base_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>    
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="profit" class="form-label small mb-1 text-capitalize">untung</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control p-3 @error('profit') is-invalid @enderror" placeholder="contoh: 5000" aria-label="profit" aria-describedby="basic-addon1" id="profit" name="profit" value="{{ $product->profit }}">
                            @error('profit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>    
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label small mb-1 text-capitalize">diskon</label>
                        <div class="input-group">
                            <input type="number" class="form-control p-3 @error('discount') is-invalid @enderror" placeholder="dalam persen" aria-label="discount" aria-describedby="basic-addon1" id="discount" name="discount" value="{{ $product->discount }}">
                            <span class="input-group-text" id="basic-addon2">%</span>
                            @error('discount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>    
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label small mb-1 text-capitalize">gambar</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                        <div class="previous-image mt-3">
                            <p class="mb-0">Gambar Sekarang</p>
                            @if ($product->image)
                                <img class="rounded-circle me-2 d-none d-md-block" src="{{ asset('storage/img/' . $product->image) }}" alt="barang jadi" width="36" height="36">
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
                    @include('partials.edit_button')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection