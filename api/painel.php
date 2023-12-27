<?php 
session_start();
include('../agendamento/conexao.php');

// Verifica se o usuário está autenticado
// Se não estiver, redireciona para a página de login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

// Consulta para recuperar todos os agendamentos
$consulta_agendamentos = "SELECT * FROM agendamentos ORDER BY data";
$resultado = $conn->query($consulta_agendamentos);

// Verifica se a consulta foi bem-sucedida
if ($resultado === false) {
    die("Erro na consulta ao banco de dados: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <link rel="stylesheet" href="../agendamento/tabela.css"> <!-- Lembre-se de adicionar seu próprio arquivo CSS -->
</head>
<body>
    <div class="painel-container">
        <h2>Agendamentos</h2>

        <?php 
        include('../agendamento/conexao.php');
        if ($resultado->num_rows > 0): ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <!-- ... outras colunas, se houver ... -->
                </tr>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['servico']; ?></td>
                        <td><?php echo $row['data']; ?></td>
                        <td><?php echo $row['horario']; ?></td>
                        <!-- ... outras colunas, se houver ... -->
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Não há agendamentos.</p>
        <?php endif; ?>
        
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
