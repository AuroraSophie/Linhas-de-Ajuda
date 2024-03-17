<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['email'])) {
    // Redirecionar para a página de login se o usuário não estiver autenticado
    header('Location: \foryourvoice\login.html');
    exit();
}

// Limpar completamente a sessão
$_SESSION = array();

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login após o logout
header('Location: \foryourvoice\login.html');
exit();
?>
