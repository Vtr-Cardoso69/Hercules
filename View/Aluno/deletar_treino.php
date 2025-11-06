<?php
require_once '../../DB/Database.php';
require_once '../../Controller/TreinoController.php';

$TreinoController = new TreinoController($pdo);

if (!isset($_GET['id'])) {
    header('Location: historico.php');
    exit;
}

// Busca o treino para exibir a descrição na confirmação
$treino = $TreinoController->buscarTreino((int)$_GET['id']);
if (!$treino) {
    // Se não encontrar, volta para o histórico
    header('Location: historico.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirmar']) && $_POST['confirmar'] == 'sim') {
        $TreinoController->deletar($_GET['id']);
    }
    header('Location: historico.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Treino</title>
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
        <h1>Excluir Treino</h1>
        <p>Tem certeza que deseja excluir o treino "<?php echo htmlspecialchars($treino['modalidade'] . ' - ' . $treino['descricao']); ?>"?</p> 
        
        <form method="POST">
            <input type="hidden" name="confirmar" value="sim">
            <a href="historico.php" class="btn btn-back">Cancelar</a>
            <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
        </form>
    </div>

 
</body>
</html>
