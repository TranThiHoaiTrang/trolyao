<?php
$logData = $_POST['logData'];

// var_dump($logData);
$logFilePath = 'messages.php';

$fp = fopen($logFilePath, 'a');
if ($fp) {
    fwrite($fp, "<div class='msgln'>".stripslashes(htmlspecialchars($logData))."</div>");

    $handle = fopen("messages.php", "r");
    $contents = fread($handle, filesize("messages.php"));
    fclose($handle);

    echo $contents;

    http_response_code(200);
} else {
    http_response_code(500);
}
