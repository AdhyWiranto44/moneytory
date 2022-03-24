@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-salmon" href="/incomes">Pemasukan</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="col-md-12">
        <div class="d-flex align-items-center">
            @include('partials.title')
            <h6 class="text-secondary fw-bold ms-2">Pemasukan</h6>
        </div>
        <div class="row">
            <div class="col-md-6 order-2 order-md-1">
                <h5 class="text-secondary">Data Pemasukan</h5>
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
                    <small class="text-danger">* Input kode produknya saja.</small><br>
                    <small class="text-danger">** Input jumlah masing-masing produk.</small><br>
                    <small class="text-danger">*** Input harga dalam bentuk angka.</small>
                    @include('partials.edit_button')
                </form>
            </div>
            <div class="col-md-6 order-1 order-md-2">
                <h5 class="text-secondary">Daftar Produk</h5>
                <div class="table-responsive">
                    <table id="example" class="display overflow-scroll">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Harga + Untung</th>
                                <th class="text-center">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($products as $product)
                            <tr>
                                <td class="text-center fw-bold"><?= $i++; ?></td>
                                <td class="text-center">
                                    @if ($product->image)
                                        <img class="rounded-circle mx-auto" src="{{ asset('storage/img/' . $product->image) }}" alt="Gambar Bahan Mentah" width="36" height="36">
                                    @else
                                        <img class="rounded-circle mx-auto" src="/img/default.jpg" alt="default" width="36" height="36">
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->code)
                                        {{ $product->code }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->name)
                                        {{ $product->name }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->base_price && $product->profit)
                                        Rp {{ number_format($product->base_price + $product->profit, 0, ',', '.') }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->stock)
                                        {{ $product->stock . ' ' . $product->unit }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Harga + Untung</th>
                                <th class="text-center">Stok</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection