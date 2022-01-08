<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/vendor/bootstrap-5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <title>MoneyTory</title>
  </head>
  <body>
    
    <div class="container-fluid">
        <div class="row position-absolute h-100 w-100 overflow-hidden">
            <div class="col-lg-6 bg-light-salmon login d-flex align-items-center justify-content-center">
                <form action="/login" method="POST" class="login-form">
                    <h2 class="text-center fw-bold text-uppercase mb-3">login</h1>
                    <div class="mb-3">
                        <label for="username" class="form-label small mb-1">username</label>
                        <input type="text" class="form-control p-3" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label small mb-1">password</label>
                        <input type="password" class="form-control p-3" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-salmon w-100 p-3 mt-3 fw-bold text-uppercase">login</button>
                    <p class="mt-4 text-center small">Don’t have an account? <a href="/user_registration.html">Register</a></p>
                </form>
            </div>
            <div class="col-lg-6 d-none d-lg-block p-0 overflow-hidden">
                <img class="w-100 h-100" src="/img/login_bg.jpg" alt="login_bg" style="object-fit: cover;">
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="/vendor/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>