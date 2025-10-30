<?php
// Mostrar erros para depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../DB/Database.php';
require_once __DIR__ . '/../../Controller/AlunoController.php';

$AlunoController = new AlunoController($pdo);

if (!isset($_GET['id'])) {
    header('Location: /Hercules/View/Professor/listar.php');
    exit;
}

$id = $_GET['id'];
$aluno = $AlunoController->buscarAluno($id);

if (!$aluno) {
    header('Location: /Hercules/View/Professor/listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmar']) && $_POST['confirmar'] === 'sim') {
        $success = $AlunoController->deletar($id);
        // opcional: você pode tratar $success para mostrar mensagem
    }
    header('Location: /Hercules/View/Professor/listar.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Aluno</title>
    <link rel="stylesheet" href="../../Assets/CSS/style.css">
</head>
<body>
    <div style="max-width:600px;margin:40px auto;padding:20px;background:#fff;border-radius:8px;">
        <h1>Excluir Aluno</h1>
        <p>Tem certeza que deseja excluir o aluno "<?php echo htmlspecialchars($aluno['nome']); ?>"?</p>
        <form method="POST">
            <input type="hidden" name="confirmar" value="sim">
            <a href="/Hercules/View/Professor/listar.php" style="margin-right:10px;">Cancelar</a>
            <button type="submit" style="background:#f44336;color:#fff;padding:8px 12px;border:none;border-radius:4px;">Confirmar Exclusão</button>
        </form>
    </div>
</body>
</html>
