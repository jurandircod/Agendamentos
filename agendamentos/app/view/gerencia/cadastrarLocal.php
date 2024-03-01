<html>
<?php
include("app/config/config.php");

$queryLocal = "SELECT * FROM tblocal";

$query = $conn->query($queryLocal);

$invalid = (isset($_GET['invalid'])) ? "is-invalid" : "";

?>

<head>
    <!-- Inclua jQuery -->
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
    <h1 class="text-center">Cadastrar locais</h1>
</div>
<div class="modal-body">
    <form action="app/model/locais/cadastrar.php" method="post">

        <div class="row mt-3">
            <div class="col">
                <label for="inputEmail4" class="form-label">Nome local:</label>
                <input type="text" name="nomeLocal" class="form-control <?php echo $invalid ?>" placeholder="Digite seu nome completo" id="">
            </div>
            <div class="col">
                <label for="">Lotação máxima</label>
                <input class="form-control <?php echo $invalid ?>" type="number" name="maximoPessoas" placeholder="Capacidade máxima de pessoas*">
            </div>
        </div>
        <div class="row mt-3">


            <div class="col">
                <label for="">Endereço</label>
                <input class="form-control <?php echo $invalid ?>" type="text" name="endereco" placeholder="Endereço*">
            </div>

            <div class="col">
                <label for="">Rua</label>
                <input class="form-control <?php echo $invalid ?>" type="text" name="endereco2" placeholder="Endereço*">
            </div>

            <div class="col">
                <label for="">Número</label>
                <input class="form-control" type="text" name="endereco3" placeholder="Endereço*">
            </div>

            <div class="col">
                <label for="">Telefone</label>
                <input type="tel" class="form-control <?php echo $invalid ?>" name="telefone" placeholder="Digite o telefone do local">
            </div>
        </div>

        <div class="row mt-3">

        </div>


        <div class="row mt-3">
            <div class="col">
                <label for="">Descrição Local</label>
                <textarea class="form-control" id="w3review" name="descricao" rows="4" cols="50" placeholder="Exemplo: Local possui 2 impressora modelo LaserJet1536 e dois projetores"></textarea>
            </div>
        </div>



        <div class="mt-3">
            <div class="mb-3">
                <button type="submit" name="enviar" class="btn btn-primary" id="enviar">Enviar</button>
            </div>
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
                                    <th>Nome do local</th>
                                    <th>Máximo de pessoas</th>
                                    <th>Endereço</th>
                                    <th>Telefone</th>
                                    <th>Funções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($rowsLocal = $query->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?php echo $rowsLocal['nomeLocal']; ?></td>
                                        <td><?php echo $rowsLocal['lotacaoMaxima']; ?>
                                        </td>
                                        <td><?php echo $rowsLocal['endereco'] ?></td>
                                        <td><?php echo $rowsLocal['telefone']; ?></td>
                                        <td>
                                            <div class="col">
                                                <a onclick="pegarId('<?php echo $rowsLocal['codigo']; ?>', '<?php echo $rowsLocal['nomeLocal']; ?>',  '<?php echo $rowsLocal['endereco'] ?>', '<?php echo $rowsLocal['lotacaoMaxima']; ?>', '<?php echo $rowsLocal['telefone']; ?>' )" class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    <i class="fas fa-comments"></i>Alterar Local
                                                </a>

                                                <a onclick="confirmarExclusao(<?php echo $rowsLocal['codigo']; ?>)" class="btn btn-sm btn-danger mt-1">
                                                    <i class="fas fa-comments"></i>Excluir Local
                                                </a>

                                            </div>
                                        </td>

                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nome do local</th>
                                    <th>Máximo de pessoas</th>
                                    <th>Endereço</th>
                                    <th>Telefone</th>
                                    <th>Funções</th>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Alterar nome do local</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="app/model/locais/alterar.php" method="post">
                    <div>
                        <input type="text" id="idLocais" name="idLocal" hidden>
                    </div>

                    <div class="name mt-3">
                        <label for="inputEmail4" class="form-label">Nome local:</label>
                        <input type="text" id="nome" name="nomeLocal" class="form-control" placeholder="Digite seu nome completo" id="">
                    </div>

                    <div class="row mt-3">


                        <div class="col">
                            <label for="">Endereço</label>
                            <input class="form-control" id="endereco" type="text" name="endereco" placeholder="Endereço*">
                        </div>

                        <div class="col">
                            <label for="">Telefone</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Digite o telefone do local">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="">Lotação máxima</label>
                            <input class="form-control" type="number" id="lotacaoMaxima" name="maximoPessoas" placeholder="Capacidade máxima de pessoas*">
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col">
                            <label for="">Descrição Local</label>
                            <textarea class="form-control" name="descricao" rows="4" cols="50" placeholder="Exemplo: Local possui 2 impressora modelo LaserJet1536 e dois projetores"></textarea>
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



<script>
    var comfirmacao;

    function confirmarExclusao(id) {
        confirmacao = window.confirm("Tem certeza que deseja excluir o loca");

        if (confirmacao == true) {
            location.href = "app/model/locais/excluir.php?idLocal=" + id;
        }
    }



    function pegarId(id, nome, endereco, lotacaoMaxima, telefone) {
        console.log(id, nome, endereco, lotacaoMaxima, telefone);
        document.getElementById('idLocais').value = id; // Usar 'value' em vez de 'innerText'
        document.getElementById("nome").value = nome;
        document.getElementById("endereco").value = endereco;
        document.getElementById("lotacaoMaxima").value = lotacaoMaxima;
        document.getElementById("telefone").value = telefone;


    }

    /*$(document).ready(function () {
    var equipamentos = [];

    // Adiciona um novo campo de equipamento quando o botão é clicado
    $("#adicionarEquipamento").click(function () {
        var equipamento = $("input[name='equipamento']").val();
        if (equipamento !== "") {
            equipamentos.push(equipamento);
            $("input[name='equipamento']").val(""); // Limpa o campo após adicionar
            atualizarListaEquipamentos();
        }
    });

    // Função para atualizar a lista de equipamentos exibida para o usuário
    function atualizarListaEquipamentos() {
        var listaEquipamentos = $("#listaEquipamentos");
        listaEquipamentos.empty(); // Limpa a lista

        // Adiciona cada equipamento à lista
        equipamentos.forEach(function (equipamento) {
            listaEquipamentos.append("<li>" + equipamento + "</li>");
        });
    }

    // Captura o evento de clique no botão de enviar
    $("#enviar").click(function () {
        // Adicione um campo oculto ao formulário para enviar os equipamentos
        $("<input>").attr({
            type: "hidden",
            name: "equipamentos",
            value: JSON.stringify(equipamentos)
        }).appendTo("form");

        // Agora, o formulário terá um campo oculto 'equipamentos' que contém a lista JSON
        // O restante do código continua como antes
    });
});*/
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


</html>