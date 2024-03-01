<?php

if (!isset($_SESSION)) {
    session_start();
}
include("../../config/config.php");
//verifica se algum campo foi enviado

$email = $conn->real_escape_string($_POST['email']); // segurança contra injeção sql
$senha = $_POST['senha'];

//verifica se a senha e o email estão cadastrados no banco de dados
$sql_code = "SELECT * FROM tbusuario WHERE email = '$email'"; //consulta sql
$sql_query = $conn->query($sql_code) or die("falha na execução do codigo SQL:"); // tratar erro

//pesquisa quantas linhas a sql_query retornou e atribui a quantidade
$quantidade = $sql_query->num_rows;

//inicia sessão do usuario cadastrado
if ($quantidade == 1) {

    $usuario = $sql_query->fetch_assoc();

    if (password_verify($senha, $usuario['senha'])) {
        
        $_SESSION['codigo'] = $usuario['codigo'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['nivelPermissao'] = $usuario['nivelPermissao'];
        $_SESSION['telefone'] = $usuario['telefone'];
        $_SESSION['codigoSetor'] = $usuario['codigoSetor'];
        $_SESSION['email'] = $usuario['email'];
        // if ($_SESSION['permissoes'] == 1 || $_SESSION['permissoes'] == 2) {
        header('location: /agendamentos/index.php');
        // } 
    } else {

        header("Location: /agendamentos/login.php?errorLogin=1");
    }
} else {
    header("Location: /agendamentos/login.php?errorLogin=1");

}
