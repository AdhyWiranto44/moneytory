@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        <h2 class="fw-bold mb-3">Dashboard</h2>
        <div class="row mb-5">
            <div class="col-md-8">
                <small>Cari berdasarkan tanggal</small>
                <form action="/dashboard.html" method="POST">
                    <div class="row g-2">
                        <div class="col input-group">
                            <div class="input-group-text bg-light-secondary border-light-secondary text-secondary">Dari</div>
                            <input type="date" class="form-control py-2 bg-light-secondary border-light-secondary text-secondary" id="tanggal_dari" name="tanggal_dari" placeholder="Dari" title="Dari">
                        </div>
                        <div class="col input-group">
                            <div class="input-group-text bg-light-secondary border-light-secondary text-secondary">Ke</div>
                            <input type="date" class="form-control py-2 bg-light-secondary border-light-secondary text-secondary" id="tanggal_ke" name="tanggal_ke" placeholder="Ke" title="Ke">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-outline-salmon px-3 py-2"><i class="bi bi-search me-2"></i> Cari</button>
                        </div>
                    </div>
                </form>
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
                        <h3 class="py-3">Rp 100.000</h3>
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
                        <h3 class="py-3">Rp 25.450</h3>
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
                        <h3 class="py-3">Rp 14.400</h3>
                        <a href="#" class=" btn btn-light px-3 text-decoration-none text-secondary"><small>Detail</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection