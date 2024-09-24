<?php
require_once '../config/Database.php';
require_once '../controllers/UserController.php';

$database = new Database();
$conn = $database->getConnection();
$userController = new UserController($conn);
$users = $userController->listUsers();
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Administrativo - Usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden">
    <!-- Menu Lateral -->
    <aside class="bg-gray-800 text-white w-64 min-h-screen p-4">
        <nav>
            <div class="flex items-center mb-8">
                <svg class="h-8 w-8 fill-current text-blue-400 mr-2" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z" />
                </svg>
                <span class="text-xl font-bold">AdminSys</span>
            </div>
            <ul class="space-y-2">
                <li>
                    <a href="#usuarios" class="flex items-center space-x-2 p-2 rounded-lg bg-gray-700">
                        <i class="fas fa-users"></i>
                        <span>Usuários</span>
                    </a>
                </li>
                <li>
                    <a href="#produtos" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-box"></i>
                        <span>Produtos</span>
                    </a>
                </li>
                <li>
                    <a href="#pedidos" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Pedidos</span>
                    </a>
                </li>
                <li>
                    <a href="#relatorios" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-chart-bar"></i>
                        <span>Relatórios</span>
                    </a>
                </li>
                <li>
                    <a href="#configuracoes" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-cog"></i>
                        <span>Configurações</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="flex-1 p-6 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Usuários Cadastrados</h1>
            <div class="flex items-center space-x-4">
                <a href="cadastro2.php" class="bg-blue-500 hover:bg-green-600 text-white py-2 px-4 rounded-full">
                    <i class="fas fa-plus mr-2"></i>Cadastrar Usuário
                </a>
                <a href="../index.php" class="bg-gray-500 hover:bg-red-600 text-white py-2 px-4 rounded-full">
                    <i class="fas fa-home mr-2"></i>Voltar ao Índice
                </a>
            </div>
        </div>

        <!-- Mensagem de feedback -->
        <?php if ($message): ?>
            <div id="feedback-message" class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Tabela de Usuários -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <table id="usersTable" class="min-w-full table-auto">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nome</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Telefone</th>
                            <th class="px-4 py-2">CPF</th>
                            <th class="px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="border px-4 py-2"><?= $user['id'] ?></td>
                                <td class="border px-4 py-2"><?= $user['nome'] ?></td>
                                <td class="border px-4 py-2"><?= $user['email'] ?></td>
                                <td class="border px-4 py-2"><?= $user['telefone'] ?></td>
                                <td class="border px-4 py-2"><?= $user['cpf'] ?></td>
                                <td class="border px-4 py-2 flex space-x-2">
                                    <a href="../controllers/editUser.php?id=<?= $user['id'] ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="deleteUser.php?id=<?= $user['id'] ?>" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();

            setTimeout(function() {
                $('#feedback-message').fadeOut();
            }, 5000);
        });
    </script>
</body>

</html>