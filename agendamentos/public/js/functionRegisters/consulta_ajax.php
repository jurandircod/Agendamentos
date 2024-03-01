<?php
@define("HOST", "localhost");
@define("USER", "root");
@define("PASSWD", ""); // lembrar de mudar a psswd no ubuntu
@define("DBname", "dbagendamentos");

$conn = new mysqli(HOST, USER, PASSWD, DBname); //conecta ao banco de dados.

if ($conn->connect_error) {
    echo "erro ao conectar ao banco " . $conn->error;
}

$secretaria_id = $_GET['secretaria_id'];

$query = "SELECT * FROM tbsetor WHERE codigoSecretaria = $secretaria_id ORDER BY nome";

$result = $conn->query($query);
$setores = array();

while($row = $result->fetch_assoc()) {
    
    $setores[] = array(
        'codigo_setor' => "$row[codigo]",
        'nome' => "$row[nome]"
    );
}

echo json_encode($setores);
?>