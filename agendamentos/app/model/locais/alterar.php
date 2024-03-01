<?php

function sucess()
{
    header("location: /agendamentos/index.php?page=cadloc&alterSucess=1");
}
function error()
{
    header("location: /agendamentos/index.php?page=cadloc&alterError=1");
}

if (strlen($_POST['nomeLocal']) > 0 || strlen($_POST['endereco']) > 0 || strlen($_POST["maximoPessoas"]) > 0 || strlen($_POST['descricao']) > 0 || strlen($_POST['telefone']) > 0) {

    include_once("../../config/config.php");
    $codigo = $_POST['idLocal'];
    $nomeLocal = $_POST['nomeLocal'];
    $maximoPessoas = $_POST["maximoPessoas"];
    $endereco = $_POST['endereco'];
    $descricao = $_POST['descricao'];
    $telefone = $_POST['telefone'];


    if ($maximoPessoas !== "") {
        $alter = "UPDATE tblocal SET lotacaoMaxima ='{$maximoPessoas}' WHERE codigo = {$codigo}";

        if ($conn->query($alter)) {
            sucess();
        } else {
            error();
        }
    }

    if (strlen($nomeLocal) > 0) {
        $alter = "UPDATE tblocal SET  nomeLocal ='{$nomeLocal}' WHERE codigo = {$codigo}";

        if ($conn->query($alter)) {
            sucess();
        } else {
            error();
        }
    }

    if (strlen($endereco) > 0) {
        $alter = "UPDATE tblocal SET  endereco ='{$endereco}' WHERE codigo = {$codigo}";

        if ($conn->query($alter)) {
            sucess();
        } else {
            error();
        }
    }

    if (strlen($descricao) > 0) {
        $alter = "UPDATE tblocal SET  descricao ='{$descricao}' WHERE codigo = {$codigo}";

        if ($conn->query($alter)) {
            sucess();
        } else {
            error();
            exit();
        }
    }

    if (strlen($telefone) !== "") {
        $alter = "UPDATE tblocal SET  telefone ='{$telefone}' WHERE codigo = {$codigo}";

        if ($conn->query($alter)) {
            sucess();
        } else {
            error();
            exit();
        }
    }

} else {
    header("location: /agendamentos/index.php?page=cadloc&erroCampos=1");
}
