<?php
include('../../config/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// verificar se todos os campos estão preenchidos

if ($_POST['senha'] == $_POST['confirm']) {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $tel = $_POST['tel'];
    $setor = $_POST['setor'];
    $confirmSenha = $_POST['confirm'];
 
    echo $setor;
    // criptografando a senha
    $hash_senha = password_hash($senha, PASSWORD_BCRYPT);

    // Verificar se o campo email já existe
    $sql = "SELECT * FROM tbusuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows >= 1) {
        header("Location: /agendamentos/register.php?errorEmail=1");
    } else {

        // Inserir dados  tbusuario com a senha criptografada
        $sql = "INSERT INTO tbusuario (codigoSetor, nome, email, senha, telefone) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);      
        //
        
        $stmt->bind_param('sssss', $setor, $nome, $email, $hash_senha, $tel);

        if ($stmt->execute()) {
            header("Location: /agendamentos/login.php?sucess=1");
        } else {
            echo "Erro ao registrar o usuário: " . $stmt->error;
        }
    }

} else {
    header("Location: /agendamentos/register.php?errorSenha=1");
}

$conn->close();
$stmt->close();


