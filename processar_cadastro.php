<?php
$servername = "localhost"; // O nome do servidor
$username = "root"; // O nome de usuário do MySQL
$password = ""; // A senha do MySQL
$dbname = "atv2"; // O nome do banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário de cadastro
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verificar se o CPF ou email já existem
    $sql = "SELECT id FROM usuarios WHERE cpf = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $cpf, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        header('Location: index.php?msg=email_ou_cpf_existente');
    } else {
        // Inserir o usuário no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, telefone, cpf, senha) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $email, $telefone, $cpf, $senha);

        if ($stmt->execute()) {
            header('Location: index.php?msg=cadastro_sucesso');
        } else {
            header('Location: index.php?msg=cadastro_falha');
        }
    }

    $stmt->close();
}

$conn->close();
