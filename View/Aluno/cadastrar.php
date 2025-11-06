<?php
require_once 'C:/Turma1/xampp/htdocs/Hercules/DB/Database.php';
require_once 'C:/Turma1/xampp/htdocs/Hercules/Controller/AlunoController.php';

// Inicia sessão para permitir login automático após cadastro
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$AlunoController = new AlunoController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Efetua o cadastro do aluno
    $AlunoController->cadastrar($nome, $email, $senha);

    // Autentica automaticamente o usuário recém-cadastrado
    $usuario = $AlunoController->autenticar($email, $senha);
    if ($usuario) {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_nome'] = $usuario['nome'];
        header('Location: ../../index.php');
        exit;
    }

    // Caso não autentique por algum motivo, redireciona ao login
    header('Location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
 <link rel="stylesheet" href="../../Assets/CSS/login_cadastro.css">

</head>
<body>
    
    <form method="POST">
        <h1>Cadastrar Usuário</h1>
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>

        <button type="submit">Cadastrar</button>

</form>
</body>
</html>