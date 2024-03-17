<?php
session_start();
include('conexao-curriculos.php');

// Verificar se o usuário está autenticado
if (!isset($_SESSION['email'])) {
    // Redirecionar para a página de login se o usuário não estiver autenticado
    header('Location: /foryourvoice/login.html');
    exit();
}

// Obter o email do usuário autenticado
$email = $_SESSION['email'];

// Consulta para obter as informações do usuário
$query = "SELECT * FROM cadastro WHERE email = ?";
$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Exibir as informações do usuário
        $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="style_perfildeuser.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;1,200&display=swap" rel="stylesheet">
   
</head>
<body>

    <header>
        <img src="logo-fyv-bdc.svg" alt="icon" id="icon">
        <a href="\foryourvoice\index.html">página inicial</a>
        <img src="estrelinha-bdc.svg" alt="estrelinha" class="estrelinha">
        <a href="\foryourvoice\linhasdeajuda.html">linhas de ajuda</a>
        <img src="estrelinha-bdc.svg" alt="estrelinha" class="estrelinha">
        <a href="\foryourvoice\doacoes.html">doações</a>
        <img src="estrelinha-bdc.svg" alt="estrelinha" class="estrelinha">
        <a href="\foryourvoice\contatos.html">contatos</a>
        <img src="estrelinha-bdc.svg" alt="estrelinha" class="estrelinha">
        <a href="logout.php" id="logout">Sair</a>
    </header>
        <divmother class="infos">
          <divson1 class="subinfos">
    <h1 id="textColor">Perfil do Usuário</h1>

    <p><strong>Nome:</strong> <?php echo $row['nome']; ?></p>
    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
    <p><strong>Telefone:</strong> <?php echo $row['telefone']; ?></p>
    <p><strong>Endereço:</strong> <?php echo $row['endereco']; ?></p>
    <p><strong>Cidade/Estado:</strong> <?php echo $row['cidade_estado']; ?></p>
    <p><strong>CEP:</strong> <?php echo $row['cep']; ?></p>
    <p><strong>Escolaridade:</strong> <?php echo $row['escolaridade']; ?></p>
    <p><strong>Instituição de Ensino:</strong> <?php echo $row['instdeensino']; ?></p>
    <p><strong>Cargo:</strong> <?php echo $row['cargo']; ?></p>
    <p><strong>Empresa:</strong> <?php echo $row['empresa']; ?></p>
    <p><strong>Data de Início:</strong> <?php echo $row['data_inicio']; ?></p>
    <p><strong>Data de Fim:</strong> <?php echo $row['data_fim']; ?></p>
    <p><strong>Informação Complementar:</strong> <?php echo $row['infocomplementar']; ?></p>

    <!-- Botão de Visualizar -->
    <button id="visualizar" onclick="visualizarPerfil()">Visualizar</button> <br><br>

    <!-- Botão de Impressão -->
    <button id="imprimir" onclick="carregarJsPDF()">Imprimir PDF</button> <br><br>
    </divson1>

    <divson2 id="subinfos2">
        <h1 id="textColor">Obrigado por se cadastrar conosco!</h1>
        <p id="texto">É com imenso prazer que te recebemos em nossa comunidade exclusiva. Esperamos que a sua experiência conosco seja repleta de realizações, crescimento pessoal e muito sucesso! Lembre-se, estamos sempre aqui para te ajudar em sua jornada. Estamos muito felizes e entusiasmados por ter você aqui!</p>
        <p id="textColor">#ForYourVoice</p>
    </divson2>
   </divmother>
    <script>
        async function carregarJsPDF() {
            // Carregar a biblioteca jsPDF
            await new Promise(resolve => {
                var script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js';
                script.onload = resolve;
                document.head.appendChild(script);
            });

            // Após o carregamento, chamar a função para imprimir PDF
            imprimirPDF();
        }

        function visualizarPerfil() {
            alert("Visualizando o perfil: Nome - <?php echo $row['nome']; ?>, Email - <?php echo $row['email']; ?>");
        }

        function imprimirPDF() {
            var pdf = new jsPDF();
            pdf.text("Perfil do Usuário", 20, 20);

            // Adicionar informações do usuário ao PDF
            var conteudo = [
                "Nome: <?php echo $row['nome']; ?>",
                "Email: <?php echo $row['email']; ?>",
                "Telefone: <?php echo $row['telefone']; ?>",
                "Endereço: <?php echo $row['endereco']; ?>",
                "Cidade/Estado: <?php echo $row['cidade_estado']; ?>",
                "CEP: <?php echo $row['cep']; ?>",
                "Escolaridade: <?php echo $row['escolaridade']; ?>",
                "Instituição de Ensino: <?php echo $row['instdeensino']; ?>",
                "Cargo: <?php echo $row['cargo']; ?>",
                "Empresa: <?php echo $row['empresa']; ?>",
                "Data de Início: <?php echo $row['data_inicio']; ?>",
                "Data de Fim: <?php echo $row['data_fim']; ?>",
                "Informação Complementar: <?php echo $row['infocomplementar']; ?>",
            ];

            conteudo.forEach(function (linha, indice) {
                pdf.text(linha, 20, 40 + indice * 10);
            });

            // Salvar ou abrir o PDF
            pdf.save("perfil_usuario.pdf");
        }
    </script>

</body>
</html>

<?php
    // Fechar a declaração
    $stmt->close();
    } else {
        echo "Nenhum resultado encontrado para o usuário com o email: $email";
    }
} else {
    echo "Falha na preparação da consulta SQL: " . $mysqli->error;
}
?>
