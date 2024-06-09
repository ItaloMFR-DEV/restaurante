<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .mesa {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <script src="js/script.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Nome do Aplicativo</h1>
        <button onclick="window.location.href='pages/login.php'" class="btn btn-primary">Administração</button>

        <div class="mt-4">
            <input type="text" id="nomeMesa" class="form-control" placeholder="Nome da Mesa">
            <button onclick="criarMesa()" class="btn btn-success mt-2">Criar Mesa</button>
        </div>

        <div id="mesas" class="row mt-4">
            <!-- Mesas serão carregadas aqui -->
        </div>
    </div>
</body>
</html>
