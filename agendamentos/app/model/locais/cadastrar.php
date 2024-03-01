<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../../config/config.php');
    if((strlen($_POST['nomeLocal']) > 1) && (strlen($_POST['endereco']) > 1) && (strlen($_POST['endereco2']) > 1) && (strlen($_POST['telefone']) > 1)){
    $nomeLocal = $_POST['nomeLocal'];
    $maximoPessoas = $_POST["maximoPessoas"];
    $endereco = $_POST['endereco'];
    $rua = $_POST['endereco2'];
    $numero = $_POST['endereco3'];
    $descricao = $_POST['descricao'];
    $telefone = $_POST['telefone'];

    $enderecoCompleto = $endereco . " " . $rua. " " . $numero;
    $stringEndereco  = strval($enderecoCompleto);
    // Restante do seu código...

    // Agora você pode usar $equipamentos como uma matriz no restante do seu código PHP
    $query = "INSERT INTO tblocal(nomeLocal, lotacaoMaxima, endereco, descricao, telefone) VALUES (?, ?, ?, ?, ?)";
    $stmt= $conn->prepare($query);
    $stmt->bind_param("sisss", $nomeLocal, $maximoPessoas, $stringEndereco, $descricao, $telefone);
    if($stmt->execute()){
        header("location: http://localhost/agendamentos/index.php?page=cadloc&sucessCad=1");
    }else{
        echo "erro na inserção";
    }

    }else{
        header("location: http://localhost/agendamentos/index.php?page=cadloc&errorCampos=1&invalid=1");
    }
    // Restante do seu código...
} else {
    echo "Erro: método de requisição inválido.";
}

