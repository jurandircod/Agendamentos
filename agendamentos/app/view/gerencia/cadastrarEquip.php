<?php
include('app/config/config.php');

$query_secretaria = "SELECT * FROM tbequipamento";
$query = $conn->query($query_secretaria);
$invalid = (isset($_GET['invalid'])) ? "is-invalid" : "";

?>

<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
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
<div class="text-center">
    <img class="text-center" id="imgsimbolo" src="https://www.umuarama.pr.gov.br/img/logoumuarama.svg" alt="" style="height: 150px;">
    <h1 class="text-center mt-3">Cadastrar equipamentos</h1>
</div>
<div class="modal-body">
    <form action="app/model/equipamentos/cadastrar.php" method="post">

        <div class="name mt-3">
            <label for="inputEmail4" class="form-label">Nome do Equipamento:</label>
            <input type="text" name="nome" class="form-control <?php echo $invalid ?>" placeholder="Digite seu nome completo" id="">
        </div>

        <div class="row mt-3">
            <div class="col">
                <label for="">Marca</label>
                <input class="form-control <?php echo $invalid ?>" type="text" name="marca" placeholder="Marca do equipamento">
            </div>
            <div class="col">
                <label for="">Patrimônio</label>
                <input class="form-control" type="number" name="patrimonio" placeholder="Patrimonio*">
            </div>

            <div class="col">
                <label for="">Condição do equipamento</label>
                <select name="condicao" class="form-control <?php echo $invalid ?>" id="">
                    <option value="1" select>Em bom estado</option>
                    <option value="2">Marcas de uso</option>
                    <option value="3">Com problemas aparentes</option>
                </select>
            </div>
        </div>





        <div class="mt-3 text-center">

            <button type="submit" name="enviar" class="btn btn-primary" id="enviar">Enviar</button>
        </div>
    </form>
</div>

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
                                    <th>Disponibilidade</th>
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
                                        <td>
                                            <?php
                                            switch ($rowsEquip['disponibilidade']) {
                                                case '1':
                                                    echo "Disponível";
                                                    break;
                                                case '0':
                                                    echo "Em uso";
                                                    break;
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <div class="col text-center">
                                                <?php
                                                if ($rowsEquip['disponibilidade']  == 0) : ?>
                                                    <a onclick="disponibilidade('<?php echo $rowsEquip['codigo']; ?>','<?php echo $rowsEquip['disponibilidade']; ?>')" class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-comments"></i>Ativar
                                                    </a>
                                                <?php elseif ($rowsEquip['disponibilidade'] == 1) : ?>
                                                    <a onclick="disponibilidade('<?php echo $rowsEquip['codigo']; ?>','<?php echo $rowsEquip['disponibilidade']; ?>')" class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-comments"></i>Desativar
                                                    </a>
                                                <?php endif ?>
                                                <a onclick="pegarId('<?php echo $rowsEquip['codigo']; ?>', '<?php echo $rowsEquip['nome']; ?>', '<?php echo $rowsEquip['marca']; ?>', '<?php echo $rowsEquip['patrimonio']; ?>')" class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    <i class="fas fa-comments"></i>Editar
                                                </a>
                                                <a onclick="confirmarExclusao(<?php echo $rowsEquip['codigo']; ?>)" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-comments"></i>Excluir
                                                </a>

                                            </div>
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
                                    <th>Disponibilidade</th>
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
                <form action="app/model/equipamentos/alterar.php" method="post">


                    <input type="text" id="idEquip" name="idEquip" hidden>

                    <div class="name mt-3">
                        <label for="inputEmail4" class="form-label">Nome do Equipamento:</label>
                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome completo" id="">
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="">Marca</label>
                            <input class="form-control" id="marca" type="text" name="marca" placeholder="Marca do equipamento">
                        </div>
                        <div class="col">
                            <label for="">Patrimônio</label>
                            <input class="form-control" id="patrimonio" type="number" name="patrimonio" placeholder="Patrimonio*">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="">Condição do equipamento</label>
                            <select name="condicao" class="form-control" id="">
                                <option value="">Selecione a condição</option>
                                <option value="1">Em bom estado</option>
                                <option value="2">Marcas de uso</option>
                                <option value="3">Com problemas aparentes</option>
                            </select>
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
</div>


<script>
    function confirmarExclusao(id) {
        var confirm = window.confirm('tem certeza que deseja excluir?');

        if (confirm) {
            window.location.href = "app/model/equipamentos/excluir.php?page=excluir&id=" + id;
        }
    }

    function pegarId(id, nome, marca, patrimonio) {
        console.log(id, nome, marca, patrimonio);
        document.getElementById("idEquip").value = id;
        document.getElementById("nome").value = nome;
        document.getElementById("marca").value = marca;
        document.getElementById("patrimonio").value = patrimonio;
    }

    function alterar() {
        if (confirmacao) {
            window.location.href = "app/model/secretaria/alterar.php?page=excluir&id=" + id;
        } else {
            // Código a ser executado caso o usuário cancele a exclusão
        }
    }

    function disponibilidade(id, disp) {

        window.location.href = "app/model/equipamentos/alterar.php?idEquip=" + id + "&disponibilidade=" + disp;


    }
</script>
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


</div>

</html>