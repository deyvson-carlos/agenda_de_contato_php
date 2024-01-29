<?php

namespace Model\Contact_model;

use Exception;
use PDO;

class Contact_model
{
    private $pdo;

    public function __construct()
    {
        require_once 'src/database/conexao.php';
        $this->pdo = conectarBancoDeDados();
    }

    public function createContact($name, $email, $phone, $smartphone, $street, $city, $state, $cep)
    {
        try {
            
            $existingContact = $this->getContactByEmail($email);

            if ($existingContact) {
                return ['error' => 'Já existe um contato com o mesmo e-mail.'];
            }


            $stmt = $this->pdo->prepare("INSERT INTO contacts (name, email, phones, street, city, state, cep) 
            VALUES (:name, :email, :phone, :street, :city, :state, :cep)");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':street', $street);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':state', $state);
            $stmt->bindParam(':cep', $cep);

            $stmt->execute();

            $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE id = LAST_INSERT_ID()");
            $stmt->execute();
            $lastInsertedRecord = $stmt->fetch(PDO::FETCH_ASSOC);

            return [
                'message' => 'Contato inserido com sucesso!',
                'contact' => $lastInsertedRecord,
            ];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getContactByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);

        return $contact;
    }


    public function getAllContacts()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM contacts");
            $stmt->execute();
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $contacts;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

<<<<<<< HEAD
    public function deleteContact($contactId)
    {
        try {
            // $stmt = $this->pdo->prepare("UPDATE contacts SET deleted = 1 WHERE id = :id");
            $stmt = $this->pdo->prepare("DELETE FROM contacts WHERE id = :id");
            $stmt->bindParam(':id', $contactId);
            $stmt->execute();

            $contacts = $this->getAllContacts();

            return ['success' => true];
        } catch (Exception $e) {
            return ['error' => 'Erro ao excluir contato: ' . $e->getMessage()];
        }
    }

    public function updateContact($contactId, $name, $email, $phone, $street, $city, $state, $cep)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE contacts SET 
            name = :name, 
            email = :email, 
            phones = :phone, 
            street = :street, 
            city = :city, 
            state = :state, 
            cep = :cep 
            WHERE id = :id");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':street', $street);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':state', $state);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':id', $contactId);

            $stmt->execute();

            return ['success' => true];
        } catch (Exception $e) {
            return ['error' => 'Erro ao atualizar contato: ' . $e->getMessage()];
        }
=======
    public function getAllContacts()
{
    try {
        $stmt = $this->pdo->prepare("SELECT * FROM contacts");
        $stmt->execute();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $contacts;
    } catch (Exception $e) {
        return $e->getMessage();
>>>>>>> 652ae1aa194dc287671180a17a796df4145a4333
    }
}

public function deleteContact($contactId)
    {
        // var_dump('oi');die();
        try {
            // $stmt = $this->pdo->prepare("UPDATE contacts SET deleted = 1 WHERE id = :id");
            $stmt = $this->pdo->prepare("DELETE FROM contacts WHERE id = :id");
            $stmt->bindParam(':id', $contactId);
            $stmt->execute();

            $contacts = $this->getAllContacts();
            
            return ['success' => true];
        } catch (Exception $e) {
            return ['error' => 'Erro ao excluir contato: ' . $e->getMessage()];
        }
    }


    public function updateContact($contactId, $name, $email, $phone, $street, $city, $state, $cep)
{
    try {
        $stmt = $this->pdo->prepare("UPDATE contacts SET 
            name = :name, 
            email = :email, 
            phones = :phone, 
            street = :street, 
            city = :city, 
            state = :state, 
            cep = :cep 
            WHERE id = :id");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':id', $contactId);

        $stmt->execute();

        return ['success' => true];
    } catch (Exception $e) {
        return ['error' => 'Erro ao atualizar contato: ' . $e->getMessage()];
    }
}


}


