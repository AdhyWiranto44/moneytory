@if (Request::path() == 'incomes')
    <div class="col-md-3">
        <div class="input-group-text bg-light-secondary border-light-secondary text-secondary">Kode produk</div>
        <input type="text" class="form-control py-2 bg-light-secondary border-light-secondary text-secondary" id="code" name="code" placeholder="contoh: PROD001" title="Kode produk">
    </div>
@endif