<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 30px;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 274px;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2a5298;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            background-color: #1e3c72;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

    </style>
</head>
<body>

<div class="login-container">
    <h2>Área do Professor</h2>
    
    <!-- Aqui vai o PHP de login -->
    <?php
    session_start();
    require_once __DIR__ . '/../../DB/Database.php';
    require_once __DIR__ . '/../../Controller/professorController.php';

    $ProfessorController = new ProfessorController($pdo);
    $erro = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        // Primeiro, mantém o usuário hard-coded como fallback (não remover)
        if($usuario === "professor" && $senha === "1234") {
            // Sessão simples para compatibilidade
            $_SESSION['prof_logged_in'] = true;
            header("Location: listar.php");
            exit;
        }

        // Tenta autenticar como professor cadastrado (usa email como usuário)
        $prof = $ProfessorController->autenticar($usuario, $senha);
        if ($prof) {
            // Define informações de sessão para o professor autenticado
            $_SESSION['prof_id'] = $prof['id'];
            $_SESSION['prof_email'] = $prof['email'];
            $_SESSION['prof_nome'] = $prof['nome'];
            header('Location: listar.php');
            exit;
        } else {
            $erro = "Usuário ou senha incorretos!";
        }
    }
    ?>

    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuário" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>

 <div>
                <a href="../../index.php" class="btn btn-back">Voltar</a>
            </div>

    <?php if(!empty($erro)) echo "<div class='error'>$erro</div>"; ?>

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
            margin-top: 10px;
        }
</style>

</body>
</html>
