<?php
require_once '../models/UserModel.php';
require_once '../config/database.php';

class RegisterController
{
    private $userModel;

    public function __construct()
    {
        $db = new Database();
        $this->userModel = new UserModel($db->getConnection());
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $cpf = $_POST['cpf'];
            $senha = $_POST['senha'];

            if ($this->userModel->userExists($email, $cpf)) {
                header('Location: ../views/cadastro2.php?msg=email_ou_cpf_existente');
                exit();
            }

            if ($this->userModel->registerUser($nome, $email, $telefone, $cpf, $senha)) {
                header('Location: ../views/system.php');
            } else {
                header('Location: ../views/cadastro2.php?msg=cadastro_falha');
            }
            exit();
        }
    }
}

$controller = new RegisterController();
$controller->register();
