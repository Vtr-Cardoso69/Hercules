<?php

require_once __DIR__ . '/../../DB/Database.php';
require_once __DIR__ . '/../../Model/ProfessorModel.php';
require_once __DIR__ . '/../../Controller/TreinoController.php';
require_once __DIR__ . '/../../Controller/AlunoController.php';

// Sessão e verificação de usuário logado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user_id'])) {
    header('Location: /Hercules/View/login.php');
    exit;
}

$ProfessorModel = new ProfessorModel($pdo);
$TreinoController = new TreinoController($pdo);
$AlunoController = new AlunoController($pdo);

// Obtém dados do aluno logado
$alunoLogado = $AlunoController->buscarAluno($_SESSION['user_id']);
$aluno_nome_logado = $alunoLogado['nome'] ?? ($_SESSION['user_email'] ?? '');

$professores = $ProfessorModel->buscarTodosProfessores();
$mensagem = '';
$isSuccess = false;

// recebe modalidade por GET (quando vindo da landing) ou por POST (quando o form é submetido)
$modalidade = $_GET['modalidade'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$professor_id = $_POST['professor_id'] ?? '';
	$descricao = $_POST['descricao'] ?? '';
	$modalidade = $_POST['modalidade'] ?? $modalidade;
	if ($aluno_nome_logado && $professor_id && $descricao) {
		$res = $TreinoController->cadastrar($aluno_nome_logado, $professor_id, $descricao, $modalidade);
		$mensagem = $res['message'] ?? 'Erro desconhecido.';
		$isSuccess = !empty($res['success']);
	} else {
		$mensagem = 'Preencha todos os campos.';
		$isSuccess = false;
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cadastrar Treino</title>
	<link rel="stylesheet" href="../../Assets/CSS/login_cadastro.css">
	<style>
		.container { max-width: 500px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
		.form-group { margin-bottom: 15px; }
		.form-group label { display: block; margin-bottom: 5px; }
		.form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
		.btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; background: #4CAF50; color: white; }
		.msg { color: #4CAF50; margin-bottom: 10px; }
		.error { color: #f44336; margin-bottom: 10px; }
	</style>
</head>
<body>
	<div class="container">
		<h1>Cadastrar Treino</h1>
		<?php if ($mensagem): ?>
			<div class="<?php echo $isSuccess ? 'msg' : 'error'; ?>"><?php echo htmlspecialchars($mensagem); ?></div>
		<?php endif; ?>
		<form method="POST">
			<?php if (!empty($modalidade)): ?>
				<div style="margin-bottom:12px;"><strong>Modalidade selecionada:</strong> <?php echo htmlspecialchars($modalidade); ?></div>
			<?php endif; ?>
			<input type="hidden" name="modalidade" value="<?php echo htmlspecialchars($modalidade); ?>">
			<div class="form-group">
				<label>Você está logado como:</label>
				<div style="padding:8px;border:1px solid #ddd;border-radius:4px;background:#f8f8f8;">
					<?php echo htmlspecialchars($aluno_nome_logado); ?>
				</div>
			</div>
			<div class="form-group">
				<label for="professor_id">Professor:</label>
				<select id="professor_id" name="professor_id" required>
					<option value="">Selecione...</option>
					<?php foreach ($professores as $professor): ?>
						<option value="<?php echo $professor['id']; ?>"><?php echo htmlspecialchars($professor['nome']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="descricao">Descrição do Treino:</label>
				<textarea id="descricao" name="descricao" rows="4" required></textarea>
			</div>
			<button type="submit" class="btn">Cadastrar Treino</button>
		</form>
	<div>
                <a href="../../index.php" class="btn btn-back">Voltar</a>
            </div>
	</div>


<style>
        .btn-back {
            background: #666;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }
         .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
</style>

</body>
</html>