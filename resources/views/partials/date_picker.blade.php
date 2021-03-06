@if (request()->query("tanggal_dari") || request()->query("tanggal_ke"))
    <h4 class="mb-3">
        <span class="badge bg-light-secondary border-light-secondary text-secondary">
            @if (request()->query("tanggal_dari"))
                Dari {{ request()->query("tanggal_dari") }}
            @endif
            @if (request()->query("tanggal_ke"))
                Sampai {{ request()->query("tanggal_ke") }}
            @endif
        </span>
    </h4>
@else
    <h4 class="mb-3"><span class="badge bg-light-secondary border-light-secondary text-secondary">Hari ini: {{ date('d F Y') }}</span></h4>
@endif
<form action="{{ url()->current() }}" method="GET">
    <div class="row g-2">
        <div class="col-md-3">
            <div class="input-group-text bg-light-secondary border-light-secondary text-secondary">Dari</div>
            <input type="date" class="form-control py-2 bg-light-secondary border-light-secondary text-secondary" id="tanggal_dari" name="tanggal_dari" placeholder="Dari" title="Dari">
        </div>
        <div class="col-md-3">
            <div class="input-group-text bg-light-secondary border-light-secondary text-secondary">Ke</div>
            <input type="date" class="form-control py-2 bg-light-secondary border-light-secondary text-secondary" id="tanggal_ke" name="tanggal_ke" placeholder="Ke" title="Ke">
        </div>
        @include('partials.product_search_form')
        <div class="col-md-3">
            <button type="submit" class="btn btn-outline-salmon px-3 py-2"><i class="bi bi-search me-2"></i> Cari</button>
        </div>
    </div>
</form>