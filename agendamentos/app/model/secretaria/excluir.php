<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['nivelPermissao'] != 2) {
    die('você não possui permissao');
}
include_once('../../config/config.php');


function redirecionar(){
    header("Location: ../../../../agendamentos/index.php?page=cadsec");
}

$id_secretaria = $_GET['id'];

$query_select_setor = "SELECT codigo FROM tbsetor WHERE codigoSecretaria = $id_secretaria";
// se não tiver nenhum setor ele exclui a secretaria
$pegarId = $conn->query($query_select_setor);
$numrows = $pegarId->num_rows;

if ($numrows == 0) {
    $query_delete_secretaria = "DELETE FROM tbsecretaria WHERE codigo  = $id_secretaria";
    if ($conn->query($query_delete_secretaria) === TRUE) {
        redirecionar();
    }
} elseif ($numrows > 0) {
    while ($rows = $pegarId->fetch_assoc()) {
        //seleciona os usuarios onde o setor e a secretaria estão
        $query_select_user = "SELECT codigo FROM tbusuario WHERE codigoSetor = $rows[codigo]";
        $result_query_user = $conn->query($query_select_user);
        $numrows = $result_query_user->num_rows;

        //se o setor não tem usuario e exclui o setor
        if ($numrows == 0) {
            $query_delete_secretaria = "DELETE FROM tbsecretaria WHERE codigo  = $id_secretaria";
            $query_delete_setor = "DELETE FROM tbsetor WHERE codigoSecretaria  = $id_secretaria";
            if ($conn->query($query_delete_setor) == true && $conn->query($query_delete_secretaria) === TRUE) {
                redirecionar();
            }
        } elseif ($numrows > 0) {
            //seleciona reservas onde usuario esta vinculados
            while ($row_user = $result_query_user->fetch_assoc()) {
                $query_select_user = "SELECT codigo FROM tbreserva WHERE codigoUsuario = $row_user[codigo]";
                $result_query_reserva = $conn->query($query_select_user);
                $numrows = $result_query_reserva->num_rows;

                // verifica se o usuario não tem reserva e excluir o usuario
                if ($numrows == 0) {
                    $query_delete_secretaria = "DELETE FROM tbsecretaria WHERE codigo  = $id_secretaria";
                    $query_delete_setor = "DELETE FROM tbsetor WHERE codigoSecretaria  = $id_secretaria";
                    $query_delete_user = "DELETE FROM tbusuario WHERE codigoSetor = $rows[codigo]";

                    if ($conn->query($query_delete_user) == TRUE && $conn->query($query_delete_setor) == TRUE && $conn->query($query_delete_secretaria) === TRUE) {
                        redirecionar();
                    }
                } elseif ($numrows > 0) {
                    //seleciona reservas
                    while ($row_user = $result_query_user->fetch_assoc()) {
                        $query_select_user = "SELECT codigo FROM tbreserva WHERE codigoUsuario = $row_user[codigo]";
                        $result_query_reserva = $conn->query($query_select_user);
                        $numrows = $result_query_reserva->num_rows;

                    }
                }
            }
        }
    }
}





;

?>