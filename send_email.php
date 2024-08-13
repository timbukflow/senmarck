<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firma = sanitizeInput($_POST['firma']);
    $vorname = sanitizeInput($_POST['vorname']);
    $nachname = sanitizeInput($_POST['nachname']);
    $telefonnummer = sanitizeInput($_POST['telefonnummer']);
    $email = sanitizeInput($_POST['email']);
    $adresse = sanitizeInput($_POST['adresse']);
    $hausnummer = sanitizeInput($_POST['hausnummer']);
    $plz = sanitizeInput($_POST['plz']);
    $ort = sanitizeInput($_POST['ort']);

    $leistung_pv = sanitizeInput($_POST['leistung_pv']);
    $jahresproduktion_pv = sanitizeInput($_POST['jahresproduktion_pv']);
    $strompreis = sanitizeInput($_POST['strompreis']);
    $einspeiseverguetung = sanitizeInput($_POST['einspeiseverguetung']);
    $energieverbrauch = sanitizeInput($_POST['energieverbrauch']);
    $technologie = sanitizeInput($_POST['technologie']);
    $boiler = sanitizeInput($_POST['boiler']);
    $foerdergelder = sanitizeInput($_POST['foerdergelder']);

     // Berechnungsergebnisse
     $totalErsparnis10 = sanitizeInput($_POST['totalErsparnis10']);
     $totalErsparnis15 = sanitizeInput($_POST['totalErsparnis15']);
     $totalErsparnis20 = sanitizeInput($_POST['totalErsparnis20']);
 
     $amortisation10 = sanitizeInput($_POST['amortisation10']);
     $amortisation15 = sanitizeInput($_POST['amortisation15']);
     $amortisation20 = sanitizeInput($_POST['amortisation20']);
 
     $gewinn20_10 = sanitizeInput($_POST['gewinn20_10']);
     $gewinn20_15 = sanitizeInput($_POST['gewinn20_15']);
     $gewinn20_20 = sanitizeInput($_POST['gewinn20_20']);
 
     $table_data = $_POST['table_data'];
 
     // Email-Nachricht
     $message_body = "<h1>Anfrage zur Kalkulation</h1>";
     $message_body .= "<p><strong>Firma:</strong> $firma<br>";
     $message_body .= "<strong>Vorname:</strong> $vorname<br>";
     $message_body .= "<strong>Nachname:</strong> $nachname<br>";
     $message_body .= "<strong>Telefonnummer:</strong> $telefonnummer<br>";
     $message_body .= "<strong>Email:</strong> $email<br>";
     $message_body .= "<strong>Adresse:</strong> $adresse $hausnummer<br>";
     $message_body .= "<strong>PLZ:</strong> $plz<br>";
     $message_body .= "<strong>Ort:</strong> $ort</p>";
 
     $message_body .= "<h2>Leistungsdaten</h2>";
     $message_body .= "<p><strong>Leistung der PV in kWp:</strong> $leistung_pv<br>";
     $message_body .= "<strong>Jahresproduktion der PV-Anlage in kWh:</strong> $jahresproduktion_pv<br>";
     $message_body .= "<strong>Aktueller Strompreis in €/kWh:</strong> $strompreis<br>";
     $message_body .= "<strong>Einspeiseverguetung in €/kWh:</strong> $einspeiseverguetung<br>";
     $message_body .= "<strong>Energieverbrauch EFH/MFH im Jahr in kWh:</strong> $energieverbrauch<br>";
     $message_body .= "<strong>Technologie:</strong> $technologie<br>";
     $message_body .= "<strong>Boiler:</strong> $boiler<br>";
     $message_body .= "<strong>Erhaltene Fördergelder:</strong> $foerdergelder CHF</p>";
 
     $message_body .= "<h2>Kalkulationsergebnisse</h2>";
     $message_body .= "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
     $message_body .= "<tr><th></th><th>Batterie 10 kWh</th><th>Batterie 15 kWh</th><th>Batterie 20 kWh</th></tr>";
     $message_body .= "<tr><td>Jährliche Ersparnis (CHF)</td><td>$totalErsparnis10</td><td>$totalErsparnis15</td><td>$totalErsparnis20</td></tr>";
     $message_body .= "<tr><td>Amortisation (Jahre)</td><td>$amortisation10</td><td>$amortisation15</td><td>$amortisation20</td></tr>";
     $message_body .= "<tr><td>Gewinn über 20 Jahre (CHF)</td><td>$gewinn20_10</td><td>$gewinn20_15</td><td>$gewinn20_20</td></tr>";
     $message_body .= "</table>";
 
     $message_body .= "<h2>Detailierte Tabelle</h2>";
     $message_body .= $table_data; // Hier wird die HTML-Tabelle eingefügt
 
     $headers = "From: sales@senmarck.ch\r\n";
     $headers .= "Content-Type: text/html; charset=utf-8\r\n";
 
     $to = "ivoschwizer@gmail.com";
     $subject = "Energiespeicher Kalkulation";
 
     if (mail($to, $subject, $message_body, $headers)) {
         echo "Ihre Anfrage wurde erfolgreich gesendet.";
     } else {
         echo "Es gab ein Problem beim Versenden Ihrer Anfrage.";
     }
 }
 
 function sanitizeInput($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
 }
?>