<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="/vendor/bootstrap-5.1.3/css/bootstrap.min.css" rel="stylesheet">

        <!-- My CSS -->
        <link rel="stylesheet" href="/css/backend-style.css">
        <link rel="stylesheet" href="/css/style.css">

        <!-- Bootstrap 5 Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <title>MoneyTory</title>
    </head>
    <body">

        <div id="sidebar" class="sidebar bg-light-salmon position-fixed h-100 overflow-auto border-end border-light border-2" style="z-index: 1;">
            <div id="company-image" class="d-flex justify-content-center my-4 overflow-hidden position-relative">
                <img class="rounded-circle" src="/img/default.jpg" alt="default" width="64" height="64">
            </div>
            <h5 class="company-name fw-bold text-center">Kotlin Tbk.</h5>
            <ul class="sidebar-menu-container">
                <li class="sidebar-menu-section mt-3">
                    <ul>
                        <li class="rounded-start menu-active">
                            <a class="d-flex align-items-between" href="/dashboard.html" title="Dashboard">
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
                        <li class="rounded-start">
                            <a class="d-flex align-items-between" href="#" title="Logout">
                                <i class="bi bi-box-arrow-right me-3 h4"></i>
                                <p class="mb-0">Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div id="navbar" class="marginLeft">
            <nav class="navbar navbar-expand-md navbar-light bg-white py-3 sticky-top py-3 border-bottom border-light border-2">
                <div class="container">
                    <button type="button" class="border-0 me-3 bg-transparent" onclick="return toggleSidebar()">
                        <span class="navbar-toggler-icon mx-3"></span>
                    </button>
                    <div class="d-flex">
                        <small class="me-3 d-none d-md-inline">Selamat datang, <br /><b>Administrator!</b></small>
                        <a class="btn btn-salmon px-3 pt-2 ms-md-3 fw-bold" href="#"><i class="bi bi-card-checklist me-2"></i> Order</a>
                    </div>
                    <div class="navbar-nav ms-auto d-flex align-items-center">
                        <form action="#" method="POST">
                            <button type="submit" class="btn btn-outline-salmon px-3 py-2 fw-bold me-md-3" onclick="return confirm('Yakin ingin keluar?');"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                        </form>
                    </div>
                </div>
            </nav>
        
            <div class="row p-4 w-100 h-100">
                <div class="col-md-12">
                    <h2 class="fw-bold mb-3">Dashboard</h2>
                    <div class="row mb-5">
                        <div class="col-md-8">
                            <small>Cari berdasarkan tanggal</small>
                            <form action="/dashboard.html" method="POST">
                                <div class="row g-2">
                                    <div class="col input-group">
                                        <div class="input-group-text bg-light-secondary border-light-secondary text-secondary">Dari</div>
                                        <input type="date" class="form-control py-2 bg-light-secondary border-light-secondary text-secondary" id="tanggal_dari" name="tanggal_dari" placeholder="Dari" title="Dari">
                                    </div>
                                    <div class="col input-group">
                                        <div class="input-group-text bg-light-secondary border-light-secondary text-secondary">Ke</div>
                                        <input type="date" class="form-control py-2 bg-light-secondary border-light-secondary text-secondary" id="tanggal_ke" name="tanggal_ke" placeholder="Ke" title="Ke">
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-outline-salmon px-3 py-2"><i class="bi bi-search me-2"></i> Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card p-2 border-0 shadow mb-3">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-between justify-content-center">
                                        <i class="bi bi-arrow-down-circle me-2 h4 text-success"></i> 
                                        <h5 class="fw-bold mb-0">Pemasukan</h5>
                                    </div>
                                    <h3 class="py-3">Rp 100.000</h3>
                                    <a href="#" class=" btn btn-light px-3 text-decoration-none text-secondary"><small>Detail</small></a>
                                </div>
                              </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card p-2 border-0 shadow mb-3">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-between justify-content-center">
                                        <i class="bi bi-arrow-up-circle me-2 h4 text-danger"></i> 
                                        <h5 class="fw-bold mb-0">Pengeluaran</h5>
                                    </div>
                                    <h3 class="py-3">Rp 25.450</h3>
                                    <a href="#" class=" btn btn-light px-3 text-decoration-none text-secondary"><small>Detail</small></a>
                                </div>
                              </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card p-2 border-0 shadow mb-3">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-between justify-content-center">
                                        <i class="bi bi-emoji-dizzy me-2 h4 text-secondary"></i> 
                                        <h5 class="fw-bold mb-0">Hutang</h5>
                                    </div>
                                    <h3 class="py-3">Rp 14.400</h3>
                                    <a href="#" class=" btn btn-light px-3 text-decoration-none text-secondary"><small>Detail</small></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="/vendor/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="/js/backend-script.js"></script>
    <script src="https://unpkg.com/fast-average-color/dist/index.min.js"></script>
    <script>
        const fac = new FastAverageColor();
        const container = document.querySelector('#company-image');
        const image = container.querySelector('img');

        fac.getColorAsync(image)
            .then(color => {
                // container.style.backgroundColor = color.rgba;
                container.style.filter = `drop-shadow(0px 4px 10px ${color.rgba})`;
                container.style.color = color.isDark ? '#fff' : '#000';
            })
            .catch(e => {
                console.log(e);
            });
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>