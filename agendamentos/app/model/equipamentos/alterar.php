<?php

function sucess()
{
    header("location: /agendamentos/index.php?page=cadEquip&alterSucess=1");
}
function error()
{
    header("location: /agendamentos/index.php?page=cadEquip&alterError=1");
}
include_once("../../config/config.php");

if (isset($_GET['disponibilidade'], $_GET['idEquip'])) {
    $disponibilidade = $_GET['disponibilidade'];
    $idEquip = $_GET['idEquip'];

    // Verifica se os parâmetros são numéricos
    if (is_numeric($disponibilidade) && is_numeric($idEquip)) {

        if ($disponibilidade == 1) {
            $desativa = 0;
            // Evita SQL Injection usando prepared statements
            $sql = "UPDATE tbequipamento SET disponibilidade = ? WHERE codigo = ?";
            $stmt = $conn->prepare($sql);

            // Atribui os valores e executa a consulta
            $stmt->bind_param("ii", $desativa, $idEquip);
            if ($stmt->execute()) {
                // Sucesso
                sucess();
            } else {
                // Erro na execução da consulta
                error();
            }
            $stmt->close();
            // Erro na preparação da consulta

        } else {
            $ativa = 1;
            $sql = "UPDATE tbequipamento SET disponibilidade = ? WHERE codigo = ?";
            $stmt = $conn->prepare($sql);

            // Atribui os valores e executa a consulta
            $stmt->bind_param("ii", $ativa, $idEquip);
            if ($stmt->execute()) {
                // Sucesso
                sucess();
            } else {
                // Erro na execução da consulta
                error();
            }
            $stmt->close();
        }
    } else {
        // Parâmetros não são numéricos
        error();
    }
} else {
    // Parâmetros ausentes
    error();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (strlen($_POST['nome']) > 0 || strlen($_POST['marca'] > 0) || $_POST['condicao'] > 0 || $_POST['patrimonio'] != "") {

        $codigo = $_POST['idEquip'];
        $nome = $_POST['nome'];
        $marca = $_POST['marca'];
        $patrimonio = $_POST['patrimonio'];
        $passPatrimonio = $_POST['patrimonio'] != "" ? TRUE : NULL;
        $passCondicao = $_POST['condicao'] != "" ? TRUE : NULL;
        $condicao = $_POST['condicao'];

        if (isset($passPatrimonio)) {
            $alter = "UPDATE tbequipamento SET  patrimonio ='{$patrimonio}' WHERE codigo = {$codigo}";
            if ($conn->query($alter)) {
                sucess();
            } else {
                error();
            }
        }

        if (strlen($nome) > 0) {
            $alter = "UPDATE tbequipamento SET  nome ='{$nome}' WHERE codigo = {$codigo}";
            if ($conn->query($alter)) {
                sucess();
            } else {
                error();
            }
        }

        if (strlen($marca) > 0) {
            $alter = "UPDATE tbequipamento SET  marca ='{$marca}' WHERE codigo = {$codigo}";
            if ($conn->query($alter)) {
                sucess();
            } else {
                error();
            }
        }

        if (isset($passCondicao)) {
            $alter = "UPDATE tbequipamento SET  condicao ='{$condicao}' WHERE codigo = {$codigo}";
            if ($conn->query($alter)) {
                sucess();
            } else {
                error();
                exit();
            }
        }
    } else {
        header("location: /agendamentos/index.php?page=cadEquip&erroCampos=1");
    }
}
