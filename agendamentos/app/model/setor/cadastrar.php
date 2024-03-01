<?php
$nomeSetor = $_GET['nomeSetor'];
$nomeSecretaria = $_GET['secretaria'];

if (strlen($_GET['nomeSetor']) > 1 && isset($_GET['secretaria'])) {
   
    $nomeSetor = $_GET['nomeSetor'];
    $nomeSecretaria = $_GET['secretaria'];
    include("../../config/config.php");
    $sql = "INSERT INTO tbsetor(nome, codigoSecretaria) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $nomeSetor, $nomeSecretaria);

    if ($stmt->execute()) {
        header("Location: /agendamentos/index.php?page=cadsetor&sucessCad=1");
    } else {
        echo "Erro ao registrar o usuário: " . $stmt->error;
    }
} else {
    header("Location: /agendamentos/index.php?page=cadsetor&errorCampos=1");
}
