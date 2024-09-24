<?php
require_once '../config/Database.php';
require_once 'UserController.php';

$database = new Database();
$conn = $database->getConnection();
$userController = new UserController($conn);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $userController->deleteUser($id);
} else {
    header("Location: ../views/system.php?error=ID inválido");
}
?>
