<?php
require_once __DIR__ . '/../../DB/Database.php';
require_once __DIR__ . '/../../Controller/AlunoController.php';

$AlunoController = new AlunoController($pdo);
$erro = '';

if (!isset($_GET['id'])) {
    header('Location: listar.php');
    exit;
}

$id = $_GET['id'];
$aluno = $AlunoController->buscarAluno($id);

if (!$aluno) {
    header('Location: listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Nota: o Model do Aluno exige senha na atualização. Solicita-se que seja preenchida.
    if (empty($senha)) {
        $erro = 'A senha é obrigatória para atualizar o aluno. Se deseja manter a senha atual, implemente suporte no model.';
    } else {
        if ($AlunoController->editar($id, $nome, $email, $senha)) {
            header('Location: listar.php');
            exit;
        } else {
            $erro = 'Erro ao atualizar aluno!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="../../Assets/CSS/style.css">
    <style>
        .container { max-width: 500px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display:block; margin-bottom:5px; }
        .form-group input { width:100%; padding:8px; border:1px solid #ddd; border-radius:4px; }
        .error { color:#f44336; margin-bottom:15px; }
        .btn { padding:10px 20px; border:none; border-radius:4px; cursor:pointer; }
        .btn-primary { background:#4CAF50; color:#fff; }
        .btn-back { background:#666; color:#fff; text-decoration:none; display:inline-block; margin-right:10px; padding:10px 20px; border-radius:4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Aluno</h1>

        <?php if ($erro): ?>
            <div class="error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($aluno['nome']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($aluno['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha (obrigatória para atualizar):</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <div>
                <a href="listar.php" class="btn-back">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>
    </div>
</body>
</html>
