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
  <body class="bg-light-salmon">

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 d-flex align-items-center justify-content-center">
                <form action="/user_registration" method="POST" enctype="multipart/form-data" class="login-form">
                    <h2 class="text-center fw-bold text-uppercase mb-3">company registration</h2>
                    <div class="mb-3">
                        <label for="company_name" class="form-label small mb-1 text-capitalize">company name</label>
                        <input type="text" class="form-control p-3" id="company_name" name="company_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label small mb-1 text-capitalize">company phone number</label>
                        <input type="text" class="form-control p-3" id="phone_number" name="phone_number">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label small mb-1 text-capitalize">company email</label>
                        <input type="email" class="form-control p-3" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label small mb-1 text-capitalize">company address</label>
                        <input type="text" class="form-control p-3" id="address" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label small mb-1 text-capitalize">company logo</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-salmon w-100 p-3 mt-3 fw-bold text-uppercase">register</button>
                    <p class="mt-4 text-center small">Already have an account? <a href="/login.html">Login</a></p>
                </form>
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