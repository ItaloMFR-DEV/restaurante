<?php
include '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];

    $sql = "INSERT INTO produtos (nome, valor, data_hora_cadastro) VALUES ('$nome', '$valor', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Produto cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar produto: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Cadastrar Produto</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
        <a href="admin.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</body>
</html>
