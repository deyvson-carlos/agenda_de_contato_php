<?php

function conectarBancoDeDados() {
    $hostname = 'localhost';
    $dbname = 'seu_banco_de_dados';
    $username = 'seu_usuario';
    $password = 'sua_senha';

    try {
        // Tentar estabelecer a conexão com o banco de dados
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

        // Configurar o PDO para lançar exceções em caso de erro
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch (PDOException $e) {
        // Capturar a exceção em caso de erro na conexão
        echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        return null; // Retorna null em caso de falha na conexão
    }
}