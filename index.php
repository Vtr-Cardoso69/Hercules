<?php
require_once 'DB/Database.php';
require_once 'Controller/AlunoController.php';

$AlunoController = new AlunoController($pdo);
$erro = '';

// Processa tentativa de login (se houver)
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['senha'])){
    $usuario = $AlunoController->autenticar($_POST['email'], $_POST['senha']);
    if($usuario){
        // Em vez de redirecionar para um arquivo que pode não existir,
        // podemos criar uma sessão e redirecionar para a lista de alunos.
    session_start();
    $_SESSION['user_id'] = $usuario['id'];
    $_SESSION['user_email'] = $usuario['email'];
    // Volta para a página inicial (onde a landing page é exibida)
    header('Location: index.php');
        exit;
    } else {
        $erro = "Email ou senha incorretos!";
    }
}

// Obtém os alunos antes de incluir a view de landing page
$alunos = $AlunoController->listar();

// Agora inclui a landing page (ela verifica a existência de $alunos)
include_once "View/Aluno/landpg.php";
?>





















