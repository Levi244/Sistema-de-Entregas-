<?php
session_start();

$usuario_correto = "admin";
$senha_correta = "123456";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    if ($usuario == $usuario_correto && $senha == $senha_correta) {
        $_SESSION["usuario"] = $usuario;
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html> 
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - EntregaFácil</title>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background: linear-gradient(135deg, #2563eb, #1e40af);
  font-family: Arial;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-box {
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  width: 320px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #1e3a8a;
}

input {
  width: 100%;
  padding: 10px;
  margin: 8px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button {
  width: 100%;
  padding: 10px;
  background: #2563eb;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
}

button:hover {
  background: #1e40af;
}

.links {
  text-align: center;
  margin-top: 15px;
}

.links a {
  display: block;
  text-decoration: none;
  color: #2563eb;
  font-size: 14px;
  margin: 5px 0;
}

.erro {
  color: red;
  text-align: center;
  margin-bottom: 10px;
}
</style>
</head>

<body>

<div class="login-box">
  <h2>Login</h2>

  <?php if (isset($erro)) { ?>
    <div class="erro"><?php echo $erro; ?></div>
  <?php } ?>

  <form method="POST">
    <input type="text" name="usuario" placeholder="Usuário" required>
    <input type="password" name="senha" placeholder="Senha" required>

    <button type="submit">Entrar</button>
  </form>

  <div class="links">
    <a href="inicio.html">← Voltar</a>
    <a href="registro.php">Criar uma conta</a>
  </div>
</div>

</body>
</html>