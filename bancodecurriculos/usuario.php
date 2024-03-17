<html>

<head>
    <meta http-equiv="refresh" content="1; URL='perfil_usuario.php'">

</head>

</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('conexao-curriculos.php');


if (isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['nome']) &&
    isset($_POST['tel']) &&
    isset($_POST['endereco']) &&
    isset($_POST['cidade-estado']) &&
    isset($_POST['cep']) &&
    isset($_POST['escolaridade']) &&
    isset($_POST['instdeensino']) &&
    isset($_POST['cargo']) &&
    isset($_POST['empresa']) &&
    isset($_POST['data-inicio']) &&
    isset($_POST['data-fim']) &&
    isset($_POST['infocomplementar'])
) {
    include('conexao-curriculos.php');

    // Validar e filtrar dados de entrada
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $tel = $_POST['tel'];
    $endereco = $_POST['endereco'];
    $cidade_estado = $_POST['cidade-estado'];
    $cep = $_POST['cep'];
    $escolaridade = $_POST['escolaridade'];
    $instdeensino = $_POST['instdeensino'];
    $cargo = $_POST['cargo'];
    $empresa = $_POST['empresa'];
    $data_inicio = $_POST['data-inicio'];
    $data_fim = $_POST['data-fim'];
    $infocomplementar = $_POST['infocomplementar'];

    // Preparar a declaração SQL
    

    $query = "INSERT INTO cadastro (nome, email, password, telefone, endereco, cidade_estado, cep, escolaridade, instdeensino, cargo, empresa, data_inicio, data_fim, infocomplementar) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);

if ($stmt) {
// Bind dos parâmetros
$stmt->bind_param("ssssssisssssss", $nome, $email, $senha, $tel, $endereco, $cidade_estado, $cep, $escolaridade, $instdeensino, $cargo, $empresa, $data_inicio, $data_fim, $infocomplementar);

// Executar a declaração
$stmt->execute();

// Verificar se ocorreu algum erro durante a execução
if ($stmt->errno) {
  echo "Erro durante a execução da declaração SQL: " . $stmt->error;
} else {
  echo "<h1>Cadastro realizado com sucesso!</h1>";
}

// Fechar a declaração
$stmt->close();
} else {
echo "Falha na preparação da declaração SQL: " . $mysqli->error;
}
    }
