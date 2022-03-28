@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <a class="btn btn-salmon fw-bold px-3 py-2 mb-3" href="/products/add-new"><i class="bi bi-plus-circle me-2"></i> Tambah Baru</a>
                <div class="table-responsive">
                    <table id="example" class="display overflow-scroll">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Harga Modal</th>
                                <th class="text-center">Untung</th>
                                <th class="text-center">Diskon</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Stok Min.</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($products as $product)
                            <tr>
                                <td class="text-center fw-bold"><?= $i++; ?></td>
                                <td class="text-center">
                                    @if ($product->image)
                                        <img class="rounded-circle mx-auto" src="{{ asset('storage/img/' . $product->image) }}" alt="Gambar Bahan Mentah" width="36" height="36" onclick="window.open('{{ asset('storage/img/' . $product->image) }}')">
                                    @else
                                        <img class="rounded-circle mx-auto" src="/img/default.jpg" alt="default" width="36" height="36">
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->code)
                                        {{ $product->code }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->name)
                                        {{ $product->name }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->base_price)
                                        Rp {{ number_format($product->base_price, 0, ',', '.') }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->profit)
                                        Rp {{ number_format($product->profit, 0, ',', '.') }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->discount)
                                        {{ $product->discount . " %" }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->stock)
                                        {{ $product->stock . ' ' . $product->unit }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->minimum_stock)
                                        {{ $product->minimum_stock . ' ' . $product->unit }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch">
                                        @csrf
                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="{{$product->code}}" @if($product->status_id == 2) checked @endif onclick="return confirm('Yakin ingin mengganti status?');">
                                        <label class="form-check-label" for="status" name="status">
                                            @if ($product->status_id == 2)
                                                Aktif
                                            @else
                                                Nonaktif
                                            @endif
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-warning shadow-sm mb-2" href="/products/{{$product->code}}/edit"><i class="bi bi-pencil me-md-2"></i> Ubah</a>
                                    <form action="/products/{{$product->code}}/delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Yakin ingin menghapus barang jadi ini: {{ $product->code }}?');"><i class="bi bi-trash me-md-2"></i> Hapus</button>
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
                                <th class="text-center">Harga Modal</th>
                                <th class="text-center">Untung</th>
                                <th class="text-center">Diskon</th>
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
            method: 'POST',
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
                changeStatus(`/products/${code}/activate`, { status_id: 2, '_token': csrf, '_method': 'PATCH' });
                statusLabel.innerHTML = 'Aktif';
            } else if (status == 1) {
                changeStatus(`/products/${code}/deactivate`, { status_id: 1, '_token': csrf, '_method': 'PATCH' });
                statusLabel.innerHTML = 'Nonaktif';
            }
        });
    });
</script>
@endsection