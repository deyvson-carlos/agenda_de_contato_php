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
        try{
            // $phonesString = implode(',', $phone);
            $stmt = $this->pdo->prepare(" INSERT INTO contacts (name, email, phones, street, city, state, cep) 
                VALUES (:name, :email, :phone, :street, :city, :state, :cep)");
                
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':street', $street);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':state', $state);
            $stmt->bindParam(':cep', $cep);

            // Executar a instrução SQL
            $stmt->execute();
           // Fetch the last inserted record
            $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE id = LAST_INSERT_ID()");
            $stmt->execute();
            $lastInsertedRecord = $stmt->fetch(PDO::FETCH_ASSOC);

            // You can return any other relevant information as well
            return [
                'message' => 'Contato inserido com sucesso!',
                'schedule' => $lastInsertedRecord,
            ];

        } catch (Exception $e) {
            // Capturar a exceção em caso de erro na inserção
            return $e->getMessage();
        }
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


