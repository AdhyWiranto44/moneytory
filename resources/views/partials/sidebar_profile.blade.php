<div id="company-image" class="d-flex justify-content-center my-4 overflow-hidden position-relative">
    @if ($companyLogo)
        <img class="rounded-circle" src="{{ asset('storage/img/' . $companyLogo) }}" alt="Company Logo" width="64" height="64">
        @else
        <img class="rounded-circle" src="/img/default.jpg" alt="default" width="64" height="64">
    @endif
</div>
<h5 class="company-name fw-bold text-center d-none">{{ $companyName }}</h5>