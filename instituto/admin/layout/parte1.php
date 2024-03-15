<?php
session_start();
if (isset($_SESSION['sesion_email'])) {
    // echo "el usuario paso por el login";
    $email_sesion = $_SESSION['sesion_email'];
    $query_sesion = $pdo->prepare("SELECT * FROM alumnos where email = '$email_sesion' ");
    $query_sesion->execute();
    $datos_sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);

    foreach ($datos_sesion_usuarios as $datos_sesion_usuario) {
        $nombre_sesion_usuario = $datos_sesion_usuario['email'];
        $id_sesion_usuario = $datos_sesion_usuario['idAlumno'];
    }
} else {
    echo "el usuario no paso por el login";
    header('Location:' . APP_URL . "/login");
}
// include('../app/controladores/carrito/carritosListadoControlador.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME ?></title>

    <!-- jQuery -->
    <script src="<?= APP_URL; ?>/public/plugins/jquery/jquery.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/dist/css/adminlte.min.css">
    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- datatables -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= APP_URL ?>/admin" class="nav-link"><?= APP_NAME; ?></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
    <a class="nav-link" data-widget="fullscreen" href="<?= APP_URL; ?>admin/carrito" role="button" style="font-size: 20px;">
        <i class="bi bi-cart-check-fill" style="font-size: 20px;"></i> <!-- Icono -->
        <!-- <?php
            $contador = 0;
            foreach ($carritos as $carrito) {
                if ( $carrito['alumnoId'] == $id_sesion_usuario) {
                $contador = $contador + 1;
                    
                }else{
                    $contador = 0;
                }
            }
        ?>
        <span style="font-size: 20px;"><?= $contador ?></span> Contador -->
    </a>
</li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= APP_URL; ?>/admin" class="brand-link">
                <img src="<?= APP_URL; ?>/public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">COAX Academic</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= APP_URL; ?>/public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $nombre_sesion_usuario ?></a>
                    </div>
                </div>


                <!--  Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="fa-solid fa-layer-group"></i></i>
                                <p>
                                    Roles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= APP_URL ?>/admin/roles" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inactive Page</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-people-fill"></i></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= APP_URL ?>/admin/usuarios" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de usuarios</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="fas fa-school"></i></i>
                                <p>
                                    Niveles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= APP_URL ?>/admin/niveles" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de niveles</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-bar-chart-steps"></i></i>
                                <p>
                                    grados
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= APP_URL ?>/admin/grados" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de grados</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-journals"></i></i>
                                <p>
                                    Materias
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= APP_URL ?>/admin/materias" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Materias</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-person-lines-fill"></i>
                                </i>
                                <p>
                                    Personal administrativo
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= APP_URL ?>/admin/administrativos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de P. Administrativo</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-person-workspace"></i>
                                </i>
                                <p>
                                    Docentes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= APP_URL ?>/admin/docentes" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Docentes</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= APP_URL ?>/admin/docentes/asignacion.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Asignacion de Materias</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= APP_URL ?>/admin/calificaciones" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-star-fill"></i></i>
                                <p>
                                    Calificaciones

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= APP_URL ?>/admin/kardex" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-journal-check"></i>
                                </i>
                                <p>
                                    Kardex

                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-backpack-fill"></i>
                                </i>
                                <p>
                                    Estudiantes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= APP_URL ?>/admin/inscripciones" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Incripción de estudiantes</p>
                                    </a>
                                    <a href="<?= APP_URL ?>/admin/estudiantes" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Estudiantes</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-cash-coin"></i>
                                </i>
                                <p>
                                    Pagos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= APP_URL ?>/admin/pagos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Realizar Pago</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="<?= APP_URL ?>/admin/configuraciones" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-gear-fill"></i></i>
                                <p>
                                    Configuraciones

                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="<?= APP_URL; ?>/login/logout.php" class="nav-link bg-danger">
                                <i class="nav-icon fas"><i class="bi bi-door-open-fill"></i></i>
                                <p>
                                    Cerrar sesión
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>