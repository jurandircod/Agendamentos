<!DOCTYPE html>
<html lang="en">

<?php
//deixa os campos vermelhos quando retorna um erro
include("app/config/config.php");
$invalidSenha = (isset($_GET['errorSenha'])) ? "is-invalid" : "";
$invalidEmail = (isset($_GET['errorEmail'])) ? "is-invalid" : "";

$sqlSetor = "SELECT * FROM tbsetor";
$sqlSecretaria = "SELECT * FROM tbsecretaria";

$resultSec = $conn->query($sqlSecretaria);
$resultSetor = $conn->query($sqlSetor);

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agendamentos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/css/adminlte.min.css">
  <link rel="stylesheet" href="public/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="public/plugins/toastr/toastr.min.css">
  <link rel="shortcut icon" href="https://www.umuarama.pr.gov.br/img/logorodape.svg" type="image/x-icon">
</head>

<body class="hold-transition register-page">
  <div class="register-box ">
    <div class="card card-outline card-primary ">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Prefeitura</b> <br>de umuarama</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Registrar novo usuario</p>

        <form class="myform " action="app/model//users//cadastrar.php" method="post">
          <div class="input-group mb-3">

            <input type="text" class="form-control" required minlength="2" name="nome" placeholder="Nome completo*">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">

            <input type="email" class="form-control <?php echo $invalidEmail ?>" name="email" placeholder="Email*">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <select id="secretaria" name="secretaria" required minlength="3" class="form-control">
              <option value="">Selecione a secretaria</option>
              <?php while ($secList = $resultSec->fetch_assoc()) : ?>
                <option value="<?php echo $secList['codigo']; ?>"><?php echo $secList['nome']; ?></option>
              <?php endwhile  ?>
            </select>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-landmark">
                </span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="input-group mb-3 col">
              <input type="tel"  title="Apenas números são permitidos" class="form-control" name="tel" required minlength="6" placeholder="telefone*">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-phone">
                  </span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3 col">
              <select required minlength="3" id="setor" name="setor" class="form-control">
                <option value="">Selecione o setor</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-briefcase">
                  </span>
                </div>
              </div>
            </div>

          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" required minlength="4" name="senha" placeholder="Senha*">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">

            <input type="password" name="confirm" required minlength="4" class="form-control <?php echo $invalidSenha ?>" placeholder="Digite sua senha novamente*">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                  Eu aceito os <a href="#">termos</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i>
            Entrar com Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i>
            Entrar com Google+
          </a>
        </div>

        <a href="login.php" class="text-center">Eu já possuo conta</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

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

 

  <style>
    .input-erro {
      border: 1px solid red;
    }
  </style>

  <!-- Mostrar Erros  -->
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

  if (isset($_GET['errorEmail'])) {
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
                    title: 'Erro email já esta cadastrado'
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