<?php
include('app/config/config.php');
$sqlSetor = "SELECT * FROM tbsecretaria ORDER BY nome";
$resultSetor = $conn->query($sqlSetor);

$sqlSec = "SELECT * FROM tbsetor ";
$resultSec = $conn->query($sqlSec);

?>
<html>
<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../agendamentos/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../agendamentos/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../agendamentos/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../agendamentos/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../agendamentos/public/css/adminlte.min.css">

</head>
<section class="content">
    <h1 class="text-center mb-4">Cadastrar setores</h1>
    <form action="app/model/setor/cadastrar.php">
        <div class="row form">
            <div class="form-group">
                <label class="form-label" for="">Nome do setor</label>
                <input type="text" class="form-control " id="inputName" name="nomeSetor" placeholder="cadastrar setores">
            </div>
            <div class="form-group ml-3" class="sec">
                <label class="form-label" for="">Selecione a Secretaria</label>
                <select name="secretaria" required minlength="3" class="form-control">
                    <option value="" placeholder="sadasd" selected>Selecione a Secretaria</option>
                    <?php while ($seclist = $resultSetor->fetch_assoc()) : ?>
                        <option value="<?php echo $seclist['codigo']; ?>">
                            <?php echo $seclist['nome']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="form">
            <button type="submit" class="btn btn-primary ml-3">Cadastrar setor</button>
        </div>
    </form>
</section>


<section class="content">
    <div class="container-fluid">
        <h1 class="text-center">Listar equipamentos</h1>
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listar equipamentos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome do setor</th>
                                    <th>Nome da secretaria</th>
                                    <th >Funções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($setores = $resultSec->fetch_assoc()) : ?>
                                    <?php
                                    $query_secretaria = "SELECT nome FROM tbsecretaria WHERE codigo = $setores[codigoSecretaria]";
                                    $query = $conn->query($query_secretaria);
                                    $result = $query->fetch_assoc();
                                    ?>



                                    <tr>
                                        <td><?php echo $setores['nome']; ?></td>
                                        <td><?php echo $result['nome'] ?>
                                        <td>
                                            <div class="col">
                                                <a onclick="pegarId(<?php echo $setores['codigo']; ?>)" class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    <i class="fas fa-comments"></i>Alterar nome do Setor
                                                </a>
                                                <a onclick="confirmarExclusao(<?php echo $setores['codigo']; ?>)" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-comments"></i>Excluir Setor
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nome do setor</th>
                                    <th>Nome da secretaria</th>
                                    <th>Função</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>



<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Alterar nome do setor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="app/model/setor/alterar.php" method="post">
                    <div>

                        <input type="text" id="idSetor" name="idSetor" hidden>

                        <label for="">Alterar nome do setor</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome do setor" required />

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



<!-- /.card -->

<!-- /.post -->

<script>
    function confirmarExclusao(id) {
        // Exibe um alerta de confirmação
        var confirmacao = window.confirm("Os usuario cadastrados nesse setor serão excluidos após a confirmação! tem certeza da exclusão do setor ?");

        if (confirmacao == true) {
            // Redireciona para a página de exclusão com o ID como parâmetro
            window.location.href = "app/model/setor/excluir.php?page=excluir&id=" + id;
        }

    }
</script>
<style>
    .content {
        width: 100%;


    }

    .form {
        display: flex;
        justify-content: center;

    }
</style>


<script>
    var confirmacao; // Variável global para armazenar a confirmação

    function pegarId(id) {



        document.getElementById('idSetor').value = id; // Usar 'value' em vez de 'innerText'
        console.log(id);

    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/../agendamentos/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/../"></script>
<script src="/../agendamentos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/../agendamentos/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/../agendamentos/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/../agendamentos/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/../agendamentos/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/../agendamentos/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/../agendamentos/plugins/jszip/jszip.min.js"></script>
<script src="/../agendamentos/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/../agendamentos/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/../agendamentos/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/../agendamentos/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/../agendamentos/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="/../agendamentos/dist/js/adminlte.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<!-- AdminLTE for demo purposes -->
</html>