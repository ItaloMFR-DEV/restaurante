<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../conexao.php';

$sql = "SELECT * FROM vendas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Vendas</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Vendas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mesa</th>
                    <th>Valor Total</th>
                    <th>Itens</th>
                    <th>Data e Hora de Fechamento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['mesa_id'] . "</td>
                                <td>" . $row['valor_total'] . "</td>
                                <td>" . $row['itens'] . "</td>
                                <td>" . $row['data_hora_fechamento'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhuma venda registrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='admin.php'">Voltar</button>
    </div>
</body>
</html>
