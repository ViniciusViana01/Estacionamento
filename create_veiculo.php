<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Veículo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Trebuchet MS', Arial, sans-serif; background-color: #222; color: #fff; padding: 20px; }
        h1 { margin-bottom: 20px; }
        form { background-color: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 10px; }
        label { font-weight: bold; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: rgba(255, 255, 255, 0.5); color: #333; }
        input[type="submit"] { padding: 10px 20px; background-color: #007bff; border: none; color: white; border-radius: 5px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #0056b3; }
    </style>
</head>
<body>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estacionamento";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];

    
    $sql = "INSERT INTO veiculos (modelo, placa, hora_entrada) VALUES ('$modelo', '$placa', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Veículo adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar veículo: " . $conn->error;
    }
}

$conn->close();
?>

<h2>Adicionar Veículo</h2>
<form action="create_veiculo.php" method="POST">
    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo" required><br><br>
    <label for="placa">Placa:</label>
    <input type="text" id="placa" name="placa" required><br><br>
    <button type="submit" class="btn btn-primary">Adicionar Veículo</button>
</form>

<button type="button" class="btn btn-secondary mt-3" onclick="window.location.href='Veiculoscadastrados.php'">Veículos cadastrados</button>



</body>
</html>
