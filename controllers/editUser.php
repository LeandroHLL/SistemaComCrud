<?php
require_once '../config/Database.php';
require_once 'UserController.php';

$database = new Database();
$conn = $database->getConnection();
$userController = new UserController($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userController->getUserById($id);


    if (!$user) {
        header("Location: ../views/system.php?message=Usuário não encontrado");
        exit();
    }
} else {
    header("Location: ../views/system.php?message=ID do usuário não fornecido");
    exit();
}

// Processa o formulário de edição
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];

    if ($userController->updateUser($id, $nome, $email, $telefone, $cpf)) {
        header("Location: ../views/system.php?message=Usuário atualizado com sucesso");
        exit();
    } else {
        $error = "Erro ao atualizar usuário";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Usuário</h1>

    <?php if (isset($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Erro!</strong>
            <span class="block sm:inline"><?= $error ?></span>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-4">
            <label for="nome" class="block text-gray-700">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($user['nome']) ?>" required class="border border-gray-300 rounded p-2 w-full">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required class="border border-gray-300 rounded p-2 w-full">
        </div>
        <div class="mb-4">
            <label for="telefone" class="block text-gray-700">Telefone</label>
            <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($user['telefone']) ?>" required class="border border-gray-300 rounded p-2 w-full">
        </div>
        <div class="mb-4">
            <label for="cpf" class="block text-gray-700">CPF</label>
            <input type="text" name="cpf" id="cpf" value="<?= htmlspecialchars($user['cpf']) ?>" required class="border border-gray-300 rounded p-2 w-full">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Atualizar Usuário</button>
    </form>

    <a href="../views/system.php" class="inline-block mt-4 text-blue-500 hover:underline">Voltar à lista de usuários</a>
</body>

</html>