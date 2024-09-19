<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUserByEmail($email) {
        $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $nome, $hashed_password);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();
            return ['id' => $id, 'nome' => $nome, 'senha' => $hashed_password];
        } else {
            return null;
        }

        $stmt->close();
    }

    public function registerUser($nome, $email, $telefone, $cpf, $senha) {
        $hashed_password = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, telefone, cpf, senha) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $email, $telefone, $cpf, $hashed_password);
        return $stmt->execute();
    }

    public function userExists($email, $cpf) {
        $sql = "SELECT id FROM usuarios WHERE email = ? OR cpf = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $cpf);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
}
?>
