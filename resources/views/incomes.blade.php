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
                @if ($productIncome != null)
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card p-2 border-0 shadow mb-3">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-0">Kode: {{ $productIncome['code'] }}</h5>
                                    <h6 class="text-secondary mb-0">Terjual: {{ $productIncome['amount'] }}</h6>
                                    <h3 class="py-3">Rp {{ number_format($productIncome['income'], 0, ",", ".") }}</h3>
                                </div>
                                </div>
                        </div>
                    </div>
                @endif
                <a class="btn btn-salmon fw-bold px-3 py-2 mb-3" href="/incomes/add-new"><i class="bi bi-plus-circle me-2"></i> Tambah Baru</a>
                <div class="table-responsive">
                    <table id="example" class="display overflow-scroll">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Biaya Tambahan</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Dibuat Pada</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($incomes as $income)
                            <tr>
                                <td class="text-center fw-bold"><?= $i++; ?></td>
                                <td class="text-center">
                                    @if ($income->code)
                                        {{ $income->code }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($income->products)
                                        {{ $income->products }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($income->amounts)
                                        {{ $income->amounts }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($income->prices)
                                        {{ $income->prices }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($income->extra_charge)
                                        Rp {{ number_format($income->extra_charge, 0, ',', '.') }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($income->total_price)
                                        Rp {{ number_format($income->total_price, 0, ',', '.') }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($income->created_at)
                                        {{ $income->created_at }}
                                    @else
                                        <small class="text-secondary">(Kosong)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch">
                                        @csrf
                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="{{$income->code}}" @if($income->income_status_id == 2) checked @endif onclick="return confirm('Yakin ingin mengganti status?');">
                                        <label class="form-check-label" for="status" name="status">
                                            @if ($income->income_status_id == 2)
                                                Lunas
                                            @else
                                                Belum Lunas
                                            @endif
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-warning shadow-sm mb-2" href="/incomes/{{$income->code}}/edit"><i class="bi bi-pencil me-md-2"></i> Ubah</a>
                                    <form action="/incomes/{{$income->code}}/delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Yakin ingin menghapus pemasukan ini: {{ $income->code }}?');"><i class="bi bi-trash me-md-2"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Biaya Tambahan</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Dibuat Pada</th>
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
                changeStatus(`/incomes/${code}/activate`, { status_id: 2, '_token': csrf, '_method': 'PATCH' });
                statusLabel.innerHTML = 'Lunas';
            } else if (status == 1) {
                changeStatus(`/incomes/${code}/deactivate`, { status_id: 1, '_token': csrf, '_method': 'PATCH' });
                statusLabel.innerHTML = 'Belum Lunas';
            }
        });
    });
</script>
@endsection