<?php
session_start();
include('../agendamento/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['servico'], $_POST['data'], $_POST['horario'])) {
        $servico = $_POST['servico'];
        $data = $_POST['data'];
        $horario = $_POST['horario'];

        // Verifica se o horário está disponível
        $verificar_disponibilidade = "SELECT * FROM agendamentos WHERE data='$data' AND horario='$horario'";
        $result_disponibilidade = $conn->query($verificar_disponibilidade);

        if ($result_disponibilidade->num_rows > 0) {
            // Horário já está reservado
            echo '<p style="color: red;">Este horário já está reservado. Por favor, escolha outro.</p>';
        } else {
            // Horário está disponível, insere o novo agendamento no banco de dados
            $inserir_agendamento = "INSERT INTO agendamentos (servico, data, horario) VALUES ('$servico', '$data', '$horario')";
            if ($conn->query($inserir_agendamento) === TRUE) {
                // Redireciona de volta para o formulário de agendamento após o agendamento bem-sucedido
                header("Location: index.php");
                exit();
            } else {
                echo '<p style="color: red;">Erro ao agendar. Por favor, tente novamente.</p>';
            }
        }
    }
}

$conn->close();
?>
