<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Amares Cobranza - Inicia Sesión</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!--Referencias Cesar -->
    <script type="text/javascript" src="assets/js/jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/js/login.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert2.min.css">
    <script type="text/javascript" src="assets/sweetalert/sweetalert2.min.js" ></script>
    

    <!-- Favicons -->
    <link href="assets\img\iconAmares.svg" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<script type="text/javascript">
</script>

<body>
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.php" class="logo d-flex align-items-center w-auto"><img src="./assets/img/logoAmares.svg" alt=""></a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Inicia sesión</h5>
                                        <p class="text-center small">Ingresa usuario y contraseña</p>
                                    </div>
                                    <form class="row g-3" id="iniciar_sesion" name="iniciar_sesion" method="s">
                                        <div class="col-12">
                                        <label for="yourUsername" class="form-label">Usuario</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="usuario" class="form-control" id="usuario" autocomplete="off" required>
                                            <div class="invalid-feedback">Ingresa tu nombre de usuario</div>
                                        </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Contraseña</label>
                                            <input type="password" name="password" class="form-control" autocomplete="off" id="password" required>
                                            <div class="invalid-feedback">Por favor ingresa tu contraseña</div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="button" onclick='login_usuario();'>Ingresar al sistema</button>
                                        </div>
                                        <div class="col-12">
                                        <!--<p class="small mb-0">No tienes usuario? <a href="./pages-register.html">Crea uno</a></p>-->
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ 
                                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/login.js"></script>

</body>

</html>