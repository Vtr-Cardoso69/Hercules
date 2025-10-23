<?php
require_once 'C:/Turma1/xampp/htdocs/Hercules/DB/Database.php';
require_once 'C:/Turma1/xampp/htdocs/Hercules/Controller/AlunoController.php';

$AlunoController = new AlunoController($pdo);

if (!isset($_GET['id'])) {
    header('Location: ../../index.php');
    exit;
}

$id = $_GET['id'];
$aluno = $AlunoController->buscarAluno($id);

if (!$aluno) {
    header('Location: ../../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $AlunoController->editar($id, $nome, $email, $senha);
    header('Location: ../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
     <link rel="stylesheet" href="../../Assets/CSS/style.css">

</head>
<body>
    <form method="POST">
        <h1>Editar Usuário</h1>
        <input type="text" name="nome" value="<?php echo $aluno['nome']; ?>" required><br>
        <input type="email" name="email" value="<?php echo $aluno['email']; ?>" required><br>
        <input type="password" name="senha" placeholder="Nova senha" required><br>

        <button type="submit">Atualizar</button>
        <a href="../../index.php">Cancelar</a>
    </form>
</body>
</html>