<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Veículo</title>
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

// processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];

    // inserir veículo no banco de dados
    $sql = "INSERT INTO veiculos (modelo, placa, hora_entrada) VALUES ('$modelo', '$placa', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Veículo adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar veículo: " . $conn->error;
    }
}

// consulta os veículos cadastrados
$sql_veiculos = "SELECT modelo, placa FROM veiculos";
$result_veiculos = $conn->query($sql_veiculos);

if ($result_veiculos->num_rows > 0) {
    echo "<h2>Veículos Cadastrados:</h2>";
    echo "<ul>";
    while ($row = $result_veiculos->fetch_assoc()) {
        echo "<li>Modelo: " . $row["modelo"] . " - Placa: " . $row["placa"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Nenhum veículo cadastrado.";
}

$conn->close();
?>
</form>
</body>
</html>
