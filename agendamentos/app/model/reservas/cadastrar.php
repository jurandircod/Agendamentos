
<?php
if(!isset($_SESSION)){
    session_start();
}

if((strlen($_POST['dia']) > 1) && (strlen($_POST['horaInicio']) > 1) && (strlen($_POST['horaFim']) > 1) && (strlen($_POST['nomeEvento']) > 1) ){


    include('../../config/config.php');

    $dia = $_POST['dia'];
    $idEvento = $_POST['idEvento'];
    $horaInicio = $_POST['horaInicio'];
    $horaFim = $_POST['horaFim'];
    $nomeEvento = $_POST['nomeEvento'];
    $descricao = $_POST['descricao'];
    $userId = $_SESSION['codigo'];

    $date_time_inicio = new DateTime($dia . $horaInicio);
    $date_time_fim = new DateTime($dia . $horaFim);

    $date_fim = $date_time_fim->format('Y-m-d H:i:s');
    $date_inicio = $date_time_inicio->format('Y-m-d H:i:s');

    // Consulta SQL para verificar conflitos nos horários

    $query = "SELECT * FROM tbreserva WHERE dataHorarioInicio <= ? AND dataHorarioFim >= ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $date_inicio, $date_fim); // 'ss' indica que são strings
    $stmt->execute();

    $result = $stmt->get_result();
    // Verifica se há conflitos
    if ($result->num_rows) {
        echo "erro";
    } else {
        // Insere o novo agendamento no banco de dados
        $stmt->close();

        $sql = "INSERT INTO tbreserva (nomeEvento, dataHorarioInicio, dataHorarioFim, codigoUsuario, codigoLocal,descricao) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($sql);
        $stmtInsert->bind_param("sssiis", $nomeEvento, $date_inicio, $date_fim, $userId, $idEvento, $descricao);

        if ($stmtInsert->execute()) {
            header("location: http://localhost/agendamentos/index.php?page=agendar&sucessCad=1");

        } else {
            echo "Erro na inserção: " . $stmtInsert->error;
        }
    }
}else{
    header("location: http://localhost/agendamentos/index.php?page=agendar&errorCampos=1&invalid=1");
}
?>