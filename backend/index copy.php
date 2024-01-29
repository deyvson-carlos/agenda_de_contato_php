<?php
require_once 'src/util/config.php';
require_once 'src/Controller/ContactController.php';
use agenda_de_contato_php\Controller\ContactController;

$contactController = new ContactController;

$name = isset($data['name']) ? $data['name'] : 'name';
$email = isset($data['email']) ? $data['email'] : 'teste@gmail.com';
$phone = isset($data['phone']) ? $data['phone'] : '81999999999';
$smartphone = isset($data['smartphone']) ? $data['smartphone'] : '81999999999';
$street = isset($data['street']) ? $data['street'] : 'teste';
$city = isset($data['city']) ? $data['city'] : 'teste';
$state = isset($data['state']) ? $data['state'] : 'teste';
$cep = isset($data['cep']) ? $data['cep'] : '50400800';

$contactController = new ContactController;
$result = $contactController->createContact($name, $email, $phone, $smartphone, $street, $city, $state, $cep);

echo json_encode($result);





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
