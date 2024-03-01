<?php

// se a sessão retornar nada não executa logo coloquei o simbolo de negação para 
// se caso retornar false execute
if (!isset($_SESSION)) {
    session_start();
};

// o mesmo serve para o id, se retornar false quer dizer que não tem ninguem 
//logado, e dou a negacao para executar o codigo

function autenticar()
{
    if (!isset($_SESSION['id'])) {
        echo "<br><a href='../../view/login/loginUsuario.php'>Logar com sua conta</a>";
        die(" você não pode acessar sem estar logado");
    }
}


function autenticarAdministrador()
{

    if (!isset($_SESSION['id']) && $_SESSION['permissoes'] != 2) {
        die("você não pode acessar");
    }
}
