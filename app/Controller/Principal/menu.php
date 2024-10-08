<?php
include 'config.php';  // Sube un nivel y luego incluye config.php desde Controller

session_start();

if (!isset($_SESSION['email'])) {
    die("No estás registrado.");
}

$email = $_SESSION['email']; // Obtén el correo electrónico del usuario desde la sesión

$sql = "SELECT id, nombre, apellidos, email FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$id = "";
$nombre = "";
$apellidos = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $nombre = $row["nombre"];
        $apellidos = $row["apellidos"];
    }
} else {
    echo "No se encontraron resultados.";
}

$stmt->close();
$conn->close();
$current_page = basename($_SERVER['PHP_SELF']);


?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Cotizador - Pasto Siempre Verde</title>

    <!-- Estilos -->
    <link href="/Cotizador/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/Cotizador/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="/Cotizador/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


</head>

<style>
    .nav-item.active .nav-link {
        background-color: #4e73df;
        /* Color de fondo para el elemento activo */
        color: #ffffff;
        /* Color del texto para el elemento activo */
    }

    .collapse-item.active {
        background-color: #d1d3e2;
        /* Color de fondo para los elementos activos en la sublista */
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Sistema Cotizador <sup>0.1</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="/Cotizador/resources/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Interfaces
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php echo ($current_page == 'ver_cotizaciones.php' || $current_page == 'realizar_cotizaciones.php') ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Cotizaciones</span>
                </a>
                <div id="collapseTwo" class="collapse <?php echo ($current_page == 'ver_cotizaciones.php' || $current_page == 'realizar_cotizaciones.php') ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php echo ($current_page == 'ver_cotizaciones.php') ? 'active' : ''; ?>" href="/Cotizador/resources/Views/Cotizaciones/ver_cotizaciones.php">Ver Cotizaciones</a>
                        <a class="collapse-item <?php echo ($current_page == 'realizar_cotizaciones.php') ? 'active' : ''; ?>" href="/Cotizador/resources/Views/Cotizaciones/realizar_cotizaciones.php">Realizar Cotizacion</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administración
            </div>

            <li class="nav-item <?php echo ($current_page == 'ver_usuarios.php' || $current_page == 'registrar_usuarios.php' || $current_page == 'mi_perfil.php') ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapsePages" class="collapse <?php echo ($current_page == 'ver_usuarios.php' || $current_page == 'registrar_usuarios.php' || $current_page == 'mi_perfil.php') ? 'show' : ''; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php echo ($current_page == 'ver_usuarios.php') ? 'active' : ''; ?>" href="/Cotizador/resources/Views/Usuarios/ver_usuarios.php">Ver Usuarios</a>
                        <a class="collapse-item <?php echo ($current_page == 'registrar_usuarios.php') ? 'active' : ''; ?>" href="/Cotizador/resources/Views/Usuarios/registrar_usuarios.php">Registrar Usuario</a>
                        <a class="collapse-item <?php echo ($current_page == 'mi_perfil.php') ? 'active' : ''; ?>" href="/Cotizador/resources/Views/Usuarios/mi_perfil.php">Ver mi Pérfil</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <!-- <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nombre . " " . $apellidos ?></span>
                                <img class="img-profile rounded-circle"
                                    src="/Cotizador/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>