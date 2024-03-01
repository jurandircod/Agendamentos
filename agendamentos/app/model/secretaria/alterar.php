<?php
$id_secretaria = $_POST['idSecretaria'];
$nome_setor = $_POST['nome'];

echo $id_secretaria . $nome_setor;

include("../../config/config.php");

if(isset($id_secretaria) && isset($nome_setor)){
    $alterName = "UPDATE tbsecretaria SET  nome ='{$nome_setor}' WHERE codigo = {$id_secretaria}";
    if($conn->query($alterName)){
        header("location: /agendamentos/index.php?page=cadsec&alterSucess=1");
    }else{
        echo "erro na query" . $conn->error;
    }
}



?>