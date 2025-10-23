<?php

if (empty($alunos)) {
      echo "<p>Nenhum usuário cadastrado!</p>";
      echo"<a href='View/Aluno/cadastrar.php'>Cadastrar Usuário</a>";
      return;
    }

    echo "<table>";
    echo"<tr><td>Usuários</td>
    <td><a href='View/Aluno/cadastrar.php'>Cadastrar Novo Usuário</a>;
    </tr>";
    echo "<tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th id='config'>Ações</th>
      </tr>";

foreach ($alunos as $aluno) {
      $id = $aluno['id'];

      echo "<tr>";
      echo "<td>{$id}</td>";
      echo "<td>{$aluno['nome']}</td>";
      echo "<td>{$aluno['email']}</td>";

      echo "<td>
<a class ='edit' href='View/Aluno/editar.php?id={$id}'>Editar</a> 
<a class = 'del' href='View/Aluno/deletar.php?id={$id}' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?')\">Deletar</a></td>";
      echo "</tr>";
    }

 echo "</table>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title></title>
       <link rel="stylesheet" href="Assets/CSS/style.css">

</head>
<body>
      
</body>
</html>