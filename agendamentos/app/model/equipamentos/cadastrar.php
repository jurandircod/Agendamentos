<?php
include_once("../../config/config.php");


if (strlen($_POST['nome']) > 1  && strlen($_POST['marca']) > 1 && strlen($_POST['condicao']) > 0) {

    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $patrimonio = $_POST['patrimonio'];
    $condição = $_POST['condicao'];



    $query = "INSERT INTO tbequipamento (nome, marca, patrimonio, condicao) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssii",  $nome, $marca, $patrimonio, $condição);

    if ($stmt->execute()) {
        header("location: /agendamentos/index.php?page=cadEquip&sucessCad=1");
    }
}else{
    header("location: /agendamentos/index.php?page=cadEquip&errorCampos=1&invalid=1");
}
