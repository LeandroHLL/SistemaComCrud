<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.4.3/imask.min.js"></script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <!-- Mensagens de Status -->
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            $messages = [
                'cadastro_sucesso' => ['text-green-500', 'Cadastro realizado com sucesso!'],
                'cadastro_falha' => ['text-red-500', 'Falha no cadastro. Tente novamente.'],
                'email_ou_cpf_existente' => ['text-red-500', 'Email ou CPF já cadastrados!'],
            ];
            if (isset($messages[$msg])) {
                $color = $messages[$msg][0];
                $text = $messages[$msg][1];
                echo "<p class='status-message $color mb-4'>{$text}</p>";
            }
        }
        ?>

        <!-- Formulário de Cadastro -->
        <form id="registerForm" class="space-y-4" action="../controllers/RegController.php" method="POST">
            <div>
                <label for="registerName" class="block mb-1">Nome</label>
                <input type="text" id="registerName" name="nome" class="w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="registerEmail" class="block mb-1">Email</label>
                <input type="email" id="registerEmail" name="email" class="w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="registerPhone" class="block mb-1">Telefone</label>
                <input type="tel" id="registerPhone" name="telefone" class="w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="registerCPF" class="block mb-1">CPF</label>
                <input type="text" id="registerCPF" name="cpf" class="w-full px-3 py-2 border rounded-md" required>
                <p id="cpfError" class="text-red-500 text-sm mt-1 hidden">CPF inválido</p>
            </div>
            <div>
                <label for="registerPassword" class="block mb-1">Senha</label>
                <input type="password" id="registerPassword" name="senha" class="w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="confirmPassword" class="block mb-1">Confirmar Senha</label>
                <input type="password" id="confirmPassword" class="w-full px-3 py-2 border rounded-md" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Cadastrar</button>
        </form>
    </div>

    <script>
        // Máscara para o campo de telefone
        const phoneInput = document.getElementById('registerPhone');
        const phoneMask = IMask(phoneInput, {
            mask: '(00) 00000-0000'
        });

        // Máscara para o campo de CPF
        const cpfInput = document.getElementById('registerCPF');
        const cpfMask = IMask(cpfInput, {
            mask: '000.000.000-00'
        });

        // Função para validar CPF
        function validateCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

            let sum = 0;
            let remainder;

            for (let i = 1; i <= 9; i++) {
                sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
            }

            remainder = (sum * 10) % 11;
            if (remainder === 10 || remainder === 11) remainder = 0;
            if (remainder !== parseInt(cpf.substring(9, 10))) return false;

            sum = 0;
            for (let i = 1; i <= 10; i++) {
                sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
            }

            remainder = (sum * 10) % 11;
            if (remainder === 10 || remainder === 11) remainder = 0;
            if (remainder !== parseInt(cpf.substring(10, 11))) return false;

            return true;
        }

        // Adicionar evento de validação ao campo de CPF
        cpfInput.addEventListener('blur', () => {
            if (!validateCPF(cpfInput.value)) {
                document.getElementById('cpfError').classList.remove('hidden');
            } else {
                document.getElementById('cpfError').classList.add('hidden');
            }
        });
    </script>
</body>

</html>
