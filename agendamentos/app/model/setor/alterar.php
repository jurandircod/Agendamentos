<?php

if (strlen($_POST['nome']) > 1) {

    $id_secretaria = $_POST['idSetor'];
    $nome_setor = $_POST['nome'];

    echo $id_secretaria . $nome_setor;

    include("../../config/config.php");

    if (isset($id_secretaria) && isset($nome_setor)) {
        $alterName = "UPDATE tbsetor SET  nome ='{$nome_setor}' WHERE codigo = {$id_secretaria}";
        if ($conn->query($alterName)) {
            header("location: /agendamentos/index.php?page=cadsetor&alterSucess=1");
        } else {
            echo "erro na query" . $conn->error;
        }
    }
} else {
    header("location: /agendamentos/index.php?page=cadsetor&erroCampos=1");
}
