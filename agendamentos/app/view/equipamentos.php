<?php
include('app/config/config.php');

$codigoUser = $_SESSION['codigo'];
$query_secretaria = "SELECT * FROM tbequipamento";
$query = $conn->query($query_secretaria);
$invalid = (isset($_GET['invalid'])) ? "is-invalid" : "";

$sqlReserva = "SELECT codigo, nomeEvento FROM tbreserva WHERE codigoUsuario = $codigoUser";

$resultReserva = $conn->query($sqlReserva);

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                                    <th>Nome equipamentos</th>
                                    <th>Marca</th>
                                    <th>Patrimônio</th>
                                    <th>Condição</th>
                                    <th>solicitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($rowsEquip = $query->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?php echo $rowsEquip['nome']; ?></td>
                                        <td><?php echo $rowsEquip['marca'] ?>
                                        </td>
                                        <td><?php echo $rowsEquip['patrimonio']; ?></td>
                                        <td><?php
                                            switch ($rowsEquip['condicao']) {
                                                case '1':
                                                    echo "Em bom estado";
                                                    break;
                                                case '2':
                                                    echo "Com marcas de uso";
                                                    break;
                                                case '3':
                                                    echo "Com avaria aparente";
                                                    break;
                                            }
                                            ?></td>
                                        <td><?php if ($rowsEquip['disponibilidade'] == 1) : ?>
                                                <div class="col text-center">
                                                    <a onclick="pegarId('<?php echo $rowsEquip['codigo']; ?>')" class="btn btn-sm btn-info" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        <i class="bi bi-file-zip">solicitar</i>
                                                    </a>

                                                <?php else : ?>
                                                    <h6 class="text-center">Indisponível</h6>
                                                <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nome equipamentos</th>
                                    <th>Marca</th>
                                    <th>Patrimônio</th>
                                    <th>Condição</th>
                                    <th>solicitar</th>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Alterar Equipamento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="app/model/reservasEquipamentos/cadastrar.php" method="post">


                    <input type="text" id="idEquip" name="idEquip" hidden>

                    <div class="name mt-3">
                        <label for="inputEmail4" class="form-label">Responsável pelo equipamento</label>
                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome completo" id="">
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="">Data de emprestimo</label>
                            <input class="form-control" id="marca" type="date" name="dataEmp" placeholder="Marca do equipamento">
                        </div>
                        <div class="col">
                            <label for="">Data de devolução</label>
                            <input class="form-control" id="patrimonio" type="date" name="dataDev" placeholder="Patrimonio*">
                        </div>
                    </div>


                    <div class="row">

                        <div class="input-group mt-3 col">
                            <select id="secretaria" name="evento" required minlength="3" class="form-control">
                                <option value="">Selecione o evento</option>
                                <?php while ($resRow = $resultReserva->fetch_assoc()) : ?>
                                    <option value="<?php echo $resRow['codigo']; ?>"><?php echo $resRow['nomeEvento']; ?></option>
                                <?php endwhile  ?>
                            </select>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-landmark">
                                    </span>
                                </div>
                            </div>
                        </div>
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

<script src="public/js/functionRegisters/onchange.js"></script>
<script>
    function pegarId(id) {
        console.log(id);
        document.getElementById('idEquip').value = id;
    }
</script>


<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="../../agendamentos/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../agendamentos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../agendamentos/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../agendamentos/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../agendamentos/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../agendamentos/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../agendamentos/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../agendamentos/plugins/jszip/jszip.min.js"></script>
<script src="../../agendamentos/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../agendamentos/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../agendamentos/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../agendamentos/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../agendamentos/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../agendamentos/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../agendamentos/public/js/demo.js"></script>
<!-- Page specific script -->
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

</html>