<?php




if (strlen($_GET['nomeSecretaria']) > 2 ) {
    include_once("../../config/config.php");
    $nomeSecretaria = $_GET['nomeSecretaria'];

    $sql = "INSERT INTO tbsecretaria (nome) VALUES (?)";
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Vincula o parâmetro utilizando bind_param
        $stmt->bind_param('s', $nomeSecretaria);

        if ($stmt->execute()) {
            header("Location: /agendamentos/index.php?page=cadsec&sucessCad=1");
        } else {
            echo "Erro ao registrar o usuário: " . $stmt->error;
        }
        // Fecha a declaração preparada
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }
} else {
    header("Location: /agendamentos/index.php?page=cadsec&errorCampos=1");
}
