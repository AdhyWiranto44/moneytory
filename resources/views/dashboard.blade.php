@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row mb-5">
            <div class="col-md-8">
                @include('partials.date_picker')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card p-2 border-0 shadow mb-3">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-between justify-content-center">
                            <i class="bi bi-arrow-down-circle me-2 h4 text-success"></i> 
                            <h5 class="fw-bold mb-0">Pemasukan</h5>
                        </div>
                        <h3 class="py-3">Rp {{ number_format($incomes, 0, ",", ".") }}</h3>
                        <a href="#" class=" btn btn-light px-3 text-decoration-none text-secondary"><small>Detail</small></a>
                    </div>
                    </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-2 border-0 shadow mb-3">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-between justify-content-center">
                            <i class="bi bi-arrow-up-circle me-2 h4 text-danger"></i> 
                            <h5 class="fw-bold mb-0">Pengeluaran</h5>
                        </div>
                        <h3 class="py-3">Rp {{ number_format($expenses, 0, ",", ".") }}</h3>
                        <a href="#" class=" btn btn-light px-3 text-decoration-none text-secondary"><small>Detail</small></a>
                    </div>
                    </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-2 border-0 shadow mb-3">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-between justify-content-center">
                            <i class="bi bi-emoji-dizzy me-2 h4 text-secondary"></i> 
                            <h5 class="fw-bold mb-0">Hutang</h5>
                        </div>
                        <h3 class="py-3">Rp {{ number_format($debts, 0, ",", ".") }}</h3>
                        <a href="#" class=" btn btn-light px-3 text-decoration-none text-secondary"><small>Detail</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection