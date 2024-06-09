<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];

    $sql = "UPDATE produtos SET nome='$nome', valor='$valor' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Produto editado com sucesso.";
    } else {
        echo "Erro ao editar produto: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Editar Produto</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="id">ID do Produto</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text" class="form-control" id="valor" name="valor" required>
            </div>
            <button type="submit" class="btn btn-warning">Editar</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='admin.php'">Voltar</button>
        </form>
    </div>
</body>
</html>
