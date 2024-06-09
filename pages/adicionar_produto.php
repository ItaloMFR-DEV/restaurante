<?php
include '../conexao.php';

// Define o cabeçalho como JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $mesa_id = $data['mesa_id'];
    $produto_nome = $data['nome'];
    $quantidade = $data['quantidade'];

    // Busca o produto pelo nome
    $sql = "SELECT * FROM produtos WHERE nome = '$produto_nome'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $produto = $result->fetch_assoc();
        $produto_id = $produto['id'];
        $valor = $produto['valor'];
        $total = $quantidade * $valor;

        // Adiciona o produto à mesa
        $sql = "INSERT INTO itens_mesa (mesa_id, produto_id, quantidade) VALUES ('$mesa_id', '$produto_id', '$quantidade')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["success" => true, "message" => "Produto adicionado com sucesso."]);
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao adicionar produto: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Produto não encontrado."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método inválido."]);
}
?>
