<!-- 

Made by Schwizer Design GmbH
Say hello @ schwizerdesign.ch
Version 2.0

-->

<!DOCTYPE html>
<html lang="de">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# place: http://ogp.me/ns/place#">

    <meta charset="UTF-8">
    <title>Senmarck Schweiz | Locher Energie | Energy Kalkulator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="......n.">
    <meta name="keywords" content="........">
    <meta name="author" content="Senmarck Schweiz">
    <link rel="canonical" href="https://senmarck.ch/energy-kalkulator" />

    <meta name="robots" content="index, follow" /> 
    <meta http-equiv="cache-control" content="public, max-age=3600" />
    <meta http-equiv="pragma" content="cache" />

    <link rel="icon" type="image/svg+xml" href="/img/favicon.svg">
    <link rel="icon" type="image/png" href="/img/favicon.png">

    <meta property="og:title" content="Senmarck Schweiz | Energy Kalkulator">
    <meta property="og:description" content="...">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://senmarck.ch/energy-kalkulator">
    <meta property="og:image" content="https://senmarck.ch/img/og-image.jpg">
    <meta property="og:locale" content="de_CH">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Senmarck Schweiz | Energy Kalkulator">
    <meta name="twitter:description" content=".......">
    <meta name="twitter:image" content="https://senmarck.ch/img/twitter-image.jpg">

    <meta name="format-detection" content="telephone=yes">
    <meta property="business:contact_data:street_address" content="Viscosestrasse 46">
    <meta property="business:contact_data:locality" content="Widnau"> 
    <meta property="business:contact_data:region" content="9443">
    <meta property="business:contact_data:postal_code" content="9443">
    <meta property="business:contact_data:country_name" content="Switzerland">
    
    <link rel="stylesheet" href="main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <?php require_once 'nav.php'; ?>
    
    <header class="ek">
        <div class="login-container" id="login-container">
            <h2>Login</h2>
            <input type="text" id="username" placeholder="Benutzername">
            <input type="password" id="password" placeholder="Passwort">
            <button id="login-button">Anmelden</button>
            <p id="login-error" style="color:red; display:none;">Falscher Benutzername oder falsches Passwort.</p>
        </div>

        <div class="container" id="content-container">
            <h1>Energiespeicher Kalkulator</h1>

            <!-- Eingabefelder -->
            <div>
                <label>Leistung der PV in kWp (3-50):</label>
                <input type="number" id="leistung_pv" min="3" max="50" value="10">
            </div>

            <div>
                <label>Jahresproduktion der PV-Anlage in kWh:</label>
                <input type="number" id="jahresproduktion_pv" value="14250">
            </div>

            <div>
                <label>Aktueller Strompreis in CHF/kWh:</label>
                <input type="number" id="strompreis" step="0.01" value="0.35">
            </div>

            <div>
                <label>Einspeiseverguetung in CHF/kWh:</label>
                <input type="number" id="einspeiseverguetung" step="0.01" value="0.12">
            </div>

            <div>
                <label>Energieverbrauch EFH im Jahr in kWh:</label>
                <input type="number" id="energieverbrauch" value="4000">
            </div>

            <div>
                <label>Technologie:</label>
                <select id="technologie">
                    <option value="waermepumpe">Wärmepumpe</option>
                    <option value="oel">Öl</option>
                    <option value="gas">Gas</option>
                    <option value="pelets">Pellets</option>
                    <option value="andere">Andere</option>
                </select>
            </div>

            <div>
                <label>Boiler:</label>
                <select id="boiler">
                    <option value="ja">Ja</option>
                    <option value="nein">Nein</option>
                </select>
            </div>

            <!-- Tabelle für die Monatsberechnung -->
            <h2>PV-Produktion und Energieverbrauch pro Monat und Tag</h2>
            <table>
                <thead>
                    <tr>
                        <th>Monat</th>
                        <th>Jahresproduktion (kWh)</th>
                        <th>Faktor Produktion</th>
                        <th>Produktion pro Monat (kWh)</th>
                        <th>Jahresverbrauch (kWh)</th>
                        <th>Verbrauch pro Monat (kWh)</th>
                        <th>Tage</th>
                        <th>Produktion pro Tag (kWh)</th>
                        <th>Verbrauch pro Tag (kWh)</th>
                        <th>Speichermoeglichkeit pro Tag (kWh)</th>
                        <th>SpT Batterie 10</th>
                        <th>SpT Batterie 15</th>
                        <th>SpT Batterie 20</th>
                        <th>Ersparnis 10 (CHF) pro Monat</th>
                        <th>Ersparnis 15 (CHF) pro Monat</th>
                        <th>Ersparnis 20 (CHF) pro Monat</th>
                    </tr>
                </thead>
                <tbody id="berechnung-tabelle">
                    <!-- Hier werden die Monatsdaten dynamisch eingefügt -->
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="13">Jährliche Ersparnis</td>
                        <td><input type="number" id="total-ersparnis-10" readonly></td>
                        <td><input type="number" id="total-ersparnis-15" readonly></td>
                        <td><input type="number" id="total-ersparnis-20" readonly></td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="13">Amortisation in Jahren</td>
                        <td><input type="number" id="amortisation-10" readonly></td>
                        <td><input type="number" id="amortisation-15" readonly></td>
                        <td><input type="number" id="amortisation-20" readonly></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </header>

    <?php require_once 'script.php'; ?>
    <script src="energy-kalkulator.js"></script>
    <?php require_once 'googleanalytics.php'; ?>
</body>
</html>
