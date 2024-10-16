<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <img src="https://internship4you.com/assets/img/webp/login-img.webp" class="img-fluid">
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 align-items-center order-1 order-lg-2">
                                    <form action="./Controlador/login.php">
                                        <div class="divider d-flex align-items-center my-4">
                                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign in</p>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" id="form3Example3" class="form-control form-control-lg" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>"/>
                                            <label class="form-label">Email</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-3">
                                            <input type="password" id="form3Example4" class="form-control form-control-lg" value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : ''; ?>"/>
                                            <label class="form-label">Password</label>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="#!" class="text-body">Forgot password?</a>
                                        </div>

                                        <div class="text-center text-lg-start mt-4 pt-2">
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                            <label class="form-check-label">
                                                No tens compte? <a href="../Vistes/signup.view.php">Registre't!</a>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>