<?php
session_start();
include 'admin_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o usuário e senha correspondem aos definidos no arquivo de configuração
    if ($_POST['username'] === ADMIN_USERNAME && $_POST['password'] === ADMIN_PASSWORD) {
        // Autenticação bem-sucedida, redireciona para a área administrativa
        $_SESSION['username'] = $_POST['username'];
        header("Location: admin.php");  // Corrige o caminho para redirecionar corretamente
        exit();
    } else {
        // Autenticação falhou, exibe uma mensagem de erro
        $error = "Usuário ou senha inválidos.";
    }
}
?>
