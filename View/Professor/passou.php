<?php
//Botão acesso1
if (isset($_POST['acesso1']) && $_POST['acesso1'] === 'ok1') {
    $_SESSION['permitido1'] = true;
    header("Location: listar.php");
    exit;
}
    ?>