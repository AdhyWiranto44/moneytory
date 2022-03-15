@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    @for ($i = 0; $i < 20; $i++)
                        <div class="col-6 col-md-4">
                            <div class="card p-2 border-0 shadow-sm mb-3">
                                <div class="card-body overflow-hidden">
                                    <div class="d-flex align-items-center mb-1">
                                        <img class="rounded-circle me-2" src="/img/default.jpg" alt="default" width="48" height="48">
                                        <h6 class="fw-bold mb-0">Product Name</h6>
                                    </div>
                                    <small class="text-secondary">Harga</small>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="fw-bold mt-2 overflow-hidden">Rp {{ number_format(45000, 0, ",", ".") }}</h6>
                                        <div class="product-buttons d-flex">
                                            <button class="btn-decrease border-0 bg-transparent"><i class="bi bi-dash-circle"></i></button>
                                            <h6 class="product-amount mt-2">0</h6>
                                            <button class="btn-increase border-0 bg-transparent"><i class="bi bi-plus-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">
                      Featured
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">An item</li>
                      <li class="list-group-item">A second item</li>
                      <li class="list-group-item">A third item</li>
                    </ul>
                  </div>
            </div>
        </div>
    </div>
</div>
<script>
    const buttonDecrease = document.querySelectorAll('.btn-decrease');
    const buttonIncrease = document.querySelectorAll('.btn-increase');
    let productAmount = document.querySelectorAll('.product-amount');

    // Increase button
    buttonDecrease.forEach((decrease, i) => {
        decrease.addEventListener('click', () => {
            let currentAmount = parseInt(productAmount[i].innerText);
            if (currentAmount > 0) {
                let newAmount = --currentAmount;
                productAmount[i].innerText = currentAmount;
            }
        });
    });

    // Decrease button
    buttonIncrease.forEach((increase, i) => {
        increase.addEventListener('click', () => {
            let currentAmount = parseInt(productAmount[i].innerText);
            let newAmount = ++currentAmount;
            productAmount[i].innerText = newAmount;
        });
    });
</script>
@endsection