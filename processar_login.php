<?php
session_start(); // Inicia a sessão

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "atv2";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o usuário existe
    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nome, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();

        // Verificar a senha
        if (password_verify($senha, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $nome;
            header('Location: system.html');
            exit();
        } else {
            header('Location: index.php?msg=login_falha');
            exit();
        }
    } else {
        header('Location: index.php?msg=login_falha');
        exit();
    }

    $stmt->close();
}

$conn->close();
