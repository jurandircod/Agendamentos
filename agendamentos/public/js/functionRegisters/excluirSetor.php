<?php


@define("HOST", "localhost");
@define("USER", "root");
@define("PASSWD", ""); // lembrar de mudar a psswd no ubuntu
@define("DBname", "dbagendamentos");

$conn = new mysqli(HOST, USER, PASSWD, DBname); //conecta ao banco de dados.

if ($conn->connect_error) {
    echo "erro ao conectar ao banco ". $conn->error;
}

$id_setor = $_GET['id'];

$query = "SELECT * FROM tbusuario WHERE codigoSetor = $id_setor";

$result = $conn->query($query);

while($row = $result->fetch_assoc()){
    $setores[] = array(
        'codigo' => $row['codigo'],
        'nome' => $row['nome']
    );
}

echo json_encode($setors);
?>