@if (request()->query("tanggal_dari") || request()->query("tanggal_ke"))
    <h4 class="mb-3">
        <span class="badge text-dark shadow-sm">
            @if (request()->query("tanggal_dari"))
                Dari {{ request()->query("tanggal_dari") }}
            @endif
            @if (request()->query("tanggal_ke"))
                Sampai {{ request()->query("tanggal_ke") }}
            @endif
        </span>
    </h4>
@else
    <h4 class="mb-3"><span class="badge text-dark shadow-sm">Hari ini: {{ date('d F Y') }}</span></h4>
@endif
<small>Cari berdasarkan tanggal</small>
<form action="/" method="GET">
    <div class="row g-2">
        <div class="col input-group">
            <div class="input-group-text bg-light-secondary border-light-secondary text-secondary">Dari</div>
            <input type="date" class="form-control py-2 bg-light-secondary border-light-secondary text-secondary" id="tanggal_dari" name="tanggal_dari" placeholder="Dari" title="Dari">
        </div>
        <div class="col input-group">
            <div class="input-group-text bg-light-secondary border-light-secondary text-secondary">Ke</div>
            <input type="date" class="form-control py-2 bg-light-secondary border-light-secondary text-secondary" id="tanggal_ke" name="tanggal_ke" placeholder="Ke" title="Ke">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-outline-salmon px-3 py-2"><i class="bi bi-search me-2"></i> Cari</button>
        </div>
    </div>
</form>