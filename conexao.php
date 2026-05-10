<?php
$host = "*";
$usuario = "*";
$senha = "*";
$banco = "*";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("ERRO: " . $conn->connect_error);
}

?>