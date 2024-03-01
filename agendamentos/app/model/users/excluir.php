<?php
if (!isset($_SESSION)) {
    session_start();
}

if($_SESSION['nivelPermissao'] != 2 ){
    die("você precisa estar logado para excluir <a href='sitevinicius/index.php'> voltar para o inicio</a>");
}

include( __DIR__. '/../../config/config.php');
if(isset($_GET['id'])){
    $idUser = $_GET['id'];
    
    $sql_query = "DELETE FROM tbusuario WHERE codigo = $idUser";
    
    if($conn->query($sql_query)){
        header("Location: ../../../index.php?page=userListar&sucess=1");
    }else{
        echo"Erro ao excluir o registro!";
        echo"erro:" . $conn->error;
    }

} else {
    echo "ID não recebido. entre em contato com administrador do sistema";
}

?>