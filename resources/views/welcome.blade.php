@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row position-absolute h-100 w-100 overflow-hidden">
        <div class="col-md-6 offset-md-3 login d-flex align-items-center justify-content-center">
            <div class="border-0 p-5 shadow text-center welcome-card">
                <h1 class="fw-bold mb-3">Selamat Datang <i class="bi bi-emoji-smile text-warning"></i></h1>
                <p class="text-secondary">Terima kasih telah membeli software <b>MoneyTory</b> ini, hal yang harus dilakukan pertama kali adalah mendaftarkan perusahaanmu di halaman di bawah ini.</p>
                <a class="btn btn-salmon mt-3 fw-bold px-4 py-3" href="/registration/company"><i class="bi bi-card-checklist me-2"></i> Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection