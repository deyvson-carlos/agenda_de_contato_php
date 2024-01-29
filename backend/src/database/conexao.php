<?php

function conectarBancoDeDados() {
    $hostname = 'localhost';
    $dbname = 'agenda_contatos';
    $username = 'root';
    $password = '';

    try {

        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch (PDOException $e) {
        echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        return null; 
    }
}