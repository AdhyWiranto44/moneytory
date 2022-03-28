@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <div class="card p-2 border-0 shadow-sm mb-3">
                                    <div class="card-body overflow-hidden">
                                        <div class="d-flex align-items-center mb-1">
                                            <img class="rounded-circle me-2" src="/img/default.jpg" alt="default" width="48" height="48">
                                            <h6 class="fw-bold mb-0">{{ $product->name }}</h6>
                                        </div>
                                        <div class="d-flex justify-content-between my-3">
                                            <div>
                                                <small class="text-secondary">Harga</small>
                                                <h6 class="fw-bold mt-2 overflow-hidden">Rp {{ number_format($product->base_price+$product->profit, 0, ",", ".") }}</h6>
                                            </div>
                                            <div>
                                                <small class="text-secondary">Stok</small>
                                                <h6 class="fw-bold mt-2 overflow-hidden">{{ $product->stock }}</h6>
                                            </div>
                                        </div>
                                        <form action="/cart/add-new" method="POST">
                                            @csrf
                                            <input type="hidden" name="product-code" value="{{ $product->code }}">
                                            <input type="hidden" name="amount" value="1">
                                            <button type="submit" class="atc-button btn btn-sm btn-outline-salmon shadow-sm w-100 py-2" title="Tambah ke keranjang" onclick="return confirm('Tambahkan ke keranjang?')"><i class="bi bi-cart-plus"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h4>Tidak ada produk yang tersedia.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection