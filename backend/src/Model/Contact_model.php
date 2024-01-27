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


    // public function updateContact($id, $name, $email, $phones, $street, $city, $state, $cep)
    // {
    //     $sql = "UPDATE contacts SET name=?, email=?, phones=?, street=?, city=?, state=?, cep=? WHERE id=?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param("sssssssi", $name, $email, $phones, $street, $city, $state, $cep, $id);

    //     if ($stmt->execute()) {
    //         return "Contato atualizado com sucesso!";
    //     } else {
    //         return "Erro ao atualizar contato: " . $stmt->error;
    //     }
    // }

    // public function getContacts()
    // {
    //     $sql = "SELECT * FROM contacts";
    //     $result = $this->conn->query($sql);

    //     if ($result) {
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     } else {
    //         return "Erro ao obter contatos: " . $this->conn->error;
    //     }
    // }

    // public function deleteContact($id)
    // {
    //     $sql = "DELETE FROM contacts WHERE id=?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param("i", $id);

    //     if ($stmt->execute()) {
    //         return "Contato excluído com sucesso!";
    //     } else {
    //         return "Erro ao excluir contato: " . $stmt->error;
    //     }
    // }
}
