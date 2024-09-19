<?php
session_start();
require_once '../models/UserModel.php';
require_once '../config/database.php';

class LoginController {
    private $userModel;

    public function __construct() {
        $db = new Database();
        $this->userModel = new UserModel($db->getConnection());
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($senha, $user['senha'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nome'];
                header('Location: ../views/system.php');
                exit();
            } else {
                header('Location: ../index.php?msg=login_falha');
                exit();
            }
        }
    }
}

$controller = new LoginController();
$controller->login();
?>
