<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div class="cadastro-container">
        <h2>Cadastro</h2>
        <form action="cadastro.php" method="post" class="cadastro-form">
            <div class="input-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
            </div>
            <div class="input-group">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" id="sobrenome" name="sobrenome" placeholder="Digite seu sobrenome" required>
            </div>
            <div class="input-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
    <?php  
    include('../agendamento/conexao.php');
    // Recuperando os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$cpf = $_POST['cpf'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografando a senha

// Verificando se o CPF já está cadastrado
$verifica_cpf = "SELECT * FROM cadastro WHERE cpf='$cpf'";
$result_cpf = $conn->query($verifica_cpf);

if ($result_cpf->num_rows > 0) {
    echo "Este CPF já está cadastrado!";
} else {
    // Inserindo os dados na tabela de usuários
    $inserir_usuario = "INSERT INTO cadastro (nome, sobrenome, cpf, senha) VALUES ('$nome', '$sobrenome', '$cpf', '$senha')";
    if ($conn->query($inserir_usuario) === TRUE) {
        echo'<p style="color: red; text-align: center;">', "Cadastro realizado com sucesso!";
    } else {
        echo '<p style="color: red; text-align: center;">',"Erro ao cadastrar: " . $conn->error;
    }
}
header("Location: login.php"); // Redireciona para a página de login
exit(); // Encerra o script após o redirecionamento

$conn->close();
?>
</body>
</html>
