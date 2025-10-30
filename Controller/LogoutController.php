<?php
session_start();
// Limpa a sessão e redireciona para a página inicial (landing)
session_unset();
session_destroy();
header('Location: ../index.php');
exit();
