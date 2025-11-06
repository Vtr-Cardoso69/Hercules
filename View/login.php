<?php
session_start();
require_once __DIR__ . '/../DB/Database.php';
require_once __DIR__ . '/../Controller/AlunoController.php';

$AlunoController = new AlunoController($pdo);
$erro = '';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['senha'])){
    $usuario = $AlunoController->autenticar($_POST['email'], $_POST['senha']);
    if($usuario){
        // Cria sessão e redireciona para a landing (index.php)
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_nome'] = $usuario['nome'];
        header('Location: ../index.php');
        exit;
    } else {
        $erro = "Email ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hercules</title>
    <link rel="stylesheet" href="../Assets/CSS/login_cadastro.css">
</head>
<body>
    <div class="login">
        <h2>Login</h2>
        <?php if(!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
        <form method="POST">
            <div>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" required style="width:100%;padding:8px;">
            </div>
            <div style="margin-top:10px;">
                <label for="senha">Senha</label><br>
                <input type="password" id="senha" name="senha" required style="width:100%;padding:8px;">
            </div>
            <div style="margin-top:12px;">
                <button type="submit" style="padding:10px 16px;">Entrar</button>
            </div>
        </form>
   <p style="margin-top:12px;">
  Não tem conta?
  <a href="/Hercules/View/Aluno/cadastrar.php">Cadastrar</a>
  <a href="/Hercules/View/Professor/landpg.php" style="margin-left: 109px;">Instrutor</a>
</p>

</html>
