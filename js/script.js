function criarMesa() {
    var nomeMesa = document.getElementById('nomeMesa').value;
    if (nomeMesa === "") {
        alert("Por favor, insira um nome para a mesa.");
        return;
    }

    // Chamada AJAX para criar a mesa no banco de dados
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "success") {
                carregarMesas();
            } else {
                alert("Erro ao criar mesa.");
            }
        }
    };
    xhttp.open("POST", "criar_mesa.php", true); // Certifique-se de que o caminho está correto
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("nome=" + nomeMesa);
}

function carregarMesas() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('mesas').innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "carregar_mesas.php", true); // Certifique-se de que o caminho está correto
    xhttp.send();
}

// Carrega as mesas ao abrir a página
window.onload = function() {
    carregarMesas();
};

