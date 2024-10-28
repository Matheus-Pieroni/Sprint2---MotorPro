<?php include('valida_sessao.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Principal</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Bem-vindo, <?php echo $_SESSION['usuario']; ?></h2>
        <ul>
            <li><a href="cadastro_fornecedor.php">Cadastro de Mecanicos</a></li>
            <li><a href="cadastro_produto.php">Cadastro de Carros</a></li>
            <li><a href="listagem_produtos.php">Listagem de Carros</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </div>
</body>
</html>
