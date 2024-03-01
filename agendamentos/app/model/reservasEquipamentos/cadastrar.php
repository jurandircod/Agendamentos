<?php 
include_once("../../config/config.php");
if (strlen($_POST['nome']) > 1 && strlen($_POST['dataEmp']) > 1 && strlen($_POST['dataDev']) > 0 && strlen($_POST['evento']) > 1 && strlen($_POST['idEquip']) > 1) {

    $nome = $_POST['nome'];
    $dataEmp = $_POST['dataEmp'];
    $dataDevolucao = $_POST['dataDev'];
    $evento = $_POST['evento'];
    $idEquip= $_POST["idEquip"];
    $disponibilidade = 0;
    
    $query = "INSERT INTO tbreservaequipamento (responsavelEquip, dataEmprestimo, dataDevolucao, codigoReserva, codigoEquipamento) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $nome, $dataEmp, $dataDevolucao, $evento, $idEquip);

    if ($stmt->execute()) {
        
        $sqlEquip = "UPDATE tbequipamento SET disponibilidade = ? WHERE codigo = ?";
        $stmt2 = $conn->prepare($sqlEquip);
        $stmt2->bind_param("ii", $disponibilidade, $idEquip);
        $stmt2->execute();
        
        header("location: /agendamentos/index.php?page=equipamentos&sucessCad=1");
        exit(); 
    } else {
       
        header("location: /agendamentos/index.php?page=equipamentos&invalid=1");
        exit(); 
    }
} else {
    // Redirecionamento se os dados do formulário forem inválidos
    header("location: /agendamentos/index.php?page=equipamentos&invalid=1");
    exit(); 
}
?>
