<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include('../../config/config.php');

if (!isset($_SESSION)) {
    session_start();
}

$excluirAg = $_GET['id'];
$usuario_logado = $_SESSION['codigo'];
//Verificar se o usuario é o dono do agendamento que ele está tentando excluir
if (isset($excluirAg)) {
    $sqlExcAgendamento = "SELECT codigoUsuario FROM tbreserva WHERE codigo = ?";
    $stmt = $conn->prepare($sqlExcAgendamento);
    $stmt->bind_param("i", $excluirAg);
    $stmt->execute();
    $stmt->bind_result($id_usuario_agendamento);
    $stmt->fetch();
    $stmt->close();

    if ($usuario_logado != $id_usuario_agendamento) {
        echo "<script>alert('Você não tem permissão para excluir esse agendamento!')</script>";
    } else {
        $sql_query = "DELETE FROM tbreserva WHERE codigo = '$excluirAg'";
        $stmt = $conn->prepare($sql_query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        header('location: /agendamentos/index.php?excSucess=1');
    }
}
