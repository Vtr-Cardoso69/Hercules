<?php
require_once 'C:/Turma1/xampp/htdocs/Hercules/DB/Database.php';
require_once 'C:/Turma1/xampp/htdocs/Hercules/Controller/AlunoController.php';
$AlunoController = new AlunoController($pdo);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $AlunoController->cadastrar($nome, $email, $senha);
    header('Location: ../../index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
 <link rel="stylesheet" href="../../Assets/CSS/style.css">

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