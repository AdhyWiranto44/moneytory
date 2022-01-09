@if ($message = Session::get('success'))
    <div class="alert alert-success border-0 welcome-card shadow-sm alert-dismissible fade show position-absolute me-3 mt-3" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif ($message = Session::get('error'))
    <div class="alert alert-danger border-0 welcome-card shadow-sm alert-dismissible fade show position-absolute me-3 mt-3" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif