<?php
$nome =  $_SESSION['nome'];
$telefone = $_SESSION['telefone'];
$email = $_SESSION['email'];

$idUser = $_SESSION['codigo'];
include('app/config/config.php');

$query = "SELECT * FROM tbreserva WHERE codigoUsuario = $idUser";


$result = $conn->query($query);
$numrows = $result->num_rows;
?>

<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perfil</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Ínicio</a></li>
                    <li class="breadcrumb-item active">Usúario</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_640.png" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?php echo $nome ?></h3>

                        <p class="text-muted text-center">telefone: <?php echo $telefone ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Agendamentos feitos</b> <a class="float-right"><?php echo $numrows ?></a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-warning btn-block"><b>Alterar</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->

                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Alterar dados</a></li>

                            <li class="nav-item"><a class="nav-link" href="#user" data-toggle="tab">Equipamentos</a></li>

                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Agendamentos</a></li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <!-- Post -->
                                <div class="tab-content">
                                    <div class="tab-empty">
                                        <div class="card-body pb-0">
                                            <div class="row">
                                                <?php while ($result_reserva = $result->fetch_assoc()) : ?>
                                                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                        <div class="card bg-light d-flex flex-fill">
                                                            <div class="card-header text-muted border-bottom-0">
                                                                <?php echo $result_reserva['nomeEvento'] ?>
                                                            </div>
                                                            <?php

                                                            $data_inicio = new DateTime($result_reserva['dataHorarioInicio']);
                                                            $hora_inicio = $data_inicio->format('H:i');

                                                            $dia = $data_inicio->format('d/m/y');

                                                            $data_final = new DateTime($result_reserva['dataHorarioFim']);
                                                            $hora_fim = $data_final->format('H:i'); ?>

                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h2 class="lead"><b><?php echo $result_reserva['nomeEvento'] ?></b></h2>
                                                                        <ul class="ml-4  fa-ul text-muted">
                                                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dia: <?php echo $dia ?> </li>
                                                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Começo do evento: <?php echo $hora_inicio ?> </li>
                                                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Fim do evento: <?php echo $hora_fim ?> </li>
                                                                            <li class="small"><span class="fa-li"></span></li>
                                                                        </ul>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <a href="app/model/reservas/excluir.php?id=<?php echo $result_reserva['codigo'] ?>" class="btn bg-danger">
                                                                            <i class="fas fa-comments"></i>Excluir
                                                                        </a>
                                                                    </div>
                                                                    <div class="col">
                                                                        <a href="#" class="btn bg-warning">
                                                                            <i class="fas fa-user"></i> Alterar
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endwhile; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->

                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="activity">
                                <h1 class="text-center mb-4"> Alterar dados</h1>
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" value="<?php echo $nome ?>" placeholder="<?php echo $nome ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" value="<?php echo $email ?>" placeholder="Email">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Telefone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?php echo $telefone ?>" id="inputSkills" placeholder="Skills">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="user">
                                <h1 class="text-center mb-4"> Equipamentos </h1>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <?php ?>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Equipamentos
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">impressora</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

</html>