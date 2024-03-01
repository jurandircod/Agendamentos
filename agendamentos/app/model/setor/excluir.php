<?php
if (!isset($_SESSION)) {
    session_start();
}

if($_SESSION['nivelPermissao'] != 2){
    die("Permissão insuficiente");
}

include("../../config/config.php");

$id_setor = $_GET['id'];

$delete_setor_query = "DELETE FROM tbsetor WHERE codigo = $id_setor";
$delete_user_query = "DELETE FROM tbusuario WHERE codigoSetor = $id_setor";


if($conn->query($delete_user_query) && $conn->query($delete_setor_query) ){
    header("location: /agendamentos/index.php?page=cadsetor&excSucess=1");
    
}elseif($conn->error){
    echo $conn->error;
}




?>