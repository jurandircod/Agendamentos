<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['codigo'])) {
    die("você precisa estar logado para excluir <a href='/agendamentos/login.php'> voltar para o inicio</a>");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendametos</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="public/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!--icons bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!--icons fontwelsome -->
    <link rel="stylesheet" href="public/fontawesome/fontawesome-free-6.4.2-web/css/all.min.css">
    <!-- cards -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="shortcut icon" href="https://www.umuarama.pr.gov.br/img/logorodape.svg" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand light-mode ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contatos</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="app/controller//logout.php">
                        <i class="fa-regular fa-user" href="app/controller//logout.php"></i> Sair
                    </a>
                </li>
            </ul>
        </nav>


        <!-- conteudo interno -->
        <div class="content-wrapper">
            <header>
                <?php
                switch ((@$_REQUEST['page'])) {
                    case 'userListar':
                        include("app/view/users/usersListar.php");
                        break;
                    case 'agendar':
                        include('app/view/reservar.php');
                        break;
                    case 'usuario':
                        include("app/view/users/usersListar.php");
                        break;
                    case 'cadsetor':
                        include("app/view/gerencia/cadastrarSetor.php");
                        break;
                    case 'cadsec':
                        include("app/view/gerencia/cadastrarSecretaria.php");
                        break;
                    case 'cadloc':
                        include('app/view/gerencia/cadastrarLocal.php');
                        break;
                    case 'cadEquip':
                        include('app/view/gerencia/cadastrarEquip.php');
                        break;
                    case 'equipamentos':
                        include('app/view/equipamentos.php');
                        break;
                    case 'calendario':
                        include('app/view/calendar.php');
                        break;
                    default:
                        include('app/view/users/painelUsuario.php');
                        break;
                }
                ?>
            </header>

        </div>


    </div>

    <!-- <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="">Prefeitura de Umuarama</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>-->

    <!-- barra lateral de ferramentas -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="https://www.umuarama.pr.gov.br/img/logoumuaramaBranco.svg" alt="Umuarama Logo" class="brand-image " style="opacity: .8">
            <span class="brand-text font-weight-light"><br></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <!--<img src="" class="img-circle elevation-2" alt="User Image">-->
                </div>
                <div class="info">
                    <i class="fa-regular fa-user"></i> <a href="index.php" class="">
                        <?php echo $_SESSION['nome'] ?>
                    </a>
                </div>

            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!--verificar se é o adiminstrador que está logado-->
            <?php
            if ($_SESSION['nivelPermissao'] == 2) {
                include("app/view/users/ferramentasAdministrador.php");
            } elseif ($_SESSION['nivelPermissao'] == 1) {
                include("app/view/users/ferramentasUsuario.php");
            }
            ?>

        </div>
    </aside>





    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="public/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="public/js/demo.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="plugins/toastr/toastr.min.js"></script>

</body>

<?php
if (isset($_GET['excSucess'])) {
    // Cria um bloco de script JavaScript que mostra a notificação de sucesso
    echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Exclusão realizada com sucesso'
                });
            });

            window.history.replaceState({}, document.title, window.location.pathname);
        </script>";
}


if (isset($_GET['alterSucess'])) {
    // Cria um bloco de script JavaScript que mostra a notificação de sucesso
    echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Alteração realizada com sucesso'
                });
            });

            window.history.replaceState({}, document.title, window.location.pathname);
        </script>";
}

if (isset($_GET['errorCampos'])) {
    // Cria um bloco de script JavaScript que mostra a notificação de sucesso
    echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    icon: 'error',
                    title: 'Preencha todos os campos selecionados'
                });
            });

            window.history.replaceState({}, document.title, window.location.pathname);
        </script>";
}

if (isset($_GET['sucessCad'])) {
    // Cria um bloco de script JavaScript que mostra a notificação de sucesso
    echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Cadastro Realizado com sucesso'
                });
            });

            window.history.replaceState({}, document.title, window.location.pathname);
        </script>";
}

?>

<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Usuário excluido com sucesso'
            })
        });
        $('.swalDefaultInfo').click(function() {
            Toast.fire({
                icon: 'info',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultError').click(function() {
            Toast.fire({
                icon: 'error',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultWarning').click(function() {
            Toast.fire({
                icon: 'warning',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultQuestion').click(function() {
            Toast.fire({
                icon: 'question',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
    });
</script>