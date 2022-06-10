<?php
function menu(){
  $html = "";
  $html .="
  <head>
  <link href='assets/img/iconAmares.svg' rel='icon'>
  <link href='assets/img/apple-touch-icon.png' rel='apple-touch-icon'>
  <!-- Google Fonts -->
  <link href='https://fonts.gstatic.com' rel='preconnect'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i' rel='stylesheet'>
  <!--Vendor CSS Files-->
  
  <link href='assets/vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
  <link href='assets/vendor/bootstrap-icons/bootstrap-icons.css' rel='stylesheet'>
  <link href='assets/vendor/boxicons/css/boxicons.min.css' rel='stylesheet'>
  <link href='assets/vendor/quill/quill.snow.css' rel='stylesheet'>
  <link href='assets/vendor/quill/quill.bubble.css' rel='stylesheet'>
  <link href='assets/vendor/remixicon/remixicon.css' rel='stylesheet'>
  <link href='assets/vendor/simple-datatables/style.css' rel='stylesheet'>

  <!-- Template Main CSS File -->
  <link href='assets/css/style.css' rel='stylesheet'>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id='header' class='header fixed-top d-flex align-items-center'>

    <div class='d-flex align-items-center justify-content-between'>
      <a href='index.html' class='logo d-flex align-items-center'>
        <img src='assets/img/logoAmares.svg' alt=''>
        <span class='d-none d-lg-block'>Cobranza</span>
      </a>
      <i class='bi bi-list toggle-sidebar-btn'></i>
    </div><!-- End Logo -->

    <nav class='header-nav ms-auto'>
      <ul class='d-flex align-items-center'>

        <li class='nav-item d-block d-lg-none'>
          <a class='nav-link nav-icon search-bar-toggle ' href='#'>
            <i class='bi bi-search'></i>
          </a>
        </li><!-- End Search Icon-->


        <li class='nav-item dropdown pe-3'>

          <a class='nav-link nav-profile d-flex align-items-center pe-0' href='#' data-bs-toggle='dropdown'>
            <img src='assets/img/profile-img.jpg' alt='Profile' class='rounded-circle'>
            <span class='d-none d-md-block dropdown-toggle ps-2'>".$_SESSION["usuario"]."</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow profile'>
            <li class='dropdown-header'>
              <span>Usuario:</span>
              <h6>".$_SESSION["usuario"]."</h6>
            </li>
            <li>
              <hr class='dropdown-divider'>
            </li>

            <li>
              <a class='dropdown-item d-flex align-items-center' href='users-profile.html'>
                <i class='bi bi-person'></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class='dropdown-divider'>
            </li>

            <li>
              <a class='dropdown-item d-flex align-items-center' href='users-profile.html'>
                <i class='bi bi-gear'></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class='dropdown-divider'>
            </li>

            <li>
              <a class='dropdown-item d-flex align-items-center' href='pages-faq.html'>
                <i class='bi bi-question-circle'></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class='dropdown-divider'>
            </li>

            <li>
              <a class='dropdown-item d-flex align-items-center' href='?page=login'>
                <i class='bi bi-box-arrow-right'></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id='sidebar' class='sidebar'>

    <ul class='sidebar-nav' id='sidebar-nav'>

      <li class='nav-item'>
        <a class='nav-link ' href='?page=control'>
          <i class='bi bi-grid'></i>
          <span>Panel de Control</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class='nav-item'>
        <a class='nav-link collapsed' data-bs-target='#clientes-nav' data-bs-toggle='collapse' href='#'>
          <i class='bi bi-menu-button-wide'></i><span>Clientes</span><i class='bi bi-chevron-down ms-auto'></i>
        </a>
        <ul id='clientes-nav' class='nav-content collapse ' data-bs-parent='#sidebar-nav'>
          <li>
            <a href='?page=clientes'>
              <i class='bi bi-circle'></i><span>Detalle Clientes</span>
            </a>
          </li>

        </ul>
      </li><!-- End Components Nav -->

      <li class='nav-item'>
        <a class='nav-link collapsed' data-bs-target='#lotes-nav' data-bs-toggle='collapse' href='#'>
          <i class='bi bi-journal-text'></i><span>Lotes</span><i class='bi bi-chevron-down ms-auto'></i>
        </a>
        <ul id='lotes-nav' class='nav-content collapse ' data-bs-parent='#sidebar-nav'>
          <li>
            <a href='?page=lotes'>
              <i class='bi bi-circle'></i><span>Alta de lotes</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class='nav-item'>
      <a class='nav-link collapsed' data-bs-target='#descuentos-nav' data-bs-toggle='collapse' href='#'>
        <i class='bi bi-journal-text'></i><span>Descuentos</span><i class='bi bi-chevron-down ms-auto'></i>
      </a>
      <ul id='descuentos-nav' class='nav-content collapse ' data-bs-parent='#sidebar-nav'>
        <li>
          <a href='?page=descuentos'>
            <i class='bi bi-circle'></i><span>Administrar descuentos</span>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav -->
    <li class='nav-item'>
      <a class='nav-link collapsed' data-bs-target='#pagos-nav' data-bs-toggle='collapse' href='#'>
        <i class='bi bi-cash-coin'></i><span>Pagos</span><i class='bi bi-chevron-down ms-auto'></i>
      </a>
      <ul id='pagos-nav' class='nav-content collapse ' data-bs-parent='#sidebar-nav'>
        <li>
          <a href='?page=pagos'>
            <i class='bi bi-circle'></i><span>Gestión de Pagos</span>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav -->
      <li class='nav-item'>
        <a class='nav-link collapsed' data-bs-target='#reportes-nav' data-bs-toggle='collapse' href='#'>
          <i class='bi bi-layout-text-window-reverse'></i><span>Reportes</span><i class='bi bi-chevron-down ms-auto'></i>
        </a>
        <ul id='reportes-nav' class='nav-content collapse ' data-bs-parent='#sidebar-nav'>
          <li>
            <a href='?page=reportes'>
              <i class='bi bi-circle'></i><span>Módulo reportes</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
  </aside><!-- End Sidebar-->

  

  <a href='#' class='back-to-top d-flex align-items-center justify-content-center boton_uno'><i class='bi bi-arrow-up-short'></i></a>

  <!-- Vendor JS Files -->
  <script src='assets/vendor/apexcharts/apexcharts.min.js'></script>
  <script src='assets/vendor/bootstrap/js/bootstrap.bundle.min.js'></script>
  <script src='assets/vendor/chart.js/chart.min.js'></script>
  <script src='assets/vendor/echarts/echarts.min.js'></script>
  <script src='assets/vendor/quill/quill.min.js'></script>
  <script src='assets/vendor/simple-datatables/simple-datatables.js'></script>
  <script src='assets/vendor/tinymce/tinymce.min.js'></script>
  <script src='assets/vendor/php-email-form/validate.js'></script>

  <!-- Template Main JS File -->
  <script src='assets/js/main.js'></script>

</body>
";
echo $html;
}
?>
