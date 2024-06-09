<?php
session_start();
include '../admin_config.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['username']) || $_SESSION['username'] !== ADMIN_USERNAME) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Área Administrativa</h2>
        <p>Bem-vindo, <?php echo $_SESSION['username']; ?>!</p>
        <div class="mb-3">
            <a href="cadastrar_produto.php" class="btn btn-primary">Cadastrar Produto</a>
            <a href="editar_produto.php" class="btn btn-secondary">Editar Produto</a>
            <a href="excluir_produto.php" class="btn btn-danger">Excluir Produto</a>
            <a href="ver_vendas.php" class="btn btn-info">Ver Vendas</a>
            <button onclick="window.location.href='ver_produtos.php'" class="btn btn-secondary">Ver Produtos</button>
        </div>
        <a href="../logout.php" class="btn btn-danger">Logout</a>
        <a href="../index.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>
</html>
