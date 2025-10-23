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
    if (isset($_POST['confirmar']) && $_POST['confirmar'] == 'sim') {
        $AlunoController->deletar($id);
    }
    header('Location: ../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuário</title>
    <link rel="stylesheet" href="../../Assets/CSS/style.css">

</head>
<body>
    <form method="POST">
        <h1>Excluir Usuário</h1>
        <p>Tem certeza que deseja excluir o usuário "<?php echo $aluno['nome']; ?>"?</p>
        
        <input type="hidden" name="confirmar" value="sim">
        <button type="submit">Confirmar Exclusão</button>
        <a href="../../index.php">Cancelar</a>
    </form>
</body>
</html>