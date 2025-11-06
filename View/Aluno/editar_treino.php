<?php
require_once '../../DB/Database.php';
require_once '../../Controller/TreinoController.php';
require_once __DIR__ . '/../../Model/ProfessorModel.php';
require_once __DIR__ . '/../../Controller/AlunoController.php';

$TreinoController = new TreinoController($pdo);
$ProfessorModel = new ProfessorModel($pdo);
$AlunoController = new AlunoController($pdo);
$erro = '';

// Sessão e verificação de usuário logado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user_id'])) {
    header('Location: /Hercules/View/login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: historico.php');
    exit;
}

$id = $_GET['id'];
$treino = $TreinoController->buscarTreino($id);

if (!$treino) {
    header('Location: historico.php');
    exit;
}

// Carrega lista de professores cadastrados
$professores = $ProfessorModel->buscarTodosProfessores();

// Lista de modalidades existentes
$modalidades = ['Musculação', 'Funcional', 'Spinning'];

// Obtém dados do aluno logado
$alunoLogado = $AlunoController->buscarAluno($_SESSION['user_id']);
$aluno_nome_logado = $alunoLogado['nome'] ?? ($_SESSION['user_nome'] ?? ($_SESSION['user_email'] ?? ''));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Força usar o nome do aluno logado, sem permitir edição
    $aluno_nome = $aluno_nome_logado;
    $professor_id = $_POST['professor_id'];
    $descricao = $_POST['descricao'];
    $modalidade = $_POST['modalidade'];
  

    if ($TreinoController->atualizar($id, $aluno_nome, $professor_id, $descricao, $modalidade)) {    
        header('Location: historico.php');
        exit;
    } else {
        $erro = 'Erro ao atualizar treino!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Treino</title>
    <link rel="stylesheet" href="../../Assets/CSS/style.css">
    
    <style>
        .container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .error {
            color: #f44336;
            margin-bottom: 15px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary {
            background: #4CAF50;
            color: white;
        }
        .btn-back {
            background: #666;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }
    </style>

</head>
<body>
    <div class="container">
        <h1>Editar Treino</h1>
        
        <?php if ($erro): ?>
            <div class="error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Aluno:</label>
                <div style="padding:8px;border:1px solid #ddd;border-radius:4px;background:#f8f8f8;">
                    <?php echo htmlspecialchars($aluno_nome_logado); ?>
                </div>
            </div>
            
            <div class="form-group">
            <label for="professor_id">Professor:</label>
            <select id="professor_id" name="professor_id" required>
                <option value="">Selecione um professor</option>
                <?php foreach ($professores as $professor): ?>
                    <option value="<?php echo $professor['id']; ?>" <?php echo ($treino['professor_id'] == $professor['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($professor['nome']); ?>
                    </option>
                <?php endforeach; ?>
                </select>   
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao" value="<?php echo htmlspecialchars($treino['descricao']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="modalidade">Modalidade:</label>
                <select id="modalidade" name="modalidade" required>
                    <option value="">Selecione a modalidade</option>
                    <?php foreach ($modalidades as $mod): ?>
                        <option value="<?php echo htmlspecialchars($mod); ?>" <?php echo (!empty($treino['modalidade']) && $treino['modalidade'] === $mod) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($mod); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
        
            <div>
                <a href="historico.php" class="btn btn-back">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>
    </div>
</body>
</html>