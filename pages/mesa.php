<?php
include '../conexao.php';

$nome_mesa = '';
$status_mesa = '';
$total_mesa = 0;
$produtos = null;

if (isset($_GET['id'])) {
    $mesa_id = $_GET['id'];

    $sql = "SELECT * FROM mesas WHERE id = $mesa_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_mesa = $row['nome'];
        $status_mesa = $row['status'];
    } else {
        echo "Mesa não encontrada ou erro na consulta: " . $conn->error;
        exit();
    }

    // Obtém os produtos da mesa
    $sql = "SELECT im.id, p.nome, im.quantidade, (p.valor * im.quantidade) AS valor_total
            FROM itens_mesa im
            JOIN produtos p ON im.produto_id = p.id
            WHERE im.mesa_id = $mesa_id";
    $produtos = $conn->query($sql);

    if (!$produtos) {
        echo "Erro ao buscar produtos da mesa: " . $conn->error;
        exit();
    }
} else {
    echo "ID da mesa não especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesa <?php echo htmlspecialchars($nome_mesa); ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Mesa <?php echo htmlspecialchars($nome_mesa); ?></h1>
        <p>Status: <?php echo htmlspecialchars($status_mesa); ?></p>

        <div class="mt-4">
            <input type="text" id="nomeProduto" class="form-control" placeholder="Nome do Produto">
            <input type="number" id="quantidadeProduto" class="form-control mt-2" placeholder="Quantidade">
            <button onclick="adicionarProduto()" class="btn btn-success mt-2">Adicionar Produto</button>
        </div>

        <div class="mt-4">
            <h3>Produtos na Mesa</h3>
            <ul class="list-group">
                <?php
                if ($produtos && $produtos->num_rows > 0) {
                    while ($produto = $produtos->fetch_assoc()) {
                        $total_mesa += $produto['valor_total'];
                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                " . htmlspecialchars($produto['nome']) . " - Quantidade: " . htmlspecialchars($produto['quantidade']) . " - Total: R$ " . htmlspecialchars($produto['valor_total']) . "
                                <button onclick='excluirProduto(" . htmlspecialchars($produto['id']) . ")' class='btn btn-danger btn-sm'>Excluir</button>
                              </li>";
                    }
                } else {
                    echo "<li class='list-group-item'>Nenhum produto adicionado.</li>";
                }
                ?>
            </ul>
        </div>

        <div class="mt-4">
            <h4>Total da Mesa: R$ <?php echo htmlspecialchars($total_mesa); ?></h4>
            <button onclick="fecharMesa()" class="btn btn-primary">Fechar Mesa</button>
            <a href="../index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    <script>
        function adicionarProduto() {
            const nomeProduto = document.getElementById('nomeProduto').value;
            const quantidadeProduto = document.getElementById('quantidadeProduto').value;

            fetch('adicionar_produto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ mesa_id: <?php echo $mesa_id; ?>, nome: nomeProduto, quantidade: quantidadeProduto })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Erro:', error));
        }

        function excluirProduto(produtoId) {
            fetch('excluir_produto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ produto_id: produtoId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Erro:', error));
        }

        function fecharMesa() {
            fetch('fechar_mesa.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ mesa_id: <?php echo $mesa_id; ?> })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Mesa fechada com sucesso.');
                    window.location.href = '../index.php';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    </script>
</body>
</html>
