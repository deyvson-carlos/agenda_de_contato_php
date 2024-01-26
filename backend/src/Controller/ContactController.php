<?php

namespace ContactAgenda\Controller;

class ContactController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createContact($name, $email, $phones, $street, $city, $state, $cep) {
        if ($this->emailExists($email)) {
            return json_encode(["error" => "E-mail já cadastrado"]);
        }

        $this->conn->begin_transaction();

        try {
            $sqlContact = "INSERT INTO contacts (name, email, street, city, state, cep) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtContact = $this->conn->prepare($sqlContact);
            $stmtContact->bind_param("ssssss", $name, $email, $street, $city, $state, $cep);

            if (!$stmtContact->execute()) {
                throw new \Exception("Erro ao criar contato: " . $stmtContact->error);
            }

            $contactId = $stmtContact->insert_id;

            $sqlPhones = "INSERT INTO phones (contact_id, phone_number) VALUES (?, ?)";
            $stmtPhones = $this->conn->prepare($sqlPhones);
            $stmtPhones->bind_param("is", $contactId, $phoneNumber);

            foreach ($phones as $phoneNumber) {
                if (!$stmtPhones->execute()) {
                    throw new \Exception("Erro ao criar telefone: " . $stmtPhones->error);
                }
            }

            $this->conn->commit();

            return json_encode(["message" => "Contato criado com sucesso"]);
        } catch (\Exception $e) {
            $this->conn->rollback();

            error_log("Erro ao criar contato: " . $e->getMessage());
            return json_encode(["error" => "Erro ao criar contato: " . $e->getMessage()]);
        } finally {
            if (isset($stmtContact)) {
                $stmtContact->close();
            }
            if (isset($stmtPhones)) {
                $stmtPhones->close();
            }
        }
    }

    private function emailExists($email) {
        $sql = "SELECT id FROM contacts WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $rowCount = $stmt->num_rows;
        $stmt->close();

        return $rowCount > 0;
    }
}
