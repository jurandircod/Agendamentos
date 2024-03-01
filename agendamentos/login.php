<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agendametos</title>
  <!-- Theme style -->
  <link rel="stylesheet" href="public/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!--icons bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!--icons fontwelsome -->
  <link rel="stylesheet" href="public/fontawesome/fontawesome-free-6.4.2-web/css/all.min.css">

  <link rel="stylesheet" href="public/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="public/plugins/toastr/toastr.min.css">
  <link rel="shortcut icon" href="https://www.umuarama.pr.gov.br/img/logorodape.svg" type="image/x-icon">


</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="https://www.umuarama.pr.gov.br/" class="h1"><b>Prefeitura</b> <br>de umuarama</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Preencha os campos para iniciar sua sessão</p>

        <form action="app/model//users//login.php" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="senha" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Continuar logado
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mt-2 mb-3">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Entrar com facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Entrar com o Google+
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">Esqueci minha senha</a>
        </p>
        <p class="mb-0">
          <a href="register.php" class="text-center">Registrar nova conta</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="public/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="public/dist/js/adminlte.min.js"></script>
  <script src="public/js//inputs//validaderInputs.js"></script>

  <script src="public/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="public/plugins/toastr/toastr.min.js"></script>

  <script src="public/js/functionRegisters/onchange.js"></script>

  
  


  <?php
  if (isset($_GET['sucess'])) {
    // Cria um bloco de script JavaScript que mostra a notificação de sucesso
    echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Cadastro realizado com sucesso'
                });
            });

            window.history.replaceState({}, document.title, window.location.pathname);
        </script>";
  }

  if (isset($_GET['errorLogin'])) {
    // Cria um bloco de script JavaScript que mostra a notificação de sucesso
    echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    icon: 'warning',
                    title: 'Email ou senha incorretos, tente novamente'
                });
            });

            window.history.replaceState({}, document.title, window.location.pathname);
        </script>";
  }

  if (isset($_GET['errorSenha'])) {
    // Cria um bloco de script JavaScript que mostra a notificação de sucesso
    echo "<script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 5000
                });

                Toast.fire({
                    icon: 'warning',
                    title: 'As senhas devem ser iguais'
                });
            });

            window.history.replaceState({}, document.title, window.location.pathname);
        </script>";
  }

  ?>

</body>



</html>