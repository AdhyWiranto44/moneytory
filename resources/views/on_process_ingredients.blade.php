@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <a class="btn btn-salmon fw-bold px-3 py-2 mb-3" href="/on-process-ingredients/add-new"><i class="bi bi-person me-2"></i> Tambah Baru</a>
                <div class="table-responsive">
                    <table id="example" class="display overflow-scroll">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tujuan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($onProcessIngredients as $onProcessIngredient)
                            <tr>
                                <td class="text-center fw-bold"><?= $i++; ?></td>
                                <td class="text-center">
                                    @if ($onProcessIngredient->image)
                                        <img class="rounded-circle d-none d-md-block mx-auto" src="{{ asset('storage/img/' . $onProcessIngredient->image) }}" alt="Gambar Bahan Mentah" width="36" height="36">
                                    @else
                                        <img class="rounded-circle d-none d-md-block mx-auto" src="/img/default.jpg" alt="default" width="36" height="36">
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($onProcessIngredient->code)
                                        {{ $onProcessIngredient->code }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($onProcessIngredient->raw_ingredient)
                                        {{ $onProcessIngredient->raw_ingredient }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($onProcessIngredient->purpose)
                                        {{ $onProcessIngredient->purpose }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($onProcessIngredient->amount)
                                        {{ $onProcessIngredient->amount . ' ' . $onProcessIngredient->unit }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-warning shadow-sm mb-2" href="/on-process-ingredients/{{$onProcessIngredient->code}}/edit"><i class="bi bi-pencil me-md-2"></i> Ubah</a>
                                    <form action="/on-process-ingredients/{{$onProcessIngredient->code}}/delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Yakin ingin menghapus bahan dalam proses ini? {{ $onProcessIngredient->code }}. Data jumlahnya akan dikembalikan ke Bahan Mentah.');"><i class="bi bi-trash me-md-2"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tujuan</th>
                                <th class="text-center">Jumlah</th>
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
    async function activate(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'PATCH', // *GET, POST, PUT, DELETE, etc.
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

    // Example POST method implementation:
    async function deactivate(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'PATCH', // *GET, POST, PUT, DELETE, etc.
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
            activate(`/users/activate/${username}`, { status_id: 2, '_token': csrf })
            .then(() => {
                console.log("Changed!");
            });
            statusLabel.innerHTML = 'Aktif';
        } else if (status == 1) {
            deactivate(`/users/deactivate/${username}`, { status_id: 1, '_token': csrf })
            .then(() => {
                console.log("Changed!");
            });
            statusLabel.innerHTML = 'Nonaktif';
        }
    });
</script>
@endsection