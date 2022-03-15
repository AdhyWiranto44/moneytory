<nav class="navbar navbar-expand-md navbar-light py-3 sticky-top py-3 border-bottom border-light border-2">
    <div class="container-fluid">
        <div class="navbarLeftMenu">
            <button type="button" class="border-0 bg-transparent" onclick="return toggleSidebar()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="btn btn-salmon px-3 py-2 ms-md-2 fw-bold" href="/products/order"><i class="bi bi-card-checklist me-2"></i> Order</a>
        </div>
        <div class="userProfile d-flex align-items-center">
            <small class="d-none d-md-inline text-end">Selamat datang! <br /><b>{{ $username }}</b></small>
            <div class="btn-group dropstart">
                <button type="button" class="btn btn-secondary dropdown-toggle border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($userImage)
                        <img class="rounded-circle me-2" src="{{ asset('storage/img/' . $userImage) }}" alt="Company Logo" width="36" height="36">
                    @else
                        <img class="rounded-circle me-2" src="/img/default.jpg" alt="default" width="36" height="36">
                    @endif
                </button>
                <ul class="dropdown-menu border-0 shadow">
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn dropdown-item px-3 py-2 fw-bold" onclick="return confirm('Yakin ingin keluar?');"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                    </form>
                </li>
                </ul>
            </div>
        </div>
        {{-- <div class="d-flex align-items-center">
            @if ($userImage)
                <img class="rounded-circle me-2 d-none d-md-block" src="{{ asset('storage/img/' . $userImage) }}" alt="Company Logo" width="36" height="36">
            @else
                <img class="rounded-circle me-2 d-none d-md-block" src="/img/default.jpg" alt="default" width="36" height="36">
            @endif
            <small class="me-3 d-none d-md-inline">Selamat datang! <br /><b>{{ $username }}</b></small>
            <a class="btn btn-salmon px-3 py-2 ms-md-3 fw-bold" href="#"><i class="bi bi-card-checklist me-2"></i> Order</a>
        </div>
        <div class="navbar-nav ms-auto d-flex align-items-center">
            <form action="/logout" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-salmon px-3 py-2 fw-bold me-md-3" onclick="return confirm('Yakin ingin keluar?');"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
            </form>
        </div> --}}
    </div>
</nav>