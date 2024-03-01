<?php
include(__DIR__ . '/../../config/config.php');
if (!isset($_SESSION)) {
    session_start();
}
;


$sql_query = "SELECT * FROM tbusuario";
$result = $conn->query($sql_query);



?>
<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->



<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Usuarios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contatos</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">


    <!-- Default box -->
    <div class="card card-solid">

        <div class="card-body pb-0">
            <div class="row">
                <?php while ($user_list = $result->fetch_assoc()): ?>
                    <?php

                    $nome_agendamento = $conn->real_escape_string($user_list['codigoSetor']); // Tratamento para evitar injeção de SQL
                    $query_setor = "SELECT nome, codigoSecretaria FROM tbsetor WHERE codigo = '$nome_agendamento'";
                    $result_user = $conn->query($query_setor);

                    if (isset($result_user)) {
                        
                        $nome_setor = $result_user->fetch_assoc();
                        $codigo_secretaria = $nome_setor['codigoSecretaria'];
                        $query_secretaria = "SELECT nome FROM tbsecretaria WHERE codigo = $codigo_secretaria";
                        $result_secretaria = $conn->query($query_secretaria);
                        $nome_secretaria = $result_secretaria->fetch_assoc();

                    } else {
                        // Tratar erro na execução da consulta
                        echo "Erro na consulta: " . $conn->error;
                    }

                    ?>

                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                <?php
                                if ($user_list['nivelPermissao'] == 1) {
                                    echo 'Usuario';
                                } elseif ($user_list['nivelPermissao'] == 2) {
                                    echo 'Administrador';
                                } ?>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>
                                                <?php echo $user_list['nome'] ?>
                                            </b></h2>
                                        <p class="text-muted text-sm"><b>Sobre: </b></p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span> Email:
                                                <?php echo $user_list['email'] ?>
                                            </li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                                Phone:
                                                <?php echo $user_list['telefone'] ?>
                                            </li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg bi-bank"></i></span>
                                                <?php echo $nome_secretaria['nome'] ?>
                                            </li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg bi-building-fill-add"></i></span> Setor:
                                                <?php echo $nome_setor['nome']; ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="https://www.vhv.rs/dpng/d/15-155087_dummy-image-of-user-hd-png-download.png"
                                            alt="user-avatar" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="index.php?page=alterarPerfil" class="btn btn-sm btn-warning">
                                        <i class="fas fa-comments"></i>Alterar perfil
                                    </a>
                                    <a onclick="confirmarExclusao(<?php echo $user_list['codigo']; ?>)"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-comments"></i>Excluir perfil
                                    </a>
                                    <a href="index.php?page=verPerfil" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> Ver perfil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
        <!-- /.card-body -->

        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<script>
    function confirmarExclusao(id) {
        // Exibe um alerta de confirmação
        var confirmacao = window.confirm("Tem certeza que deseja excluir o perfil?");

        // Se o usuário clicou em "OK" (ou seja, confirmou)
        if (confirmacao) {
            // Redireciona para a página de exclusão com o ID como parâmetro
            window.location.href = "app/model/users/excluir.php?page=excluir&id=" + id;
        }
    }
</script>