<?php
class UserModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nome, $hashed_password);

            if ($stmt->num_rows > 0) {
                $stmt->fetch();
                $stmt->close();
                return ['id' => $id, 'nome' => $nome, 'senha' => $hashed_password];
            } else {
                $stmt->close();
                return null;
            }
        } else {
            echo "Erro na preparação da consulta: " . $this->conn->error;
            return null;
        }
    }

    public function registerUser($nome, $email, $telefone, $cpf, $senha)
    {
        $hashed_password = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, telefone, cpf, senha) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sssss", $nome, $email, $telefone, $cpf, $hashed_password);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                echo "Erro ao executar a consulta: " . $stmt->error;
                $stmt->close();
                return false;
            }
        } else {
            echo "Erro na preparação da consulta: " . $this->conn->error;
            return false;
        }
    }


    public function userExists($email, $cpf)
    {
        $sql = "SELECT id FROM usuarios WHERE email = ? OR cpf = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ss", $email, $cpf);
            $stmt->execute();
            $stmt->store_result();
            $numRows = $stmt->num_rows;
            $stmt->close();
            return $numRows > 0;
        } else {
            echo "Erro na preparação da consulta: " . $this->conn->error;
            return false;
        }
    }
    public function getUsers()
    {
        $sql = "SELECT id, nome, email, telefone, cpf FROM usuarios";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                echo "Erro ao executar a consulta: " . $stmt->error;
                $stmt->close();
                return false;
            }
        } else {
            echo "Erro na preparação da consulta: " . $this->conn->error;
            return false;
        }
    }

    public function getUserById($id)
    {
        $sql = "SELECT id, nome, email, telefone, cpf FROM usuarios WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nome, $email, $telefone, $cpf);

            if ($stmt->num_rows > 0) {
                $stmt->fetch();
                $stmt->close();
                return ['id' => $id, 'nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'cpf' => $cpf];
            } else {
                $stmt->close();
                return null;
            }
        } else {
            echo "Erro na preparação da consulta: " . $this->conn->error;
            return null;
        }
    }

    public function updateUser($id, $nome, $email, $telefone, $cpf)
    {
        $sql = "UPDATE usuarios SET nome = ?, email = ?, telefone = ?, cpf = ? WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ssssi", $nome, $email, $telefone, $cpf, $id);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                echo "Erro ao executar a consulta: " . $stmt->error;
                $stmt->close();
                return false;
            }
        } else {
            echo "Erro na preparação da consulta: " . $this->conn->error;
            return false;
        }
    }
}
