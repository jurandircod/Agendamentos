<html>
<?php
include('app/config/config.php');


$result = $conn->query('SELECT * FROM tblocal');
$query_equip = "SELECT * FROM tbequipamento";

$result_equip = $conn->query($query_equip);

//$result_cards = $conn->query("SELECT * FROM tb_locais");
$invalid = (isset($_GET['invalid'])) ? "is-invalid" : "";

?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</head>

<h1 class="text-center">PMU Agendamentos</h1>
<div class="card">
    <div class="tab-content">
        <div class="tab-empty">

            <div class="card-body pb-0">

                <div class="row">
                    <?php while ($rowLocal = $result->fetch_assoc()) : ?>
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">

                                <div class="card-header text-muted border-bottom-0">
                                    Locais
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>
                                                    <?php echo $rowLocal["nomeLocal"] ?>
                                                </b></h2>
                                            <p class="text-muted text-sm"><b>Sobre: </b> </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                    Endereço: <?php echo $rowLocal['endereco'] ?>
                                                </li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                                    Telefone: <?php echo $rowLocal['telefone'] ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="https://umuarama.pr.gov.br/files/Umuaramas/brasao_file_image/brasao-1568920903-1571768155.png" alt="user-avatar" class=" img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right row">

                                        <div class="col">
                                            <a onclick="pegarId(<?php echo $rowLocal['codigo']; ?>)" class="btn btn-sm bg-teal" type="button" name="enviar" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                <i class="fas fa-user"></i> Agendar local
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
</div>

<div class="modal fade text-center" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <img class="" id="imgsimbolo" src="https://www.umuarama.pr.gov.br/img/logorodape.svg" alt="" style="height: 200px;">

                <form action="app/model/reservas/cadastrar.php" method="post">
                    <div class="name mt-3">
                        <label for="inputEmail4" class="form-label">Nome do evento:</label>
                        <input type="text" name="nomeEvento" class="form-control" placeholder="Exemplo: Reunião" id="">
                    </div>

                    <input type="text" id="idEvento" name="idEvento" hidden />

                    <div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="">Dia de agendamento:</label>
                                <input class="form-control" type="date" id="data" name="dia">
                            </div>
                            <div class="col">
                                <label for="">Horário inicio</label>
                                <input type="time" class="form-control" name="horaInicio" placeholder="First name" aria-label="First name">
                            </div>
                            <div class="col">
                                <label for="">Horário fim</label>
                                <input type="time" class="form-control" name="horaFim" placeholder="Last name" aria-label="Last name">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <label for="">Descrição do evento</label>
                                <textarea class="form-control" name="descricao" id="" cols="15" rows="3" placeholder="Descrição referente ao evento">
                        </textarea>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</html>

<script>
    function pegarId(id) {
        console.log(id);
        document.getElementById("idEvento").value = id;
    }
</script>

</body>
</html>
