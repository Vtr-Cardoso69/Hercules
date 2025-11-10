<?php
require_once '../../DB/Database.php';
require_once '../../Controller/TreinoController.php';
require_once '../../Controller/AlunoController.php';


// Sessão e verificação de usuário logado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user_id'])) {
    header('Location: /SISTEMA/View/login.php');
    exit;
}

// Inicializa controllers
$TreinoController = new TreinoController($pdo);
$AlunoController = new AlunoController($pdo);


// Obtém nome do aluno logado a partir do id
$aluno = $AlunoController->buscarAluno($_SESSION['user_id']);
$aluno_nome = $aluno['nome'] ?? ($_SESSION['user_nome'] ?? '');


// Busca treinos apenas do aluno logado
$treinos = $aluno_nome ? $TreinoController->listarPorAlunoNome($aluno_nome) : [];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Treinos</title>
    <link rel="stylesheet" href="../../Assets/CSS/listar.css">
    
</head>
<body>
    <div style="padding: 20px;">
        <h1>Histórico de Treinos</h1>
        <p>Aluno: <?php echo htmlspecialchars($aluno_nome); ?></p>

        <?php if (empty($treinos)): ?>
            <p>Nenhum treino encontrado para o seu usuário.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Modalidade</th>
                    <th>Professor</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($treinos as $treino): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($treino['id']); ?></td>
                        <td><?php echo htmlspecialchars($treino['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($treino['modalidade'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars($treino['professor_nome'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($treino['data_criacao']))); ?></td>
                        <td>
                            <a class="edit" href="editar_treino.php?id=<?= $treino['id'] ?>">Editar</a>
                            <a class="del" href="deletar_treino.php?id=<?= $treino['id'] ?>" 
                               onclick="return confirm('Tem certeza que deseja excluir este treino?')">
                                Deletar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>

 <div>
                <a href="../../index.php" class="btn btn-back">Voltar</a>
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