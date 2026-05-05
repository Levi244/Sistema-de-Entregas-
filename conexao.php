<?php
$host = "***";
$usuario = "****";
$senha = "*";
$banco = "****";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro: " . $conexao->connect_error);
}
?>