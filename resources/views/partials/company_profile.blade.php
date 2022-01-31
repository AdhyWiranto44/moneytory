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
                    <img class="rounded-circle me-2 d-block" src="{{ asset('storage/img/' . $companyLogo) }}" alt="Company Logo" width="36" height="36">
                @else
                    <img class="rounded-circle me-2 d-block" src="/img/default.jpg" alt="default" width="36" height="36">
                @endif
            </td>
        </tr>
    </tbody>
</table>
<a class="btn btn-outline-salmon px-3 py-2 fw-bold" href="/settings/company-profile"><i class="bi bi-pencil me-md-2"></i> Ubah</a>