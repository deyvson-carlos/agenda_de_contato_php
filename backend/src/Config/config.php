<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'agenda_contatos');


$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
}
