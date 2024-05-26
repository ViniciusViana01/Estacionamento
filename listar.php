<?php
// Conexão com o banco de dados
$dsn = 'mysql:host=localhost;dbname=estacionamento';
$username = 'root';
$password = '';

try {
    // Estabelece a conexão com o banco de dados
    $db = new PDO($dsn, $username, $password);

    $sql = 'SELECT veiculos, placa FROM veiculos';

    // Prepara e executa a consulta
    $stmt = $db->prepare($sql);
    $stmt->execute();

    // Recupera os resultados da consulta como um array associativo
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se há carros registrados
    if (count($cars) > 0) {
        // Exibe a lista de carros e placas
        echo '<h2>Lista de Carros Registrados</h2>';
        echo '<table border="1">';
        echo '<tr><th>Carro</th><th>Placa</th></tr>';
        foreach ($cars as $car) {
            echo '<tr><td>' . $car['veiculos'] . '</td><td>' . $car['placa'] . '</td></tr>';
        }
        echo '</table>';
    } else {
        // Mensagem informando que não há carros registrados
        echo '<h2>Não há carros registrados no momento.</h2>';
    }
} catch (PDOException $e) {
    // Exibe a mensagem de erro em caso de falha na conexão
    echo 'Erro ao conectar-se com o banco de dados: ' . $e->getMessage();
}

// Encerra a conexão com o banco de dados
$db = null;
?>
