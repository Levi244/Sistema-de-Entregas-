<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$erro = "";

$host = "localhost";
$usuario = "u199367788_wP0dbY75a_levidb244";
$senha = "Fuvete*01";
$banco = "u199367788_wP0dbY75a_levidb";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("ERRO: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"] ?? "";
    $cpf = $_POST["cpf"] ?? "";
    $nascimento = $_POST["nascimento"] ?? "";
    $telefone = $_POST["telefone"] ?? "";
    $pessoa_tipo_id = $_POST["pessoa_tipo_id"] ?? 1;
    $atualizado_por = "sistema";
    $atualizado_em = date("Y-m-d");

    $stmt = $conn->prepare("
        INSERT INTO cadastro.tbPessoas
        (nome, cpf, nascimento, telefone, pessoa_tipo_id, atualizado_por, atualizado_em)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        die("Erro no prepare: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssiss",
        $nome,
        $cpf,
        $nascimento,
        $telefone,
        $pessoa_tipo_id,
        $atualizado_por,
        $atualizado_em
    );

    if ($stmt->execute()) {
        header("Location: login.html");
        exit();
    } else {
        $erro = "Erro ao cadastrar: " . $stmt->error;
    }
}
?>

<!DOCTYPE html> 
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro - EntregaFácil</title>

  <style>
    body {
      background: linear-gradient(135deg, #2563eb, #1e40af);
      font-family: Arial;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      width: 330px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    h2 {
      text-align: center;
      color: #1e3a8a;
      margin-bottom: 15px;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button {
      width: 100%;
      padding: 10px;
      background: #2563eb;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }

    button:hover {
      background: #1e40af;
    }

    .erro {
      color: red;
      text-align: center;
      margin-bottom: 10px;
      font-size: 14px;
    }

    .links {
      text-align: center;
      margin-top: 10px;
    }

    .links a {
      text-decoration: none;
      color: #2563eb;
      font-size: 14px;
    }
  </style>
</head>

<body>

<div class="box">
  <h2>Cadastro</h2>

  <?php if (!empty($erro)): ?>
    <div class="erro"><?php echo $erro; ?></div>
  <?php endif; ?>

  <form method="POST">

    <input type="text" name="nome" placeholder="Nome completo" required>
    <input type="text" name="cpf" placeholder="CPF" required>
    <input type="date" name="nascimento" required>
    <input type="text" name="telefone" placeholder="Telefone" required>

    <select name="pessoa_tipo_id">
      <option value="1">Pessoa Física</option>
      <option value="2">Pessoa Jurídica</option>
    </select>

    <button type="submit">Registrar</button>
  </form>

  <div class="links">
    <a href="login.html">Já tenho conta</a><br>
    <a href="inicio.html">← Voltar</a>
  </div>
</div>

</body>
</html>