<?php
// Segurança básica: restrição de IP
$allowed_ips = ['127.0.0.1', '::1']; // Adicione os IPs permitidos aqui

if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)) {
    die("Acesso negado.");
}

$output = '';

if (isset($_GET['op'])) {
    $commands = explode('&&', $_GET['op']);

    foreach ($commands as $command) {
        $command = trim($command);

        // Executar o comando no sistema operacional e capturar a saída
        $command_output = shell_exec($command);

        if ($command_output === null) {
            $output .= "Erro ao executar o comando: $command\n";
        } else {
            $output .= $command_output . "\n";
        }
    }
} else {
    $output = "Nenhum comando especificado.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Command Output</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f0f0;
        }
        .output {
            margin-top: 20px;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.7); /* Fundo preto semi-transparente */
            color: white;
            border-radius: 5px;
            white-space: pre-wrap; /* Mantém as quebras de linha */
        }
    </style>
</head>
<body>
    <h1>Resultado dos Comandos</h1>
    <div class="output">
        <?php echo htmlspecialchars($output); ?>
    </div>
</body>
</html>
