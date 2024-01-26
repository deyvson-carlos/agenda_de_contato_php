namespace ContactAgenda\Route;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/api/contacts') {
  
    include __DIR__ . '/../Controller/ContactController.php';
    include __DIR__ . '/routes.php';
    $contactController = new \ContactAgenda\Controller\ContactController();

    $requestData = json_decode(file_get_contents('php://input'), true);

    echo $contactController->createContact(
        $requestData['name'],
        $requestData['email'],
        $requestData['phones'],
        $requestData['street'],
        $requestData['city'],
        $requestData['state'],
        $requestData['cep']
    );
}
