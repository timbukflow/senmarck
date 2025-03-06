<?php
session_start();
$user_code = $_POST['code'];

if (isset($_SESSION['email_code']) && $_SESSION['email_code'] == $user_code) {
    echo "valid"; // Bestätigung erfolgreich
    unset($_SESSION['email_code']); // Code nach Bestätigung löschen
} else {
    echo "invalid"; // Falscher Code
}
?>