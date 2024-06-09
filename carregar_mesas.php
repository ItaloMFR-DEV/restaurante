<?php
include 'conexao.php';

$sql = "SELECT * FROM mesas WHERE status = 'aberta'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='mesa'><b><h1><a href='pages/mesa.php?id=" . $row['id'] . "'>" . $row['nome'] . "</a><h1></b></div>";
    }
} else {
    echo "Nenhuma mesa criada.";
}
?>
