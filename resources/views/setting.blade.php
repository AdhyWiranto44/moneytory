@extends('layouts.backend')

@section('content')
<div class="row p-4 w-100 h-100">
    <div class="col-md-12">
        @include('partials.title')
        <div class="row">
            <div class="col-md-6 mb-3">
                @include('partials.user_profile')
            </div>
            <div class="col-md-6 mb-3">
                @if ($userRole == 1)
                    @include('partials.company_profile')
                @endif
            </div>
        </div>
    </div>
</div>
@endsection