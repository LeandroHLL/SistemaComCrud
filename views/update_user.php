<?php
// update_user.php
header('Content-Type: application/json');

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sua_base_de_dados";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtém dados do usuário
$data = json_decode(file_get_contents('php://input'), true);
$id = intval($data['id']);
$nome = $conn->real_escape_string($data['nome']);
$email = $conn->real_escape_string($data['email']);
$telefone = $conn->real_escape_string($data['telefone']);
$cpf = $conn->real_escape_string($data['cpf']);
$senha = $conn->real_escape_string($data['senha']);

// Criptografa a senha (opcional, dependendo de como você armazena as senhas)
$senha = password_hash($senha, PASSWORD_DEFAULT);

// Consulta SQL para atualizar o usuário
$sql = "UPDATE usuarios SET nome = '$nome', email = '$email', telefone = '$telefone', cpf = '$cpf', senha = '$senha' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "error" => $conn->error));
}

// Fecha conexão
$conn->close();
?>
