<?php
include '../conexao.php';

// Define o cabeçalho como JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $produto_id = $data['produto_id'];

    // Exclui o produto da mesa
    $sql = "DELETE FROM itens_mesa WHERE id = $produto_id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Produto excluído com sucesso."]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao excluir produto: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método inválido."]);
}
?>
