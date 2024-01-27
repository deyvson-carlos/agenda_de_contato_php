<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Max-Age: 3600"); // Tempo em segundos que as informações podem ser cacheadas

$hostname = 'localhost';
$dbname = 'agenda_contatos';
$username = 'root';
$password = '';

try {
    // Tentar estabelecer a conexão com o banco de dados
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

    // Configurar o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Se a conexão for bem-sucedida, você pode realizar operações no banco de dados aqui

    echo 'Conexão bem-sucedida!';
} catch (PDOException $e) {
    // Capturar a exceção em caso de erro na conexão
    echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
}
?>