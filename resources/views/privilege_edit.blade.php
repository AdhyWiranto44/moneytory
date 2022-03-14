@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="text-salmon" href="/roles">Role</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="col-lg-6">
        <div class="d-flex align-items-center">
            @include('partials.title')
            <h6 class="text-secondary fw-bold ms-2">Hak Akses: {{ $role->name }}</h6>
        </div>
        <div class="row">
            <div class="col-md">
                <form action="/privileges/{{ $role->name }}/edit" method="POST">
                    @csrf
                    @method('PATCH')
                    <?php $i = 1; ?>
                    <input type="hidden" name="role" value="{{ $role_id }}">
                    @foreach ($menu_privileges as $menu_privilege)
                        @if ($privileges->firstWhere('menu_id', $menu_privilege->id) != null)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $menu_privilege->id }}" name="{{ $menu_privilege->id }}" id="privilege{{$i}}" checked>
                                <label class="form-check-label" for="privilege{{$i}}">
                                    {{ $menu_privilege->name }}
                                </label>
                            </div>
                        @else
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $menu_privilege->id }}" name="{{ $menu_privilege->id }}" id="privilege{{$i}}">
                                <label class="form-check-label" for="privilege{{$i}}">
                                    {{ $menu_privilege->name }}
                                </label>
                            </div>
                        @endif
                        <?php $i++; ?>
                    @endforeach
                    @include('partials.edit_button')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection