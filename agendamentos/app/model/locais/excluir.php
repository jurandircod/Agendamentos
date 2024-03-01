<?php


if(isset($_GET['idLocal'])){
$pegarId = $_GET['idLocal'];

include("../../config/config.php");

$excluirEquip = "DELETE FROM tblocal WHERE codigo='".$pegarId."'";

if(isset($pegarId)){
    if($conn->query($excluirEquip)){
        header("location: /agendamentos/index.php?page=cadloc&excSucess=1");
    }else{
        echo "erro ao excluir local," . $conn->error;
    }
}else{
    echo "erro ao deletar ";
}
}else{
    header("location: /agendamentos/index.php?page=cadEquip&excLocError=1");
}