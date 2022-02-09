@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <a class="btn btn-salmon fw-bold px-3 py-2 mb-3" href="/users/register"><i class="bi bi-person me-2"></i> Registrasi</a>
                <div class="table-responsive">
                    <table id="example" class="display overflow-scroll">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Foto</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">No. Telepon</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($users as $user)
                            <tr>
                                <td class="text-center fw-bold"><?= $i++; ?></td>
                                <td class="text-center">
                                    @if ($user->image)
                                        <img class="rounded-circle d-none d-md-block mx-auto" src="{{ asset('storage/img/' . $user->image) }}" alt="Foto Pengguna" width="36" height="36" onclick="window.open('{{ asset('storage/img/' . $user->image) }}')">
                                    @else
                                        <img class="rounded-circle d-none d-md-block mx-auto" src="/img/default.jpg" alt="default" width="36" height="36">
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->username)
                                        {{ $user->username }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->role_name)
                                        {{ $user->role_name }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->name)
                                        {{ $user->name }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->phone_number)
                                        {{ $user->phone_number }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->email)
                                        {{ $user->email }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->address)
                                        {{ $user->address }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch">
                                        @csrf
                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="{{$user->username}}" @if($user->status_id == 2) checked @endif onclick="return confirm('Yakin ingin mengganti status?');">
                                        <label class="form-check-label" for="status" name="status">
                                            @if ($user->status_id == 2)
                                                Aktif
                                            @else
                                                Nonaktif
                                            @endif
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-warning shadow-sm mb-2" href="/users/{{$user->username}}/edit"><i class="bi bi-pencil me-md-2"></i> Ubah</a>
                                    <form action="/users/{{$user->username}}/delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Yakin ingin menghapus pengguna dengan username {{ $user->username }}?');"><i class="bi bi-trash me-md-2"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Foto</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">No. Telepon</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const statusToggle = document.querySelector('.form-check-input');

    // Example POST method implementation:
    async function changeStatus(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors',
            headers: {
            'Content-Type': 'application/json',
            // 'Accept': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }

    statusToggle.addEventListener('change', function() {
        var status = this.checked == true ? 2 : 1;
        const statusLabel = document.querySelector('.form-check-label');
        var username = this.value;
        var csrf = document.getElementsByName('_token')[0].value;

        if (status == 2) {
            changeStatus(`/users/activate/${username}`, { status_id: 2, '_token': csrf, '_method': 'PATCH' });
            statusLabel.innerHTML = 'Aktif';
        } else if (status == 1) {
            changeStatus(`/users/deactivate/${username}`, { status_id: 1, '_token': csrf, '_method': 'PATCH' });
            statusLabel.innerHTML = 'Nonaktif';
        }
    });
</script>
@endsection