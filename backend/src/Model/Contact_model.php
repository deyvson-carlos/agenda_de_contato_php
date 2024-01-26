<?php

namespace ContactAgenda\Model;

class Contact_model
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createContact($name, $email, $phones, $street, $city, $state, $cep)
    {
        $phonesString = implode(',', $phones);

        $sql = "INSERT INTO contacts (name, email, phones, street, city, state, cep) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssss", $name, $email, $phonesString, $street, $city, $state, $cep);

        if ($stmt->execute()) {
            return "Contato criado com sucesso!";
        } else {
            return "Erro ao criar contato: " . $stmt->error;
        }
    }


    public function updateContact($id, $name, $email, $phones, $street, $city, $state, $cep)
    {
        $sql = "UPDATE contacts SET name=?, email=?, phones=?, street=?, city=?, state=?, cep=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssi", $name, $email, $phones, $street, $city, $state, $cep, $id);

        if ($stmt->execute()) {
            return "Contato atualizado com sucesso!";
        } else {
            return "Erro ao atualizar contato: " . $stmt->error;
        }
    }

    public function getContacts()
    {
        $sql = "SELECT * FROM contacts";
        $result = $this->conn->query($sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return "Erro ao obter contatos: " . $this->conn->error;
        }
    }

    public function deleteContact($id)
    {
        $sql = "DELETE FROM contacts WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Contato excluído com sucesso!";
        } else {
            return "Erro ao excluir contato: " . $stmt->error;
        }
    }
}
