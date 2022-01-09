<div id="sidebar" class="sidebar bg-light-salmon position-fixed h-100 overflow-auto border-end border-light border-2" style="z-index: 1;">
    <div id="company-image" class="d-flex justify-content-center my-4 overflow-hidden position-relative">
        @if ($companyLogo)
            <img class="rounded-circle" src="{{ asset('storage/img/' . $companyLogo) }}" alt="Company Logo" width="64" height="64">
            @else
            <img class="rounded-circle" src="/img/default.jpg" alt="default" width="64" height="64">
        @endif
    </div>
    <h5 class="company-name fw-bold text-center">{{ $companyName }}</h5>
    <ul class="sidebar-menu-container">
        <li class="sidebar-menu-section mt-3">
            <ul>
                <li class="rounded-start menu-active">
                    <a class="d-flex align-items-between" href="/" title="Dashboard">
                        <i class="bi bi-speedometer2 me-3 h4"></i>
                        <p class="mb-0">Dashboard</p>
                    </a>
                </li>
                <li class="rounded-start">
                    <a class="d-flex align-items-between" href="#" title="Bahan Mentah">
                        <i class="bi bi-cart4 me-3 h4"></i>
                        <p class="mb-0">Bahan Mentah</p>
                    </a>
                </li>
                <li class="rounded-start">
                    <a class="d-flex align-items-between" href="#" title="Bahan Dalam Proses">
                        <i class="bi bi-cpu me-3 h4"></i>
                        <p class="mb-0">Bahan Dalam Proses</p>
                    </a>
                </li>
                <li class="rounded-start">
                    <a class="d-flex align-items-between" href="#" title="Barang Jadi">
                        <i class="bi bi-bag-check me-3 h4"></i>
                        <p class="mb-0">Barang Jadi</p>
                    </a>
                </li>
                <li class="rounded-start">
                    <a class="d-flex align-items-between" href="#" title="Pemasukan">
                        <i class="bi bi-arrow-down-circle me-3 h4"></i>
                        <p class="mb-0">Pemasukan</p>
                    </a>
                </li>
                <li class="rounded-start">
                    <a class="d-flex align-items-between" href="#" title="Pengeluaran">
                        <i class="bi bi-arrow-up-circle me-3 h4"></i>
                        <p class="mb-0">Pengeluaran</p>
                    </a>
                </li>
                <li class="rounded-start">
                    <a class="d-flex align-items-between" href="#" title="Hutang">
                        <i class="bi bi-emoji-dizzy me-3 h4"></i>
                        <p class="mb-0">Hutang</p>
                    </a>
                </li>
                <li class="rounded-start">
                    <a class="d-flex align-items-between" href="#" title="Pengaturan">
                        <i class="bi bi-gear me-3 h4"></i>
                        <p class="mb-0">Pengaturan</p>
                    </a>
                </li>
                {{-- <li class="rounded-start">
                    <a class="d-flex align-items-between" href="#" title="Logout">
                        <i class="bi bi-box-arrow-right me-3 h4"></i>
                        <p class="mb-0">Logout</p>
                    </a>
                </li> --}}
            </ul>
        </li>
    </ul>
</div>