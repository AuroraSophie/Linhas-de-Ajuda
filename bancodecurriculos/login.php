<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    include_once('conexao-curriculos.php'); 

    // Validar e filtrar dados de entrada
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $senha = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    if (!$email || !$senha) {
        $_SESSION['error_message'] = "Por favor, insira um e-mail e senha válidos.";
        header('Location: \foryourvoice\login.html?error=senha-incorreta');
        exit();
    }

    // Consulta SQL segura para evitar SQL injection
    $sql = "SELECT * FROM cadastro WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar a correspondência da senha
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($senha, $hashed_password)) {
            // Autenticação bem-sucedida
            $_SESSION['email'] = $email;
            header('Location: perfil_usuario.php');
            exit();
        }
    }

    $_SESSION['error_message'] = "E-mail ou senha incorretos.";
header('Location: \foryourvoice\login.html?error=senha-incorreta');
exit();

} else {
    // Redirecionar se o formulário não foi enviado corretamente
    $_SESSION['error_message'] = "E-mail ou senha incorretos.";
    header('Location: \foryourvoice\login.html?error=senha-incorreta');
    exit();
    
}
?>

