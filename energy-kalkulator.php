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

    <meta name="description" content="Der Senmarck Energiekalkulator für Einfamilienhäuser – berechnen Sie das optimale Energiespeichersystem basierend auf Ihren individuellen Daten. Ermitteln Sie Ihre jährliche Ersparnis, Amortisationszeit und den langfristigen Gewinn. Einfache und schnelle Berechnung für die wirtschaftlichste Lösung.">
    <meta name="keywords" content="Energiekalkulator, Senmarck, Energiespeichersystem, Einfamilienhaus, Energieeinsparung berechnen, Amortisationszeit, Langfristiger Gewinn, Wirtschaftliche Energiespeicherung, Optimale Energiespeichergröße, Effiziente Energieverwaltung, Stromkosten senken, Umweltfreundliche Energiespeicherung">
    <meta name="author" content="Senmarck Schweiz">
    <link rel="canonical" href="https://senmarck.ch/energy-kalkulator" />

    <meta name="robots" content="index, follow" /> 
    <meta http-equiv="cache-control" content="public, max-age=3600" />
    <meta http-equiv="pragma" content="cache" />

    <link rel="icon" type="image/svg+xml" href="/img/favicon.svg">
    <link rel="icon" type="image/png" href="/img/favicon.png">

    <meta property="og:title" content="Senmarck Schweiz | Energy Kalkulator">
    <meta property="og:description" content="Der Senmarck Energiekalkulator für Einfamilienhäuser – berechnen Sie das optimale Energiespeichersystem basierend auf Ihren individuellen Daten. Ermitteln Sie Ihre jährliche Ersparnis, Amortisationszeit und den langfristigen Gewinn. Einfache und schnelle Berechnung für die wirtschaftlichste Lösung.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://senmarck.ch/energy-kalkulator">
    <meta property="og:image" content="https://senmarck.ch/img/og-image.jpg">
    <meta property="og:locale" content="de_CH">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Senmarck Schweiz | Energy Kalkulator">
    <meta name="twitter:description" content="Der Senmarck Energiekalkulator für Einfamilienhäuser – berechnen Sie das optimale Energiespeichersystem basierend auf Ihren individuellen Daten. Ermitteln Sie Ihre jährliche Ersparnis, Amortisationszeit und den langfristigen Gewinn. Einfache und schnelle Berechnung für die wirtschaftlichste Lösung.">
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

    <nav>
        <div id="nav" class="nav">
            <div class="homebutton">
                <a href="index">
                    <img src="img/senmarck-energie-logo.svg" alt="Senmarck Energiespeichersystem Logo" width="250px" height="auto">
                </a>
            </div>
            <div class="navcontainer nav-mobil-kalk">
                <div class="navcontainer-mobile"> 
                    <a href="index" class="start button-link">Startseite</a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="ek-container grid">
        <!-- Energiedaten Formular -->
        <div class="input-container" id="input-container">
            <h1>Energie-Kalkulator für EFH </h1>
            <h2>Mit den folgenden Eingaben können wir das  <strong>optimale und wirtschaft&shy;lichste</strong> Energiespeichersystem für Sie berechnen.</h2>
            <div class="es-grid-container">
                <div class="es-grid">
                    <div>
                        <label for="leistung_pv">Leistung der PV in kWp</label>
                        <input type="number" id="leistung_pv" placeholder="3 - 50 kWp" value="">
                        <p id="leistung-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>

                    <div>
                        <label for="jahresproduktion_pv">Jahresproduktion der PV-Anlage in kWh</label>
                        <input type="number" id="jahresproduktion_pv" placeholder="ca. 8000" value="">
                        <p id="jahresproduktion-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>

                    <div>
                        <label for="strompreis">Aktueller Strompreis in CHF/kWh</label>
                        <input type="number" id="strompreis" step="0.01" placeholder="ca. 0.35" value="">
                        <p id="strompreis-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>

                    <div>
                        <label for="einspeiseverguetung">Einspeiseverguetung in CHF/kWh</label>
                        <input type="number" id="einspeiseverguetung" step="0.01" placeholder="ca. 0.12" value="">
                        <p id="einspeiseverguetung-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>
                </div>
                <div class="es-grid">
                    <div>
                        <label for="energieverbrauch">Energieverbrauch EFH im Jahr in kWh</label>
                        <input type="number" id="energieverbrauch" placeholder="ca. 4000" value="">
                        <p id="energieverbrauch-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>

                    <div>
                        <label for="foerdergelder">Fördergelder für Energiespeicher in CHF</label>
                        <input type="number" id="foerdergelder" placeholder="0 - 4000" value="">
                        <p id="foerdergelder-error" class="error">Bitte geben Sie einen Wert zwischen 0 und 4000 CHF ein.</p>
                    </div>

                    <div>
                        <label for="technologie">Welche Heiztechnologie nutzen Sie?</label>
                        <div class="custom-select-wrapper">
                            <select class="custom-select" id="technologie">
                                <option value="">Bitte auswählen</option>
                                <option value="waermepumpe">Wärmepumpe</option>
                                <option value="oel">Öl</option>
                                <option value="gas">Gas</option>
                                <option value="pelets">Pellets</option>
                                <option value="andere">Andere</option>
                            </select>
                        </div>
                        <p id="technologie-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>

                    <div>
                        <label for="boiler">Ist Ihr Boiler elektrisch beheizbar?</label>
                        <div class="custom-select-wrapper">
                            <select class="custom-select"  id="boiler">
                                <option value="">Bitte auswählen</option>
                                <option value="ja">Ja</option>
                                <option value="nein">Nein</option>
                            </select>
                        </div>
                        <p id="boiler-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>
                </div>
            </div>
            <button id="weiter-button">Weiter</button>
        </div>

        <!-- Kontaktdaten Formular -->
        <div class="contact-container" id="contact-container">
            <h1>Eingabe Ihrer Kontaktdaten </h1>
            <h2>Nach Eingabe Ihrer Daten präsentieren wir Ihnen <strong>sofort die Ergebnisse.</strong></h2>
            <div class="es-grid-container">
                <div class="es-grid">
                    <!-- <div>
                        <label for="firma">Firma</label>
                        <input type="text" id="firma" placeholder="Firma" value="">
                    </div> -->
                    <div>
                        <label for="vorname">Vorname&ast;</label>
                        <input type="text" id="vorname" placeholder="Vorname" value="">
                        <p id="vorname-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>

                    <div>
                        <label for="nachname">Nachname&ast;</label>
                        <input type="text" id="nachname" placeholder="Nachname" value="">
                        <p id="nachname-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>
                </div>
                <div class="es-grid">
                    <div>
                        <label for="telefonnummer">Telefonnummer (optional)</label>
                        <input type="tel" id="telefonnummer" placeholder="+41 071 200 00 00" value="">
                    </div>

                    <div>
                        <label for="email">Email&ast;</label>
                        <input type="email" id="email" placeholder="Email" value="">
                        <p id="email-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>
                </div>
                <!-- <div class="es-grid">
                    <div>
                        <label for="adresse">Adresse</label>
                        <input type="text" id="adresse" placeholder="Adresse des EFH" value="">
                        <p id="adresse-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>

                    <div>
                        <label for="hausnummer">Hausnummer</label>
                        <input type="text" id="hausnummer" placeholder="Hausnummer des EFH" value="">
                        <p id="hausnummer-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>

                    <div>
                        <label for="plz">Postleitzahl</label>
                        <input type="text" id="plz" placeholder="Postleitzahl des EFH" value="">
                        <p id="plz-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>

                    <div>
                        <label for="ort">Ort</label>
                        <input type="text" id="ort" placeholder="Ort des EFH" value="">
                        <p id="ort-error" class="error">Dieses Feld ist erforderlich.</p>
                    </div>
                </div> -->
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="datenschutz">
                <label for="datenschutz">Ich bestätige die <a class="d-link" href="datenschutz">Datenschutzerklärung</a></label>
                <p id="datenschutz-error" class="error">Sie müssen die Datenschutzerklärung akzeptieren.</p>
            </div>

            <button id="kalkulation-button">Kalkulation</button>
        </div>
        
        <!-- Ergebnis -->
        <div id="content-container">
            <h1>Ergebnis des Energie-Kalkulators</h1>
            <h2>Auf Grundlage Ihrer Angaben berechnen wir die Gesamtergebnisse zu jährlicher Ersparnis, Amortisation und 20-jährigem Gewinn nach Abzug der Investitionskosten. Diese Auswertung unterstützt Sie dabei, die wirtschaftlich optimale Grösse Ihres Energiespeichersystems festzulegen.</h2>
            <div class="tableoutside" id="berechnungs-tabelle">
                <div class="tableinside">
                    <div><h2>Batterie 10 kW</h2></div>
                    <div><p>Jährliche Ersparnis (CHF)</p></div>
                    <div><input type="text" id="total-ersparnis-10" readonly></div>
                    <div><p>Amortisation (Jahre)</p></div>
                    <div><input type="text" id="amortisation-10" readonly></div>
                    <div><p>Gewinn über 20 Jahre (CHF)</p></div>
                    <div><input type="text" id="gewinn-20-10" readonly></div>
                </div>
                <div class="tableinside">
                    <div><h2>Batterie 15 kW</h2></div>
                    <div><p>Jährliche Ersparnis (CHF)</p></div>
                    <div><input type="text" id="total-ersparnis-15" readonly></div>
                    <div><p>Amortisation (Jahre)</p></div>
                    <div><input type="text" id="amortisation-15" readonly></div>
                    <div><p>Gewinn über 20 Jahre (CHF)</p></div>
                    <div><input type="text" id="gewinn-20-15" readonly></div>
                </div>
                <div class="tableinside">
                    <div><h2>Batterie 20 kW</h2></div>
                    <div><p>Jährliche Ersparnis (CHF)</p></div>
                    <div><input type="text" id="total-ersparnis-20" readonly></div>
                    <div><p>Amortisation (Jahre)</p></div>
                    <div><input type="text" id="amortisation-20" readonly></div>
                    <div><p>Gewinn über 20 Jahre (CHF)</p></div>
                    <div><input type="text" id="gewinn-20-20" readonly></div>
                </div>
            </div>
            <div class="contact-section">
                <h1>Offerte oder Beratung</h1>
                <h2>Für ein Angebot oder eine Beratung wenden Sie sich bitte an unsere Spezialisten:</h2>

                <div class="boxes-all fix">
                    <!-- Box-01 -->
                    <div class="boxes-container">
                        <div class="box-container-team">
                            <picture class="box-image-container-team">
                                <source srcset="img/senmarck-energiespeichersystem-team-luigi-cuomo.webp" type="image/webp">
                                <source srcset="img/senmarck-energiespeichersystem-team-luigi-cuomo.jpg" type="image/jpeg">
                                <img class="box-team-image" src="img/senmarck-energiespeichersystem-team-luigi-cuomo.jpg" loading="lazy" alt="Senmarck Energiespeichersystem Team Luigi Cuomo" width="auto" height="auto">
                            </picture>
                            <div class="box-team">
                                <h3>Luigi Cuomo <br> CEO</h3>
                                <p>
                                    <span id="luigi-tel-office"></span><br>
                                    <span id="luigi-tel-mobile"></span><br>
                                    <span id="luigi-email"></span>
                                </p>   
                                <a href="https://www.linkedin.com/in/luigi-cuomo-a0241a128/" target="_blank" class="box-team-icon"><img src="img/linkedin.svg" alt="linkedin"></a>
                            </div> 
                        </div>
                    </div>
                    <!-- Box-02 -->
                    <div class="boxes-container">
                        <div class="box-container-team">
                            <picture class="box-image-container-team">
                                <source srcset="img/senmarck-energiespeichersystem-team-walter-neff.webp" type="image/webp">
                                <source srcset="img/senmarck-energiespeichersystem-team-walter-neff.jpg" type="image/jpeg">
                                <img class="box-team-image" src="img/senmarck-energiespeichersystem-team-walter-neff.jpg" loading="lazy" alt="Senmarck Energiespeichersystem Team Walter Neff" width="auto" height="auto">
                            </picture>
                            <div class="box-team">
                                <h3>Walter Neff <br> CTO</h3>
                                <p>
                                    <span id="walter-tel-office"></span><br>
                                    <span id="walter-tel-mobile"></span><br>
                                    <span id="walter-email"></span>
                                </p>   
                                <a href="https://www.linkedin.com/in/walter-neff-21a5a6b0/" target="_blank" class="box-team-icon"><img src="img/linkedin.svg" alt="linkedin"></a>
                            </div> 
                        </div>
                    </div> 
                </div>

                <!-- Tabelle für die Werte -->
                <table id="werte-tabelle">
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
                    <tbody id="werte-berechnung-tabelle">
                        <!-- Hier werden die Monatsdaten dynamisch eingefügt -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Calendly Badge-Widget Beginn -->
    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
    <script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
    <script type="text/javascript">window.onload = function() { Calendly.initBadgeWidget({ url: 'https://calendly.com/senmarck-sales/beratungstermin?primary_color=3a5ba7', text: 'Beratungstermin buchen', color: '#3a5ba7', textColor: '#ffffff', branding: undefined }); }</script>
    <!-- Calendly Badge-Widget Ende -->

    <?php require_once 'footer.php'; ?>
    <?php require_once 'script.php'; ?>
    <script src="energy-kalkulator.js"></script>
    <?php require_once 'googleanalytics.php'; ?>
</body>
</html>
