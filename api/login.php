<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../agendamento/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post" class="login-form">
            <div class="input-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="cpf" placeholder="Digite seu CPF" required>
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit">Entrar</button><br>
            <a href="../agendamento/cadastro.php">Faça seu Cadastro!</a>
        </form>

        <?php
        session_start();
        include('../agendamento/conexao.php');
       
        // ... (código de conexão e verificação de conexão com o banco de dados)

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['cpf']) && isset($_POST['senha'])) {
                $cpf = $_POST['cpf'];
                $senha = $_POST['senha'];

                // Verificando as credenciais no banco de dados
                $verificar_usuario = "SELECT * FROM cadastro WHERE cpf='$cpf'";
                $result_usuario = $conn->query($verificar_usuario);

                if ($result_usuario->num_rows == 1) {
                    $row = $result_usuario->fetch_assoc();
                    if (password_verify($senha, $row['senha'])) {
                        // Autenticação bem-sucedida
                        $_SESSION['usuario_id'] = $row['id']; // Salvar o ID do usuário na sessão

                        // Redirecionar para o painel de agendamentos
                        header("Location: painel.php");
                        exit();
                    } else {
                        echo '<p style="color: red;">SENHA INCORRETA!</p>';
                    }
                } else {
                    echo '<p style="color: red;">CPF NÃO ENCONTRADO!</p>';
                }
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>