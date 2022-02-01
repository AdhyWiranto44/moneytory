@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <div class="row mb-5">
                    <div class="col-md-8">
                        @include('partials.date_picker')
                    </div>
                </div>
                <a class="btn btn-salmon fw-bold px-3 py-2 mb-3" href="/expenses/add-new"><i class="bi bi-plus-circle me-2"></i> Tambah Baru</a>
                <div class="table-responsive">
                    <table id="example" class="display overflow-scroll">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Bukti Pengeluaran</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Biaya</th>
                                <th class="text-center">Dibuat Pada</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($expenses as $expense)
                            <tr>
                                <td class="text-center fw-bold"><?= $i++; ?></td>
                                <td class="text-center">
                                    @if ($expense->code)
                                        {{ $expense->code }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($expense->image)
                                        <img class="rounded-circle d-none d-md-block mx-auto" src="{{ asset('storage/img/' . $expense->image) }}" alt="Bukti Pengeluaran" width="36" height="36">
                                    @else
                                        <img class="rounded-circle d-none d-md-block mx-auto" src="/img/default.jpg" alt="default" width="36" height="36">
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($expense->name)
                                        {{ $expense->name }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($expense->description)
                                        {{ $expense->description }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($expense->cost)
                                        Rp {{ number_format($expense->cost, 0, ',', '.') }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($expense->created_at)
                                        {{ $expense->created_at }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-warning shadow-sm mb-2" href="/expenses/{{$expense->code}}/edit"><i class="bi bi-pencil me-md-2"></i> Ubah</a>
                                    <form action="/expenses/{{$expense->code}}/delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Yakin ingin menghapus barang jadi ini: {{ $expense->code }}?');"><i class="bi bi-trash me-md-2"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Bukti Pengeluaran</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Biaya</th>
                                <th class="text-center">Dibuat Pada</th>
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
        var code = this.value;
        var csrf = document.getElementsByName('_token')[0].value;

        if (status == 2) {
            activate(`/expenses/${code}/activate`, { status_id: 2, '_token': csrf })
            .then(() => {
                console.log("Changed!");
            });
            statusLabel.innerHTML = 'Aktif';
        } else if (status == 1) {
            deactivate(`/expenses/${code}/deactivate`, { status_id: 1, '_token': csrf })
            .then(() => {
                console.log("Changed!");
            });
            statusLabel.innerHTML = 'Nonaktif';
        }
    });
</script>
@endsection