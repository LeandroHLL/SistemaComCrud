<?php
// add_user.php
header('Content-Type: application/json');

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "atv2";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtém dados do POST
$data = json_decode(file_get_contents('php://input'), true);

$nome = $data['nome'];
$email = $data['email'];
$telefone = $data['telefone'];
$cpf = $data['cpf'];
$senha = password_hash($data['senha'], PASSWORD_DEFAULT);

// Consulta SQL para adicionar usuário
$sql = "INSERT INTO usuarios (nome, email, telefone, cpf, senha) VALUES ('$nome', '$email', '$telefone', '$cpf', '$senha')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "error" => $conn->error));
}

// Fecha conexão
$conn->close();
?>
