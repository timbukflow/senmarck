<?php
session_start();
$email = $_POST['email'];

// Zufälligen 4-stelligen Code generieren
$code = rand(1000, 9999);
$_SESSION['email_code'] = $code;

// E-Mail senden
$subject = "Ihr Bestätigungscode für den Energiekalkulator";
$message = "
<html>
<head>
    <title>Bestätigungscode</title>
</head>
<body>
    <h2>Ihr Bestätigungscode:</h2>
    <p><strong>$code</strong></p>
    <p>Bitte geben Sie diesen Code auf der Webseite ein, um fortzufahren.</p>
</body>
</html>";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
$headers .= "From: noreply@senmarck.ch" . "\r\n"; 

if (mail($email, $subject, $message, $headers)) {
    echo "Code gesendet";
} else {
    echo "Fehler beim Senden des Codes";
}
?>