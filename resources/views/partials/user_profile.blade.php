<h5 class="text-secondary">Profil Pengguna</h5>
<table class="table">
    <tbody>
        <tr>
            <th>Username</th>
            <th>:</th>
            <td>
                @if ($username)
                    {{ $username }}
                @else
                    <small class="text-secondary">(Kosong)</small>
                @endif
            </td>
        </tr>
        <tr>
            <th>Password</th>
            <th>:</th>
            <td>*************</td>
        </tr>
        <tr>
            <th>Nama</th>
            <th>:</th>
            <td>
                @if ($userFullName)
                    {{ $userFullName }}
                @else
                    <small class="text-secondary">(Kosong)</small> 
                @endif
            </td>
        </tr>
        <tr>
            <th>No. Telepon</th>
            <th>:</th>
            <td>
                @if ($userPhoneNumber)
                    {{ $userPhoneNumber }}
                @else
                    <small class="text-secondary">(Kosong)</small>
                @endif
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <th>:</th>
            <td>
                @if ($userEmail )
                    {{ $userEmail }}
                @else
                    <small class="text-secondary">(Kosong)</small>
                @endif
            </td>
        </tr>
        <tr>
            <th>Alamat</th>
            <th>:</th>
            <td>
                @if ($userAddress)
                    {{ $userAddress }}
                @else
                    <small class="text-secondary">(Kosong)</small>
                @endif
            </td>
        </tr>
        <tr>
            <th>Foto</th>
            <th>:</th>
            <td>
                @if ($userImage)
                    <img class="rounded-circle me-2 d-block" src="{{ asset('storage/img/' . $userImage) }}" alt="Company Logo" width="36" height="36">
                @else
                    <img class="rounded-circle me-2 d-block" src="/img/default.jpg" alt="default" width="36" height="36">
                @endif
            </td>
        </tr>
    </tbody>
</table>
<a class="btn btn-outline-salmon px-3 py-2 fw-bold" href="/settings/user-profile/{{ $username }}"><i class="bi bi-pencil me-md-2"></i> Ubah</a>