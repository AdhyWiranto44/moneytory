@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <a class="btn btn-salmon fw-bold px-3 py-2 mb-3" href="/raw-ingredients/add-new"><i class="bi bi-plus-circle me-2"></i> Tambah Baru</a>
                <div class="table-responsive">
                    <table id="example" class="display overflow-scroll">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Stok Min.</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($rawIngredients as $rawIngredient)
                            <tr>
                                <td class="text-center fw-bold"><?= $i++; ?></td>
                                <td class="text-center">
                                    @if ($rawIngredient->image)
                                        <img class="rounded-circle mx-auto" src="{{ asset('storage/img/' . $rawIngredient->image) }}" alt="Gambar Bahan Mentah" width="36" height="36">
                                    @else
                                        <img class="rounded-circle mx-auto" src="/img/default.jpg" alt="default" width="36" height="36">
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($rawIngredient->code)
                                        {{ $rawIngredient->code }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($rawIngredient->name)
                                        {{ $rawIngredient->name }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($rawIngredient->stock)
                                        {{ $rawIngredient->stock . ' ' . $rawIngredient->unit }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($rawIngredient->minimum_stock)
                                        {{ $rawIngredient->minimum_stock . ' ' . $rawIngredient->unit }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch">
                                        @csrf
                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="{{$rawIngredient->code}}" @if($rawIngredient->status_id == 2) checked @endif onclick="return confirm('Yakin ingin mengganti status?');">
                                        <label class="form-check-label" for="status" name="status">
                                            @if ($rawIngredient->status_id == 2)
                                                Aktif
                                            @else
                                                Nonaktif
                                            @endif
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-warning shadow-sm mb-2" href="/raw-ingredients/{{$rawIngredient->code}}/edit"><i class="bi bi-pencil me-md-2"></i> Ubah</a>
                                    <form action="/raw-ingredients/{{$rawIngredient->code}}/delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Yakin ingin menghapus bahan mentah ini: {{ $rawIngredient->code }}?');"><i class="bi bi-trash me-md-2"></i> Hapus</button>
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
                                <th class="text-center">Stok</th>
                                <th class="text-center">Stok Min.</th>
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
                changeStatus(`/raw-ingredients/${code}/activate`, { status_id: 2, '_token': csrf });
                statusLabel.innerHTML = 'Aktif';
            } else if (status == 1) {
                changeStatus(`/raw-ingredients/${code}/deactivate`, { status_id: 1, '_token': csrf });
                statusLabel.innerHTML = 'Nonaktif';
            }
        });
    });
</script>
@endsection