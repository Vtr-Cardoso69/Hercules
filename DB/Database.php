<?php
$dsn = 'mysql:host=localhost; dbname=academia_db; charset=utf8';
$usuario = 'root';
$senha = '';

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

?>