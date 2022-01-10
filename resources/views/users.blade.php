@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <a class="btn btn-salmon fw-bold px-3 py-2 mb-3" href="/registration/user"><i class="bi bi-person me-2"></i> Registrasi</a>
                <table id="example" class="display overflow-scroll">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Nama</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($users as $user)
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>
                                @if ($user->image)
                                    kasih gambar
                                @else
                                <img class="rounded-circle me-2 d-none d-md-block mx-auto" src="/img/default.jpg" alt="default" width="36" height="36">
                                @endif
                            </td>
                            <td>
                                @if ($user->username)
                                    {{ $user->username }}
                                @else
                                    <small class="text-secondary">(Kosong)</small>
                                @endif
                            </td>
                            <td>
                                @if ($user->role_name)
                                    {{ $user->role_name }}
                                @else
                                    <small class="text-secondary">(Kosong)</small>
                                @endif
                            </td>
                            <td>
                                @if ($user->name)
                                    {{ $user->name }}
                                @else
                                    <small class="text-secondary">(Kosong)</small>
                                @endif
                            </td>
                            <td>
                                @if ($user->phone_number)
                                    {{ $user->phone_number }}
                                @else
                                    <small class="text-secondary">(Kosong)</small>
                                @endif
                            </td>
                            <td>
                                @if ($user->email)
                                    {{ $user->email }}
                                @else
                                    <small class="text-secondary">(Kosong)</small>
                                @endif
                            </td>
                            <td>
                                @if ($user->address)
                                    {{ $user->address }}
                                @else
                                    <small class="text-secondary">(Kosong)</small>
                                @endif
                            </td>
                            <td>
                                @if ($user->status_name)
                                    {{ $user->status_name }}
                                @else
                                    <small class="text-secondary">(Kosong)</small>
                                @endif
                            </td>
                            <td>
                                Aksi 1 Aksi 2
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Nama</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection