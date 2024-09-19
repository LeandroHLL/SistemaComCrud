<?php
// get_users.php
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

// Consulta SQL para obter usuários
$sql = "SELECT id, nome, email, telefone, cpf FROM usuarios";
$result = $conn->query($sql);

$users = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode($users);

// Fecha conexão
$conn->close();
?>
