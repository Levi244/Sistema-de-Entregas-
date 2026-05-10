<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexão
require __DIR__ . '/conexao.php';

// Verifica conexão
if (!$conn) {
    die("Erro: conexão não encontrada");
}

// Consulta
$sql = "SELECT pessoa_id, nome, cpf FROM tbPessoas";

$result = $conn->query($sql);

// Verifica erro SQL
if (!$result) {
    die("Erro na query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Dashboard - EntregaFácil</title>

<style>
body {
  margin: 0;
  font-family: Arial;
  background: #f4f6f9;
}

header {
  background: linear-gradient(90deg, #2563eb, #1e40af);
  color: white;
  padding: 15px 30px;
  display: flex;
  justify-content: space-between;
}

nav a {
  color: white;
  margin-left: 20px;
  text-decoration: none;
}

.container {
  padding: 30px;
}

.card {
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.actions {
  margin-bottom: 15px;
}

.actions button {
  padding: 8px 15px;
  border: none;
  border-radius: 5px;
  margin-right: 5px;
  cursor: pointer;
}

.btn-voltar { background: gray; color: white; }
.btn-add { background: #2563eb; color: white; }
.btn-edit { background: #3b82f6; color: white; }
.btn-del { background: #ef4444; color: white; }

table {
  width: 100%;
  border-collapse: collapse;
}

th {
  background: #c7d2fe;
  padding: 10px;
  text-align: left;
}

td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

tr:hover {
  background: #f1f5f9;
}
</style>

</head>

<body>

<header>
  <h2>EntregaFácil</h2>
  <nav>
    <a href="index.html">Início</a>
    <a href="#">Cadastros</a>
    <a href="#">Relatórios</a>
    <a href="login.php">Login</a>
  </nav>
</header>

<div class="container">
  <div class="card">

    <h2>Usuários - Listar</h2>

    <div class="actions">
      <button class="btn-voltar" onclick="history.back()">Voltar</button>
      <button class="btn-add" onclick="window.location='registro.php'">Incluir</button>
      <button class="btn-edit">Editar</button>
      <button class="btn-del">Excluir</button>
    </div>

    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
      </tr>

      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['pessoa_id']) ?></td>
            <td><?= htmlspecialchars($row['nome']) ?></td>
            <td><?= htmlspecialchars($row['cpf']) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="3">Nenhum registro encontrado</td>
        </tr>
      <?php endif; ?>

    </table>

  </div>
</div>

</body>
</html>