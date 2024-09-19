<?php
require_once '../config/Database.php';
require_once '../models/UserModel.php';

class UserController {
    private $model;

    public function __construct($db) {
        $this->model = new UserModel($db);
    }

    public function createUser($data) {
        return $this->model->registerUser($data['nome'], $data['email'], $data['telefone'], $data['cpf'], $data['senha']);
    }

    public function listUsers() {
        return $this->model->getUsers();
    }

    public function deleteUser($id)
{
    if ($this->model->deleteUser($id)) {
        header("Location: ../views/system.php?message=Usuário excluído com sucesso");
    } else {
        header("Location: ../views/system.php?error=Erro ao excluir usuário");
    }
}
}
?>
