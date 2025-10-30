<?php
require_once '../../DB/Database.php';
require_once '../../Controller/ProfessorController.php';

$ProfessorController = new ProfessorController($pdo);

if (!isset($_GET['id'])) {
    header('Location: listar.php');
    exit;
}

$id = $_GET['id'];
$professor = $ProfessorController->buscarProfessor($id);

if (!$professor) {
    header('Location: listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirmar']) && $_POST['confirmar'] == 'sim') {
        $ProfessorController->deletar($id);
    }
    header('Location: listar.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Professor</title>
    <link rel="stylesheet" href="../../Assets/CSS/style.css">
    <style>
        .container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin: 0 5px;
        }
        .btn-back {
            background: #666;
            color: white;
            text-decoration: none;
        }
        .btn-danger {
            background: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Excluir Professor</h1>
        <p>Tem certeza que deseja excluir o professor "<?php echo htmlspecialchars($professor['nome']); ?>"?</p>
        
        <form method="POST">
            <input type="hidden" name="confirmar" value="sim">
            <a href="listar.php" class="btn btn-back">Cancelar</a>
            <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
        </form>
    </div>
</body>
</html>