@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-salmon" href="/on-process-ingredients">Bahan Dalam Proses</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="col-lg-6 order-2 order-lg-1">
        <div class="d-flex align-items-center">
            @include('partials.title')
            <h6 class="text-secondary fw-bold ms-2">Bahan Dalam Proses</h6>
        </div>
        <div class="row">
            <div class="col-md">
                <form action="/on-process-ingredients/add-new" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="raw_ingredient" class="form-label small mb-1 text-capitalize">bahan mentah</label>
                        <select class="form-select p-3 @error('raw_ingredient') is-invalid @enderror" aria-label="Default select example" id="raw_ingredient" name="raw_ingredient" required>
                            <option value="" selected>-- Pilih Bahan Mentah --</option>
                            @foreach ($rawIngredients as $rawIngredient)
                                <option value="{{ $rawIngredient->id }}">{{ $rawIngredient->name }}</option>
                            @endforeach
                        </select>
                        @error('raw_ingredient')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="purpose" class="form-label small mb-1 text-capitalize">tujuan</label>
                        <input type="text" class="form-control p-3 @error('purpose') is-invalid @enderror" id="purpose" name="purpose" value="{{ old('purpose') }}" required>
                        @error('purpose')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label small mb-1 text-capitalize">jumlah</label>
                        <input type="text" class="form-control p-3 @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" placeholder="sesuaikan dengan bahan mentahnya, mis. 4.4" required>
                        @error('amount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    @include('partials.add_button')
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6 order-1 order-lg-2">
        <div class="card mb-3">
            <div class="card-body overflow-scroll" style="max-height: 300px;">
                <h6 class="fw-bold card-title">Ketersediaan Bahan Mentah</h5>
                    <hr class="text-salmon mt-0">
                    @foreach ($rawIngredients as $rawIngredient)
                        <div class="mb-3">
                            <p class="card-text my-0">{{ $rawIngredient->name . ", " . $rawIngredient->stock . " " . $rawIngredient->unit }}</p>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection