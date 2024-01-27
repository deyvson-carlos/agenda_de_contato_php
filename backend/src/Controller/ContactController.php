<?php

namespace agenda_de_contato_php\Controller;

use Model\Contact_model\Contact_model;

class ContactController
{
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
}
