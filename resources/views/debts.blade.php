@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <a class="btn btn-salmon fw-bold px-3 py-2 mb-3" href="/debts/add-new"><i class="bi bi-plus-circle me-2"></i> Tambah Baru</a>
                <div class="table-responsive">
                    <table id="example" class="display overflow-scroll">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Biaya</th>
                                <th class="text-center">Atas Nama</th>
                                <th class="text-center">No. Telepon</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($debts as $debt)
                            <tr>
                                <td class="text-center fw-bold"><?= $i++; ?></td>
                                <td class="text-center">
                                    @if ($debt->code)
                                        {{ $debt->code }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($debt->name)
                                        {{ $debt->name }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($debt->description)
                                        {{ $debt->description }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($debt->price)
                                        Rp {{ number_format($debt->price, 0, ',', '.') }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($debt->on_behalf_of)
                                        {{ $debt->on_behalf_of }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($debt->phone_number)
                                        {{ $debt->phone_number }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($debt->address)
                                        {{ $debt->address }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($debt->type)
                                        {{ $debt->type }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch">
                                        @csrf
                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="{{$debt->code}}" @if($debt->debt_status_id == 2) checked @endif onclick="return confirm('Yakin ingin mengganti status?');">
                                        <label class="form-check-label" for="status" name="status">
                                            @if ($debt->debt_status_id == 2)
                                                Lunas
                                            @else
                                                Berhutang
                                            @endif
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-warning shadow-sm mb-2" href="/debts/{{$debt->code}}/edit"><i class="bi bi-pencil me-md-2"></i> Ubah</a>
                                    <form action="/debts/{{$debt->code}}/delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Yakin ingin menghapus hutang ini: {{ $debt->code }}?');"><i class="bi bi-trash me-md-2"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Biaya</th>
                                <th class="text-center">Atas Nama</th>
                                <th class="text-center">No. Telepon</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Jenis</th>
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
    const formChecks = document.getElementsByClassName('form-check');
    
    async function changeStatus(url = '', data = {}) {
        const response = await fetch(url, {
            method: 'PATCH',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        return response.json();
    }

    Array.from(formChecks).forEach(formCheck => {
        const statusToggle = formCheck.querySelector('.form-check-input');
        const statusLabel = formCheck.querySelector('.form-check-label');
        const csrf = formCheck.querySelector('input[name="_token"]').value;

        statusToggle.addEventListener('change', function() {
            var status = this.checked == true ? 2 : 1;
            var code = this.value;

            if (status == 2) {
                changeStatus(`/debts/${code}/activate`, { status_id: 2, '_token': csrf });
                statusLabel.innerHTML = 'Lunas';
            } else if (status == 1) {
                changeStatus(`/debts/${code}/deactivate`, { status_id: 1, '_token': csrf });
                statusLabel.innerHTML = 'Berhutang';
            }
        });
    });
</script>
@endsection