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
        @include('partials.title')
        <div class="row">
            <div class="col-md">
                <form action="/on-process-ingredients/{{ $onProcessIngredient->code }}/edit" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="raw_ingredient" class="form-label small mb-1 text-capitalize">bahan mentah</label>
                        <select class="form-select p-3 @error('raw_ingredient') is-invalid @enderror" aria-label="Default select example" id="raw_ingredient" name="raw_ingredient" required>
                            <option value="" selected>-- Pilih Bahan Mentah --</option>
                            @foreach ($rawIngredients as $rawIngredient)
                                @if ($rawIngredient->id == $onProcessIngredient->raw_ingredient_id)
                                    <option value="{{ $rawIngredient->id }}" selected>{{ $rawIngredient->name }}</option>
                                @else
                                    <option value="{{ $rawIngredient->id }}">{{ $rawIngredient->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('raw_ingredient')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label small mb-1 text-capitalize">kode</label>
                        <input type="text" class="form-control p-3 @error('code') is-invalid @enderror" id="code" name="code" value="{{ $onProcessIngredient->code }}" placeholder="misal: ONP001" required>
                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="purpose" class="form-label small mb-1 text-capitalize">tujuan</label>
                        <input type="text" class="form-control p-3 @error('purpose') is-invalid @enderror" id="purpose" name="purpose" value="{{ $onProcessIngredient->purpose }}" required>
                        @error('purpose')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label small mb-1 text-capitalize">jumlah</label>
                        <input type="text" class="form-control p-3 @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ $onProcessIngredient->amount }}" placeholder="sesuaikan dengan bahan mentahnya, mis. 4.4" required>
                        @error('amount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                        @enderror
                    </div>
                    @include('partials.edit_button')
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