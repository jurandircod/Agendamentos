<?php
function autorizar_Entrada()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['permissoes'])) {
        if (isset($_SESSION["id"]) && $_SESSION["permissoes"] == 1) {
            header("location: ../../view/panels/painelUsuario.php");
        } elseif ($_SESSION["permissoes"] == 2) {
            header("location: ../../view/panels/painelAdministrador.php");
        }
    }
}
