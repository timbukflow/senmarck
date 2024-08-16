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

    // Formatierte Tabelle für die Benutzerdaten
    $message_body .= "<h2>Benutzerdaten</h2>";
    $message_body .= "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
    $message_body .= "<tr><td><strong>Firma:</strong></td><td>$firma</td></tr>";
    $message_body .= "<tr><td><strong>Vorname:</strong></td><td>$vorname</td></tr>";
    $message_body .= "<tr><td><strong>Nachname:</strong></td><td>$nachname</td></tr>";
    $message_body .= "<tr><td><strong>Telefonnummer:</strong></td><td>$telefonnummer</td></tr>";
    $message_body .= "<tr><td><strong>Email:</strong></td><td>$email</td></tr>";
    $message_body .= "<tr><td><strong>Adresse:</strong></td><td>$adresse $hausnummer</td></tr>";
    $message_body .= "<tr><td><strong>PLZ:</strong></td><td>$plz</td></tr>";
    $message_body .= "<tr><td><strong>Ort:</strong></td><td>$ort</td></tr>";
    $message_body .= "</table>";

    // Formatierte Tabelle für die Leistungsdaten
    $message_body .= "<h2>Leistungsdaten</h2>";
    $message_body .= "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
    $message_body .= "<tr><td><strong>Leistung der PV in kWp:</strong></td><td>$leistung_pv</td></tr>";
    $message_body .= "<tr><td><strong>Jahresproduktion der PV-Anlage in kWh:</strong></td><td>$jahresproduktion_pv</td></tr>";
    $message_body .= "<tr><td><strong>Aktueller Strompreis in CHF/kWh:</strong></td><td>$strompreis</td></tr>";
    $message_body .= "<tr><td><strong>Einspeiseverguetung in CHF/kWh:</strong></td><td>$einspeiseverguetung</td></tr>";
    $message_body .= "<tr><td><strong>Energieverbrauch EFH im Jahr in kWh:</strong></td><td>$energieverbrauch</td></tr>";
    $message_body .= "<tr><td><strong>Heiztechnologie:</strong></td><td>$technologie</td></tr>";
    $message_body .= "<tr><td><strong>Boiler elektrisch beheizbar:</strong></td><td>$boiler</td></tr>";
    $message_body .= "<tr><td><strong>Erhaltene Fördergelder:</strong></td><td>$foerdergelder CHF</td></tr>";
    $message_body .= "</table>";

    // Formatierte Tabelle für die Kalkulationsergebnisse
    $message_body .= "<h2>Kalkulationsergebnisse</h2>";
    $message_body .= "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
    $message_body .= "<tr><th></th><th>Batterie 10 kW</th><th>Batterie 15 kW</th><th>Batterie 20 kW</th></tr>";
    $message_body .= "<tr><td>Jährliche Ersparnis (CHF)</td><td>$totalErsparnis10</td><td>$totalErsparnis15</td><td>$totalErsparnis20</td></tr>";
    $message_body .= "<tr><td>Amortisation (Jahre)</td><td>$amortisation10</td><td>$amortisation15</td><td>$amortisation20</td></tr>";
    $message_body .= "<tr><td>Gewinn über 20 Jahre (CHF)</td><td>$gewinn20_10</td><td>$gewinn20_15</td><td>$gewinn20_20</td></tr>";
    $message_body .= "</table>";

    // Detaillierte Werte-Tabelle
    $message_body .= "<h2>Detaillierte Werte-Tabelle</h2>";
    $message_body .= "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
    $message_body .= $table_data;
    $message_body .= "</table>";
 
    $headers = "From: sales@senmarck.ch\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
 
    $to = "sales@senmarck.ch";
    $subject = "Energiespeicher Kalkulation";
 
     if (mail($to, $subject, $message_body, $headers)) {
        //  echo "Ihre Anfrage wurde erfolgreich gesendet.";
     } else {
        //  echo "Es gab ein Problem beim Versenden Ihrer Anfrage.";
     }
 }
 
 function sanitizeInput($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
 }
?>