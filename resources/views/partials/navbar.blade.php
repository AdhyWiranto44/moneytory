<nav class="navbar navbar-expand-md navbar-light bg-white py-3 sticky-top py-3 border-bottom border-light border-2">
    <div class="container-fluid">
        <button type="button" class="border-0 me-3 bg-transparent" onclick="return toggleSidebar()">
            <span class="navbar-toggler-icon me-3"></span>
        </button>
        <div class="d-flex">
            <small class="me-3 d-none d-md-inline">Selamat datang, <br /><b>{{ $username }}!</b></small>
            <a class="btn btn-salmon px-3 pt-2 ms-md-3 fw-bold" href="#"><i class="bi bi-card-checklist me-2"></i> Order</a>
        </div>
        <div class="navbar-nav ms-auto d-flex align-items-center">
            <form action="/logout" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-salmon px-3 py-2 fw-bold me-md-3" onclick="return confirm('Yakin ingin keluar?');"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
            </form>
        </div>
    </div>
</nav>