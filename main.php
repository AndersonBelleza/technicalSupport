<?php
session_start();

if ($_SESSION['acceso'] == false) {
  //Login
  header('Location:index.php');
}
$nombrerol = $_SESSION['nombrerol'] ?? '';

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EXAMEN T1</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">


  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/user-account.css">
  <link rel="stylesheet" href="dist/css/switch-dark-mode.css">
  <link rel="stylesheet" href="dist/css/themes.css">
  <link rel="stylesheet" href="dist/css/preloader.css">
  <link rel="stylesheet" href="dist/css/loader.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <div class="content-xbox">
        <div class="loader-xbox"></div>
      </div>
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light text-sm">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <!-- Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <!-- Switch -->
        <li class="nav-item item-switch-darkmode ml-2">
          <div class="theme-switch-wrapper nav-link dropdown-toggle">
            <label class="theme-switch" for="checkbox-theme">
              <input type="checkbox" id="checkbox-theme" />
              <span class="slider round">
                <i class="fa fa-solid fa-sun"></i>
                <i class="fa fa-solid fa-moon"></i>
              </span>
            </label>
          </div>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- User Account: style can be found in dropdown.less -->
        <li class="nav-item dropdown user user-menu">
          <a href="#" class="nav-link text-overflow" data-toggle="dropdown">
            <img src="./images/user.png" class="user-image user-image-top" alt="User Image">
            <span class="hidden-xs "><?= $_SESSION['nombreusuario'] ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right user-menu">
            <!-- User image -->
            <li class="user-header bg-blue">
              <img src="./images/user.png" class="img-circle" alt="User Image">

              <p>
                <?= $_SESSION['nombres'] . ' ' . $_SESSION['apellidos'] ?>
                <small><?= $_SESSION['nombrerol'] ?></small>
              </p>
            </li>
            <!-- Menu Body -->
            <!-- <li class="user-body border-0">
            <div class="row-flex ">
              <a href="#" class="nav-link">Seguidores</a>
              <a href="#" class="nav-link">Seguidos</a>
              <a href="#" class="nav-link">Servicios</a>
            </div>
          </li> -->

            <li class="user-footer row-flex">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Perfil</a>
              </div>

              <div class="pull-right">
                <a class="btn btn-default btn-flat" href="controllers/Usuario.controller.php?op=cerrar-sesion">Cerrar
                  sesión</a>
              </div>
            </li>
          </ul>
        </li>

        <!-- Config -->
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-navy elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="#" alt="" class="logo">

        <span class="brand-text font-weight-bold text-center">Qhatu Wasi</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="./images/user.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Hola, <?= $_SESSION['nombres'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

            <li class="nav-item">
              <a href="main.php?view=FormVenta" class="nav-link">
                <i class="fas fa-shopping-cart nav-icon"></i>
                <p>Ventas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="main.php?view=FormCompra" class="nav-link">
                <i class="fas fa-shopping-basket nav-icon"></i>
                <p>Compras</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="main.php?view=ListKardex" class="nav-link">
                <i class="fas fa-list-ol nav-icon"></i>
                <p>Kardex</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="main.php?view=ListKardexValorizado" class="nav-link">
                <i class="fas fa-list-ol nav-icon"></i>
                <p>Kardex Valorizado</p>
              </a>
            </li>

            <?php if ($nombrerol === 'Administrador'): ?>
              <li class="nav-item">
                <a href="main.php?view=FormUsuarios" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Registrar usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="main.php?view=Graficos" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>Reportes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="main.php?view=FormProduct" class="nav-link">
                  <i class="fab fa-elementor nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper text-sm" id="content-body">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid" id="content-data">
          <!-- Aqui se cargan los datos dinamicos -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->

      <!-- Subir al inicio -->
      <a id="back-to-top" href="#content-body" class="btn btn-dark back-to-top d-none" role="button"
        aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
      </a>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark" style="overflow: hidden;">
      <!-- Control sidebar content goes here -->
      <div class="p-3 control-sidebar-content text-sm" style="height: fit-content;">
        <h5>Configuración</h5>
        <hr class="mb-2" />

        <h6>Barra lateral izquierdo</h6>

        <div class="mb-1">
          <input type="checkbox" class="mr-1" checked id="cbox-sidebar-mini">
          <span>Pequeño</span>
        </div>
        <div class="mb-1">
          <input type="checkbox" class="mr-1" id="cbox-sidebar-flat-style">
          <span>Estilo flat</span>
        </div>
        <div class="mb-4">
          <input type="checkbox" class="mr-1" id="cbox-sidebar-disable-focus">
          <span>Deshabilitar autoexpansión</span>
        </div>

        <h6>Reducir el tamaño del texto</h6>

        <div class="mb-1">
          <input type="checkbox" class="mr-1" checked id="cbox-small-text-content-wrapper">
          <span>Contenido</span>
        </div>
        <div class="mb-1">
          <input type="checkbox" class="mr-1" id="cbox-small-text-sidebar" checked>
          <span>Barra lateral (Izq, Der)</span>
        </div>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer text-sm">

    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>


  <!-- Cargar pagina incrustada -->
  <script src="./dist/js/loadweb.js"></script>

  <!-- Config theme -->
  <script src="./dist/js/config.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="js/alertas.js"></script>

  <script>
    $(document).ready(function () {
      var view = getParam("view");

      if (view != false)
        $("#content-data").load(`views/${view}.php`);
      else
        $("#content-data").load(`views/FormProduct.php`);
    });
  </script>
</body>

</html>