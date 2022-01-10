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

        {{-- Datatables.net CDN --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>

        <title>MoneyTory | {{ $title }}</title>
    </head>
    <body>

        @include('../partials/sidebar')
        <div id="navbar" class="marginLeft">
            @include('../partials/navbar')
            @include('partials.alert')
            @yield('content')
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
        <script>
            $(document).ready( function () {
              $('#example').DataTable();
            });
          </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        -->
  </body>
</html>