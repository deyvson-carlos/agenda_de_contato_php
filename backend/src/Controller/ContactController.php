<?php

// ContactController.php

namespace agenda_de_contato_php\Controller;

use Model\Contact_model\Contact_model;

class ContactController
{
    private $pdo;
    private $model;

    public function __construct()
    {
        require_once 'src/Model/Contact_model.php';
        $this->model = new Contact_model;
    }

    public function createContact($name, $email, $phone, $smartphone, $street, $city, $state, $cep)
    {
        $result = $this->model->createContact($name, $email, $phone, $smartphone, $street, $city, $state, $cep);
        return $result;
    }

    public function getAllContacts()
    {
        $contacts = $this->model->getAllContacts();
        return $contacts;
    }
    

    public function deleteContact($contactId)
    {
        
        $contactModel = new Contact_model;
        $result = $contactModel->deleteContact($contactId);

        return $result;
    }

    public function updateContact($contactId, $name, $email, $phone, $street, $city, $state, $cep)
    {
        $result = $this->model->updateContact($contactId, $name, $email, $phone, $street, $city, $state, $cep);
        return $result;
    }

}