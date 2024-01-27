<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Max-Age: 3600"); // Tempo em segundos que as informações podem ser cacheadas

require_once '../vendor/autoload.php';

use ContactAgenda\Controller\ContactController;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agenda_contatos";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$contactController = new ContactController($conn);

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type");


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    
    http_response_code(204);
    exit();
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
     
        $data = json_decode(file_get_contents('php://input'), true);

        $name = $data['name'];
        $email = $data['email'];
        $phones = $data['phones'];
        $street = $data['street'];
        $city = $data['city'];
        $state = $data['state'];
        $cep = $data['cep'];

        $result = $contactController->createContact($name, $email, $phones, $street, $city, $state, $cep);
        echo json_encode(['message' => $result]);
        break;

    case 'GET':
        $result = $contactController->getContacts();
        echo json_encode($result);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);

        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $phones = $data['phones'];
        $street = $data['street'];
        $city = $data['city'];
        $state = $data['state'];
        $cep = $data['cep'];

        $result = $contactController->updateContact($id, $name, $email, $phones, $street, $city, $state, $cep);
        echo json_encode(['message' => $result]);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);

        $id = $data['id'];

        $result = $contactController->deleteContact($id);
        echo json_encode(['message' => $result]);
        break;

    default:
        echo json_encode(['error' => 'Método não permitido']);
        break;
}

$conn->close();
