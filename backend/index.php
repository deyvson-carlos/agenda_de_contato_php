<?php
require_once 'src/util/config.php';
require_once 'src/Controller/ContactController.php';
use agenda_de_contato_php\Controller\ContactController;

$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$email = $data['email'];
$phone = !empty($data['phone']) ? $data['phone'] : '81999999999';
$smartphone = !empty($data['smartphone']) ? $data['smartphone'] : '81999999999';
$street = $data['street'];
$city = $data['city'];
$state = $data['state'];
$cep = $data['cep'];
$contactController = new ContactController;
$result = $contactController->createContact($name, $email, $phone, $smartphone, $street, $city, $state, $cep);

echo json_encode($result);
