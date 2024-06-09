<?php
include '../conexao.php';

// Define o cabeçalho como JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $mesa_id = $data['mesa_id'];

    // Calcula o total da mesa
    $sql = "SELECT SUM(p.valor * im.quantidade) as total 
            FROM itens_mesa im 
            JOIN produtos p ON im.produto_id = p.id
            WHERE im.mesa_id = $mesa_id";
    $result = $conn->query($sql);

    if ($result) {
        $total = $result->fetch_assoc()['total'];

        // Fecha a mesa
        $sql_update = "UPDATE mesas SET status = 'fechada', valor_total = '$total' WHERE id = $mesa_id";

        if ($conn->query($sql_update) === TRUE) {
            // Insere o valor da mesa na tabela de vendas
            $sql_insert = "INSERT INTO vendas (mesa_id, valor_total, data_hora_fechamento) 
                           VALUES ($mesa_id, '$total', NOW())";

            if ($conn->query($sql_insert) === TRUE) {
                // Limpa os produtos da mesa
                $sql_delete = "DELETE FROM itens_mesa WHERE mesa_id = $mesa_id";
                $conn->query($sql_delete);
                
                echo json_encode(["success" => true, "message" => "Mesa fechada com sucesso."]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao inserir valor da mesa na tabela de vendas: " . $conn->error]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao fechar mesa: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao calcular total da mesa: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método inválido."]);
}
?>
