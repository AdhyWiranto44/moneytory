@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-secondary">Profil Perusahaan</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <th>:</th>
                            <td>{{ $companyName }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <th>:</th>
                            <td>{{ $companyPhoneNumber }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>:</th>
                            <td>{{ $companyEmail }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th>:</th>
                            <td>{{ $companyAddress }}</td>
                        </tr>
                        <tr>
                            <th>Logo</th>
                            <th>:</th>
                            <td>
                                @if ($companyLogo)
                                    <img class="rounded-circle me-2 d-none d-md-block" src="{{ asset('storage/img/' . $companyLogo) }}" alt="Company Logo" width="36" height="36">
                                @else
                                    <img class="rounded-circle me-2 d-none d-md-block" src="/img/default.jpg" alt="default" width="36" height="36">
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-outline-salmon px-3 py-2 fw-bold" href="/settings/company-profile"><i class="bi bi-pencil me-md-2"></i> Ubah</a>
            </div>
        </div>
    </div>
</div>
@endsection