<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Administrativo - Usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden">
    <!-- Menu Lateral -->
    <aside class="bg-gray-800 text-white w-64 min-h-screen p-4">
        <nav>
            <div class="flex items-center mb-8">
                <svg class="h-8 w-8 fill-current text-blue-400 mr-2" viewBox="0 0 54 54"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z" />
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
                <button id="openModal" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full">
                    <i class="fas fa-plus mr-2"></i>Novo Usuário
                </button>
            </div>
        </div>

        <!-- Tabela de Usuários -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <table id="usersTable" class="w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>CPF</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Os dados serão preenchidos dinamicamente pelo DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal de Cadastro de Usuário -->
    <div id="userModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 id="userModalTitle" class="text-lg leading-6 font-medium text-gray-900">Cadastro de Novo Usuário
                </h3>
                <form id="userForm" class="mt-2 text-left" data-mode="add" data-id="">
                    <div class="mb-4">
                        <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                        <input type="text" id="nome" name="nome"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" id="email" name="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="telefone" class="block text-gray-700 text-sm font-bold mb-2">Telefone:</label>
                        <input type="tel" id="telefone" name="telefone"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="cpf" class="block text-gray-700 text-sm font-bold mb-2">CPF:</label>
                        <input type="text" id="cpf" name="cpf"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="senha" class="block text-gray-700 text-sm font-bold mb-2">Senha:</label>
                        <input type="password" id="senha" name="senha"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="confirmSenha" class="block text-gray-700 text-sm font-bold mb-2">Confirmação de
                            Senha:</label>
                        <input type="password" id="confirmSenha" name="confirmSenha"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Cadastrar
                        </button>
                        <button type="button" id="closeModal"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Visualização de Usuário -->
    <div id="viewUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Detalhes do Usuário</h3>
                <div id="userDetails" class="text-left">
                    <!-- User details will be populated here -->
                </div>
                <div class="mt-4">
                    <button id="closeViewModal"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#usersTable').DataTable({
                ajax: {
                    url: 'get_users.php',
                    dataSrc: ''
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'nome'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'telefone'
                    },
                    {
                        data: 'cpf'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                            <button class="text-blue-500 hover:text-blue-700 mr-2 view-btn" data-id="${row.id}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-green-500 hover:text-green-700 mr-2 edit-btn" data-id="${row.id}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700 delete-btn" data-id="${row.id}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        `;
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json'
                }
            });

            // Abrir Modal
            $('#openModal').click(function() {
                $('#userModalTitle').text('Cadastro de Novo Usuário');
                $('#userForm').attr('data-mode', 'add');
                $('#userForm').attr('data-id', '');
                $('#userForm')[0].reset();
                $('#userModal').removeClass('hidden');
            });

            // Fechar Modal
            $('#closeModal').click(function() {
                $('#userModal').addClass('hidden');
            });

            // Fechar Modal de Visualização
            $('#closeViewModal').click(function() {
                $('#viewUserModal').addClass('hidden');
            });

            // Submeter formulário
            $('#userForm').submit(function(e) {
                e.preventDefault();
                if (!validatePasswords()) {
                    return;
                }

                var formData = {
                    nome: $('#nome').val(),
                    email: $('#email').val(),
                    telefone: $('#telefone').val(),
                    cpf: $('#cpf').val(),
                    senha: $('#senha').val()
                };

                var mode = $(this).attr('data-mode');
                if (mode === 'edit') {
                    var id = parseInt($(this).attr('data-id'));
                    updateUser(id, formData);
                } else {
                    addNewUser(formData);
                }

                $('#userModal').addClass('hidden');
                this.reset();
            });

            function addNewUser(userData) {
                $.ajax({
                    url: 'add_user.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(userData),
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload();
                        } else {
                            alert('Erro ao adicionar usuário: ' + response.error);
                        }
                    }
                });
            }

            function updateUser(id, userData) {
                $.ajax({
                    url: 'update_user.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        id: id,
                        ...userData
                    }),
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload();
                            alert('Usuário atualizado com sucesso!');
                        } else {
                            alert('Erro ao atualizar usuário: ' + response.error);
                        }
                    }
                });
            }

            // Função para visualizar detalhes do usuário
            function viewUser(id) {
                // Implementar a lógica para visualizar detalhes do usuário
                console.log('Visualizar usuário', id);
            }

            // Função para editar o usuário
            function editUser(id) {
                // Buscar dados do usuário
                $.ajax({
                    url: 'get_user.php',
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            var user = response.data;
                            $('#nome').val(user.nome);
                            $('#email').val(user.email);
                            $('#telefone').val(user.telefone);
                            $('#cpf').val(user.cpf);
                            $('#senha').val(''); // Não preenche a senha por segurança
                            $('#confirmSenha').val(''); // Não preenche a senha por segurança
                            $('#userModalTitle').text('Editar Usuário');
                            $('#userForm').attr('data-mode', 'edit');
                            $('#userForm').attr('data-id', user.id);
                            $('#userModal').removeClass('hidden');
                        } else {
                            alert('Erro ao obter dados do usuário: ' + response.error);
                        }
                    }
                });
            }

            // Função para deletar o usuário
            function deleteUser(id) {
                if (confirm('Tem certeza que deseja deletar o usuário ' + id + '?')) {
                    $.ajax({
                        url: 'delete_user.php',
                        method: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify({
                            id: id
                        }),
                        success: function(response) {
                            if (response.success) {
                                table.ajax.reload();
                                alert('Usuário deletado com sucesso!');
                            } else {
                                alert('Erro ao deletar usuário: ' + response.error);
                            }
                        }
                    });
                }
            }

            // Adiciona validação de CPF ao formulário
            document.getElementById('cpf').addEventListener('blur', function() {
                if (!validarCPF(this.value)) {
                    alert('CPF inválido');
                    this.value = '';
                }
            });

            // Função para validar CPF
            function validarCPF(cpf) {
                cpf = cpf.replace(/[^\d]+/g, '');
                if (cpf == '') return false;
                if (cpf.length != 11 ||
                    cpf == "00000000000" ||
                    cpf == "11111111111" ||
                    cpf == "22222222222" ||
                    cpf == "33333333333" ||
                    cpf == "44444444444" ||
                    cpf == "55555555555" ||
                    cpf == "66666666666" ||
                    cpf == "77777777777" ||
                    cpf == "88888888888" ||
                    cpf == "99999999999")
                    return false;
                add = 0;
                for (i = 0; i < 9; i++)
                    add += parseInt(cpf.charAt(i)) * (10 - i);
                rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(9)))
                    return false;
                add = 0;
                for (i = 0; i < 10; i++)
                    add += parseInt(cpf.charAt(i)) * (11 - i);
                rev = 11 - (add % 11);
                if (rev == 10 || rev == 11)
                    rev = 0;
                if (rev != parseInt(cpf.charAt(10)))
                    return false;
                return true;
            }

            // Eventos de clique para os botões
            $('#usersTable').on('click', '.view-btn', function() {
                var id = $(this).data('id');
                viewUser(id);
            });

            $('#usersTable').on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                editUser(id);
            });

            $('#usersTable').on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                deleteUser(id);
            });
        });
    </script>



</body>

</html>