<?php
require_once __DIR__ . '/../../DB/Database.php';
require_once __DIR__ . '/../../Controller/professorController.php';

$ProfessorController = new ProfessorController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $ProfessorController->cadastrar($nome, $email, $senha);
    // Após cadastrar, redireciona para a página de login/landpg do professor
    header('Location: landpg.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Professor</title>
    <link rel="stylesheet" href="../../Assets/CSS/style.css">
</head>
<body>
    <div style="max-width:600px;margin:40px auto;padding:20px;background:#fff;border-radius:8px;">
        <h1>Cadastrar Professor</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome" required style="width:100%;padding:8px;margin-bottom:10px;"><br>
            <input type="email" name="email" placeholder="Email" required style="width:100%;padding:8px;margin-bottom:10px;"><br>
            <input type="password" name="senha" placeholder="Senha" required style="width:100%;padding:8px;margin-bottom:10px;"><br>
            <button type="submit" style="padding:10px 20px;border:none;background:#2a5298;color:#fff;border-radius:4px;">Cadastrar</button>
        </form>
        <p style="margin-top:10px;"><a href="landpg.php">Voltar ao login</a></p>
    </div>
</body>
</html>
