<?php

$pegarId = $_GET['id'];

echo $pegarId;
include("../../config/config.php");

$excluirEquip = "DELETE FROM tbequipamento WHERE codigo='".$pegarId."'";

if(isset($pegarId)){
    if($conn->query($excluirEquip)){
        header("location: /agendamentos/index.php?page=cadEquip&excSucess=1");
    }else{
        echo "erro ao excluir equipamento," . $conn->error;
    }
}else{
    echo "erro ao deletar ";
}


?>