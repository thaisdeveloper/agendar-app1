<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agendamento</title>
    <link rel="stylesheet" href="../agendamento/form.css">
</head>
<body>
    <div class="agendamento-container">
        <h2>Agendamento</h2>
        <form action="painel.php" method="post">
            <div class="input-group">
            <div class="input-group">
                <label for="name">Cliente:</label>
                <input type="text" id="name" name="name" placeholder="Nome Cliente" required>
            </div>
                <label for="servico">Selecione o serviço:</label>
                <select id="servico" name="servico" required>
                    <option value="Serviço A">Serviço A</option>
                    <option value="Serviço B">Serviço B</option>
                    <option value="Serviço C">Serviço C</option>
                    <!-- Adicione mais opções conforme necessário -->
                </select>
            </div>
           
            <div class="input-group">
                <label for="data">Selecione a data:</label>
                <input type="date" id="data" name="data" required>
            </div>
            <div class="input-group">
                <label for="horario">Selecione o horário:</label>
                <input type="time" id="horario" name="horario" required>
            </div>
            <button type="submit">Agendar</button><br>
            <a href="login.php">Administrador</a>
        </form>
    </div>
    <?php
session_start();
include('../agendamento/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['servico'], $_POST['data'], $_POST['horario'])) {
        $servico = $_POST['servico'];
        $data = $_POST['data'];
        $horario = $_POST['horario'];
        $name = $_POST['name'];

        // Verifica se o horário está disponível
        $verificar_disponibilidade = "SELECT * FROM agendamentos WHERE data='$data' AND horario='$horario'";
        $result_disponibilidade = $conn->query($verificar_disponibilidade);

        if ($result_disponibilidade->num_rows > 0) {
            // Horário já está reservado
            echo '<p style="color: red;">Este horário já está reservado. Por favor, escolha outro.</p>';
        } else {
            // Horário está disponível, pode prosseguir com o agendamento

            // AQUI VOCÊ INSERE OS DADOS NO BANCO DE DADOS
             $inserir_agendamento = "INSERT INTO agendamentos (servico, data, horario,name) VALUES ('$servico', '$data', '$horario','$name')";
             $conn->query($inserir_agendamento);
            
            // Aqui você pode redirecionar o usuário para uma página de confirmação de agendamento ou realizar outra ação necessária
            // header("Location: confirmacao.php");
            // exit();
        }
    }
}

$conn->close();
?>
</body>
</html>
