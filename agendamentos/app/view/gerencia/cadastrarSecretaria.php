<?php
include('app/config/config.php');

$sqlSec = "SELECT * FROM tbsecretaria ORDER BY nome";

$resultSec = $conn->query($sqlSec);


?>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</head>


<section class="content">
    <h1 class="text-center mb-4 ">Cadastrar Secretaria</h1>
    <form action="app/model/secretaria/cadastrar.php" method="get" class="form">
        <div class="form-group">
            <input type="text" name="nomeSecretaria" class="form-control " id="inputName" placeholder="cadastrar secretarias">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary ml-3">Cadastrar</button>
        </div>
    </form>

</section>


<h1 class="text-center mt-4">Secretarias Cadastradas</h1>


<!-- Post -->
<section class="content">
    <!-- Default box -->
    <div class="card card-solid">

        <div class="card-body pb-0">
            <div class="row">

                <?php while ($seclist = $resultSec->fetch_assoc()) : ?>
                    <!-- cards-->
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">

                            </div>
                            <div class="card-body pt-0">




                                <div class="row">
                                    <div class="col-7 ">
                                        <h2 class="lead"><b>
                                                <?php echo $seclist['nome']; ?>
                                            </b>
                                        </h2>
                                        <p class="text-muted text-sm"><b>Setores </b></p>

                                        <div>
                                            <?php
                                            $codigo_secretaria = $seclist['codigo'];

                                            $list_setor_names = "SELECT nome FROM tbsetor WHERE codigoSecretaria = $codigo_secretaria ORDER BY nome";

                                            $rows_sets = $conn->query($list_setor_names);

                                            while ($names_setor = $rows_sets->fetch_assoc()) :
                                            ?>

                                                <ul class="ml-4 mb-0 fa-ul text-muted d-flex">
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                        <?php echo $names_setor['nome'] ?>
                                                    </li>

                                                </ul>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a onclick="pegarId('<?php echo $seclist['codigo'] ?>')" type="button" class="col btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <i class="fas fa-comments"></i>Alterar nome da Secretaria
                                    </a>
                                    <a onclick="confirmarExclusao('<?php echo $seclist['codigo'] ?>')" class="mt-1 col btn btn-sm btn-danger">
                                        <i class="fas fa-comments"></i>Excluir Local
                                    </a>
                                </div>
                            </div>


                        </div>


                    </div>
                <?php endwhile; ?>
            </div>
        </div>

    </div>




    <!-- /.card -->
</section>
<!-- /.post -->



<style>
    .content {
        width: 100%;


    }

    .form {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<!-- Modal -->


<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Alterar Secretaria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="app/model/secretaria/alterar.php" method="post">
                    <div>

                        <input type="text" id="idSecretaria" name="idSecretaria" hidden>

                        <label for="">Alterar nome da secretaria</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome da secretária" required />

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary ">Enviar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    var confirmacao; // Variável global para armazenar a confirmação

    function confirmarExclusao(id) {
        confirmacao = window.confirm('Tem certeza que deseja excluir?');
        if (confirmacao) {
            window.location.href = "app/model/secretaria/excluir.php?page=excluir&id=" + id;
        }
    }

    function pegarId(id) {
        confirmacao = window.confirm('Tem certeza que deseja alterar?');

        if (confirmacao) {
            document.getElementById('idSecretaria').value = id; // Usar 'value' em vez de 'innerText'
            console.log(id);
        }
    }
</script>


</html>