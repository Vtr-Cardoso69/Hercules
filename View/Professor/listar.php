<?php
require_once '../../DB/Database.php';
require_once '../../Controller/ProfessorController.php';
require_once '../../Controller/AlunoController.php';
require_once '../../Controller/TreinoController.php';

// Inicializa os controllers
$ProfessorController = new ProfessorController($pdo);
$AlunoController = new AlunoController($pdo);
$TreinoController = new TreinoController($pdo);

// Busca todos os professores, alunos e treinos
$professores = $ProfessorController->listar();
$alunos = $AlunoController->listar();
$treinos = $TreinoController->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Professores</title>
    <link rel="stylesheet" href="../../Assets/CSS/listar.css">
</head>
<body>
    <div>
                <a href="../../index.php" class="btn btn-back">Voltar</a>
            </div>
<div style="padding: 20px;">
        <h1>Sistema de Gerenciamento</h1>
        
        <!-- ================== PROFESSORES ================== -->
        <div style="margin-bottom: 40px;">
            <h2>Professores</h2>
            <br>
            <a href="cadastrar_professor.php" class="add-new">Cadastrar Novo Professor</a>

            <?php if (empty($professores)): ?>
                <p>Nenhum professor cadastrado!</p>
            <?php else: ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                    <?php foreach ($professores as $professor): ?>
                        <tr>
                            <td><?= htmlspecialchars($professor['id']) ?></td>
                            <td><?= htmlspecialchars($professor['nome']) ?></td>
                            <td><?= htmlspecialchars($professor['email']) ?></td>
                            <td>
                                <a class="edit" href="editar.php?id=<?= $professor['id'] ?>">Editar</a>
                                <a class="del" href="deletar.php?id=<?= $professor['id'] ?>" 
                                   onclick="return confirm('Tem certeza que deseja excluir este professor?')">
                                    Deletar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>

        <!-- ================== ALUNOS ================== -->
        <h2 style="margin-top: 40px;">Alunos Cadastrados</h2>
        <?php if (empty($alunos)): ?>
            <p>Nenhum aluno cadastrado!</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?= htmlspecialchars($aluno['id']) ?></td>
                        <td><?= htmlspecialchars($aluno['nome']) ?></td>
                        <td><?= htmlspecialchars($aluno['email']) ?></td>
                        <td>
                            <a class="edit" href="editar_aluno.php?id=<?= $aluno['id'] ?>">Editar</a>
                            <a class="del" href="deletar_aluno.php?id=<?= $aluno['id'] ?>" 
                               onclick="return confirm('Tem certeza que deseja excluir este aluno?')">
                                Deletar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <!-- ================== TREINOS ================== -->
        <h2 style="margin-top: 40px;">Treinos Cadastrados</h2>
        <?php if (empty($treinos)): ?>
            <p>Nenhum treino cadastrado!</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Aluno</th>
                    <th>Professor</th>
                    <th>Descrição</th>
                    <th>Modalidade</th>
                    <th>Data de Criação</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($treinos as $treino): ?>
                    <tr>
                        <td><?= htmlspecialchars($treino['id']) ?></td>
                        <td><?= htmlspecialchars($treino['aluno_nome']) ?></td>
                        <td><?= htmlspecialchars($treino['professor_nome']) ?></td>
                        <td><?= htmlspecialchars($treino['descricao']) ?></td>
                        <td><?= htmlspecialchars($treino['modalidade'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($treino['data_criacao'] ?? '—') ?></td>
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
