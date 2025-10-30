<?php
require_once '../../DB/Database.php';
require_once '../../Controller/ProfessorController.php';
require_once '../../Controller/AlunoController.php';

// Inicializa os controllers
$ProfessorController = new ProfessorController($pdo);
$AlunoController = new AlunoController($pdo);

// Busca todos os professores e alunos
$professores = $ProfessorController->listar();
$alunos = $AlunoController->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Professores</title>
    <link rel="stylesheet" href="../../Assets/CSS/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .edit, .del {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 8px;
        }
        .edit {
            background-color: #4CAF50;
            color: white;
        }
        .del {
            background-color: #f44336;
            color: white;
        }
        .add-new {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div style="padding: 20px;">
        <h1>Sistema de Gerenciamento</h1>
        
        <div style="margin-bottom: 40px;">
            <h2>Professores</h2>
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
                        <td><?php echo htmlspecialchars($professor['id']); ?></td>
                        <td><?php echo htmlspecialchars($professor['nome']); ?></td>
                        <td><?php echo htmlspecialchars($professor['email']); ?></td>
                        <td>
                            <a class="edit" href="editar.php?id=<?php echo $professor['id']; ?>">Editar</a>
                            <a class="del" href="deletar.php?id=<?php echo $professor['id']; ?>" 
                               onclick="return confirm('Tem certeza que deseja excluir este professor?')">
                                Deletar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

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
                        <td><?php echo htmlspecialchars($aluno['id']); ?></td>
                        <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
                        <td><?php echo htmlspecialchars($aluno['email']); ?></td>
                        <td>
                                <a class="edit" href="editar_aluno.php?id=<?php echo $aluno['id']; ?>">Editar</a>
                                <a class="del" href="deletar_aluno.php?id=<?php echo $aluno['id']; ?>" 
                               onclick="return confirm('Tem certeza que deseja excluir este aluno?')">
                                Deletar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>