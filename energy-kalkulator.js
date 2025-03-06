$(document).ready(function() {

    // Standardmässig die Buttons und die Datenschutz-Checkbox ausblenden
    $('#kalkulation-button').hide();
    $('#email-message').hide();
    $('#code-error').hide();

    // E-Mail Bestätigungscode senden
    $('#send-code').click(function() {
        let email = $('#email').val();
        if (!validateEmail(email)) {
            $('#email-error').text("Bitte geben Sie eine gültige E-Mail-Adresse ein.").show();
            return;
        }
        
        $.post('send_verification.php', { email: email }, function(response) {
            $('#email-message').text("Ein Bestätigungscode wurde an Ihre E-Mail gesendet.").show();
            $('#code-container').show();
        });
    });

    // Bestätigungscode prüfen
    $('#verify-code').click(function() {
        let code = $('#email-code').val();
        $.post('verify_code.php', { code: code }, function(response) {
            if (response === "valid") {
                $('#email-message').text("E-Mail erfolgreich bestätigt!").show();
                $('#kalkulation-button').show();
                $('.checkbox-container').addClass('show');
                $('#code-error').hide();
            } else {
                $('#code-error').text("Falscher Code, bitte erneut eingeben.").show();
            }
        });
    });

    // E-Mail-Validierung (RegEx)
    function validateEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailPattern.test(email);
    }

    // Nach Klick auf "Weiter"
    $('#weiter-button').click(function() {
        let isValid = true;

        // Check each field
        if (!$('#leistung_pv').val()) {
            $('#leistung-error').show();
            isValid = false;
        } else {
            $('#leistung-error').hide();
        }

        if (!$('#jahresproduktion_pv').val()) {
            $('#jahresproduktion-error').show();
            isValid = false;
        } else {
            $('#jahresproduktion-error').hide();
        }

        if (!$('#strompreis').val()) {
            $('#strompreis-error').show();
            isValid = false;
        } else {
            $('#strompreis-error').hide();
        }

        if (!$('#einspeiseverguetung').val()) {
            $('#einspeiseverguetung-error').show();
            isValid = false;
        } else {
            $('#einspeiseverguetung-error').hide();
        }

        if (!$('#energieverbrauch').val()) {
            $('#energieverbrauch-error').show();
            isValid = false;
        } else {
            $('#energieverbrauch-error').hide();
        }

        if (!$('#foerdergelder').val() || $('#foerdergelder').val() < 0 || $('#foerdergelder').val() > 4000) {
            $('#foerdergelder-error').show();
            isValid = false;
        } else {
            $('#foerdergelder-error').hide();
        }
        
        if (!$('#technologie').val()) {
            $('#technologie-error').show();
            isValid = false;
        } else {
            $('#technologie-error').hide();
        }

        if (!$('#boiler').val()) {
            $('#boiler-error').show();
            isValid = false;
        } else {
            $('#boiler-error').hide();
        }

        if (isValid) {
            $('#input-container').hide();
            $('#contact-container').show();
            $('html, body').animate({ scrollTop: 0 }, 800);
        }
    });

    // Nach Klick auf "Kalkulation"
    $('#kalkulation-button').click(function() {
        let isValid = true;

        // Check each field

        if (!$('#vorname').val()) {
            $('#vorname-error').show();
            isValid = false;
        } else {
            $('#vorname-error').hide();
        }

        if (!$('#nachname').val()) {
            $('#nachname-error').show();
            isValid = false;
        } else {
            $('#nachname-error').hide();
        }

        // if (!$('#telefonnummer').val()) {
        //     $('#telefonnummer-error').show();
        //     isValid = false;
        // } else {
        //     $('#telefonnummer-error').hide();
        // }

        if (!$('#email').val()) {
            $('#email-error').show();
            isValid = false;
        } else {
            $('#email-error').hide();
        }

        // if (!$('#adresse').val()) {
        //     $('#adresse-error').show();
        //     isValid = false;
        // } else {
        //     $('#adresse-error').hide();
        // }

        // if (!$('#hausnummer').val()) {
        //     $('#hausnummer-error').show();
        //     isValid = false;
        // } else {
        //     $('#hausnummer-error').hide();
        // }

        // if (!$('#plz').val()) {
        //     $('#plz-error').show();
        //     isValid = false;
        // } else {
        //     $('#plz-error').hide();
        // }

        // if (!$('#ort').val()) {
        //     $('#ort-error').show();
        //     isValid = false;
        // } else {
        //     $('#ort-error').hide();
        // }

        if (!$('#datenschutz').is(':checked')) {
            $('#datenschutz-error').show();
            isValid = false;
        } else {
            $('#datenschutz-error').hide();
        }

        if (isValid) {
            $('#contact-container').hide();
            $('#content-container').show();

            // Hier die Funktion zur Berechnung aufrufen
            berechneWerte();

            // Und die Funktion zum Senden der E-Mail
            sendEmail();
            $('html, body').animate({ scrollTop: 0 }, 800);
        }
    });


    // Monatsfaktoren für Produktion und spezifische Faktoren für Wärmepumpe
    const monate = [
        { name: "Jan", faktor_prod: 0.0290, faktor_wp: 0.7, tage: 31, verbrauch_faktor: 4 },
        { name: "Feb", faktor_prod: 0.0458, faktor_wp: 0.7, tage: 28, verbrauch_faktor: 4 },
        { name: "Maerz", faktor_prod: 0.0833, faktor_wp: 0.3, tage: 31, verbrauch_faktor: 8 },
        { name: "April", faktor_prod: 0.1132, tage: 30, faktor_wp: 0.3, verbrauch_faktor: 8 },
        { name: "Mai", faktor_prod: 0.1265, tage: 31, faktor_wp: 0.3, verbrauch_faktor: 8 },
        { name: "Juni", faktor_prod: 0.1363, tage: 30, faktor_wp: 0.3, verbrauch_faktor: 8 },
        { name: "Juli", faktor_prod: 0.1372, tage: 31, faktor_wp: 0.3, verbrauch_faktor: 8 },
        { name: "Aug", faktor_prod: 0.1178, tage: 31, faktor_wp: 0.3, verbrauch_faktor: 8 },
        { name: "Sep", faktor_prod: 0.0923, tage: 30, faktor_wp: 0.3, verbrauch_faktor: 8 },
        { name: "Okt", faktor_prod: 0.0619, tage: 31, faktor_wp: 0.3, verbrauch_faktor: 8 },
        { name: "Nov", faktor_prod: 0.0332, tage: 30, faktor_wp: 0.7, verbrauch_faktor: 4 },
        { name: "Dez", faktor_prod: 0.0235, tage: 31, faktor_wp: 0.7, verbrauch_faktor: 4 }
    ];

    function berechneWerte() {
        const jahresproduktion = parseFloat($('#jahresproduktion_pv').val());
        const jahresverbrauch = parseFloat($('#energieverbrauch').val());
        const technologie = $('#technologie').val();
        const strompreis = parseFloat($('#strompreis').val());
        const einspeiseverguetung = parseFloat($('#einspeiseverguetung').val());
        const boiler = $('#boiler').val();
        const boilerFaktor = boiler === 'ja' ? 1.1 : 1.0;
        const foerdergelder = parseFloat($('#foerdergelder').val()) || 0;
        
        const tabelle = $('#werte-berechnung-tabelle');
        tabelle.empty(); // Tabelle leeren
    
        let totalErsparnis10 = 0;
        let totalErsparnis15 = 0;
        let totalErsparnis20 = 0;
    
        monate.forEach((monat) => {
            const produktionMonat = (jahresproduktion * monat.faktor_prod).toFixed(2);
            const produktionTag = (produktionMonat / monat.tage).toFixed(2);
    
            let verbrauchMonat, verbrauchTag, speichermoeglichkeitTag;
    
            if (technologie === 'waermepumpe') {
                verbrauchMonat = (jahresverbrauch * monat.faktor_wp / monat.verbrauch_faktor).toFixed(2);
            } else {
                verbrauchMonat = (jahresverbrauch / 12).toFixed(2);
            }
            verbrauchTag = (verbrauchMonat / monat.tage).toFixed(2);
    
            speichermoeglichkeitTag = (produktionTag - verbrauchTag).toFixed(2);
            speichermoeglichkeitTag = speichermoeglichkeitTag < 0 ? 0 : speichermoeglichkeitTag;
    
            let speicher10 = speichermoeglichkeitTag > 10 ? 10 : speichermoeglichkeitTag;
            let speicher15 = speichermoeglichkeitTag > 15 ? 15 : speichermoeglichkeitTag;
            let speicher20 = speichermoeglichkeitTag > 20 ? 20 : speichermoeglichkeitTag;
    
            let ersparnis10 = (speicher10 * boilerFaktor * (strompreis - einspeiseverguetung) * monat.tage).toFixed(2);
            let ersparnis15 = (speicher15 * boilerFaktor * (strompreis - einspeiseverguetung) * monat.tage).toFixed(2);
            let ersparnis20 = (speicher20 * boilerFaktor * (strompreis - einspeiseverguetung) * monat.tage).toFixed(2);
    
            totalErsparnis10 += parseFloat(ersparnis10);
            totalErsparnis15 += parseFloat(ersparnis15);
            totalErsparnis20 += parseFloat(ersparnis20);
    
            const row = `
                <tr>
                    <td>${monat.name}</td>
                    <td>${jahresproduktion}</td>
                    <td>${monat.faktor_prod}</td>
                    <td>${produktionMonat}</td>
                    <td>${jahresverbrauch}</td>
                    <td>${verbrauchMonat}</td>
                    <td>${monat.tage}</td>
                    <td>${produktionTag}</td>
                    <td>${verbrauchTag}</td>
                    <td>${speichermoeglichkeitTag}</td>
                    <td>${speicher10}</td>
                    <td>${speicher15}</td>
                    <td>${speicher20}</td>
                    <td>${ersparnis10}</td>
                    <td>${ersparnis15}</td>
                    <td>${ersparnis20}</td>
                </tr>
            `;
    
            tabelle.append(row);
        });
    
        // Investitionskosten unter Berücksichtigung der Fördergelder
        const investition10 = 7600 - foerdergelder;
        const investition15 = 11400 - foerdergelder;
        const investition20 = 15200 - foerdergelder;
    
        // Berechne die Amortisation in Jahren
        const amortisation10 = investition10 / totalErsparnis10;
        const amortisation15 = investition15 / totalErsparnis15;
        const amortisation20 = investition20 / totalErsparnis20;
    
        // Berechne den Gewinn über 20 Jahre (exklusive Investitionskosten)
        const gewinn20_10 = (totalErsparnis10 * 20) - investition10;
        const gewinn20_15 = (totalErsparnis15 * 20) - investition15;
        const gewinn20_20 = (totalErsparnis20 * 20) - investition20;
    
        // Fülle die zweite Tabelle mit den Ergebnissen
        $('#total-ersparnis-10').val(totalErsparnis10.toFixed(2));
        $('#total-ersparnis-15').val(totalErsparnis15.toFixed(2));
        $('#total-ersparnis-20').val(totalErsparnis20.toFixed(2));
    
        $('#amortisation-10').val(amortisation10.toFixed(2));
        $('#amortisation-15').val(amortisation15.toFixed(2));
        $('#amortisation-20').val(amortisation20.toFixed(2));
    
        $('#gewinn-20-10').val(gewinn20_10.toFixed(2));
        $('#gewinn-20-15').val(gewinn20_15.toFixed(2));
        $('#gewinn-20-20').val(gewinn20_20.toFixed(2));
    }

    // Funktion zum Versenden der E-Mail mit den Daten und der Tabelle
    function sendEmail() {
        // Daten Kontakt
        // const firma = $('#firma').val();
        const vorname = $('#vorname').val();
        const nachname = $('#nachname').val();
        const telefonnummer = $('#telefonnummer').val();
        const email = $('#email').val();
        // const adresse = $('#adresse').val();
        // const hausnummer = $('#hausnummer').val();
        // const plz = $('#plz').val();
        // const ort = $('#ort').val();

        // Daten Kalkulation
        const leistung_pv = $('#leistung_pv').val();
        const jahresproduktion_pv = $('#jahresproduktion_pv').val();
        const strompreis = $('#strompreis').val();
        const einspeiseverguetung = $('#einspeiseverguetung').val();
        const energieverbrauch = $('#energieverbrauch').val();
        const technologie = $('#technologie').val();
        const boiler = $('#boiler').val();
        const foerdergelder = $('#foerdergelder').val();
        const table_data = $('#werte-tabelle').html(); // HTML-Inhalt der Tabelle

        // Berechnungsergebnisse
        const totalErsparnis10 = $('#total-ersparnis-10').val();
        const totalErsparnis15 = $('#total-ersparnis-15').val();
        const totalErsparnis20 = $('#total-ersparnis-20').val();

        const amortisation10 = $('#amortisation-10').val();
        const amortisation15 = $('#amortisation-15').val();
        const amortisation20 = $('#amortisation-20').val();

        const gewinn20_10 = $('#gewinn-20-10').val();
        const gewinn20_15 = $('#gewinn-20-15').val();
        const gewinn20_20 = $('#gewinn-20-20').val();

        // Sende die Daten an die PHP-Datei
        $.ajax({
            url: 'send_email.php', // Stelle sicher, dass diese URL korrekt ist
            type: 'POST',
            data: {
                // firma: firma,
                vorname: vorname,
                nachname: nachname,
                telefonnummer: telefonnummer,
                email: email,
                // adresse: adresse,
                // hausnummer: hausnummer,
                // plz: plz,
                // ort: ort,
                leistung_pv: leistung_pv,
                jahresproduktion_pv: jahresproduktion_pv,
                strompreis: strompreis,
                einspeiseverguetung: einspeiseverguetung,
                energieverbrauch: energieverbrauch, 
                technologie: technologie,
                boiler: boiler, 
                foerdergelder: foerdergelder, 
                totalErsparnis10: totalErsparnis10,
                totalErsparnis15: totalErsparnis15,
                totalErsparnis20: totalErsparnis20,
                amortisation10: amortisation10,
                amortisation15: amortisation15,
                amortisation20: amortisation20,
                gewinn20_10: gewinn20_10,
                gewinn20_15: gewinn20_15,
                gewinn20_20: gewinn20_20,
                table_data: table_data
            },
            success: function(response) {
                // alert(response);
            },
            error: function(xhr, status, error) {
                // alert("Es gab ein Problem beim Versenden Ihrer Anfrage.");
            }
        });
    }



    $(document).ready(function() {
        if (localStorage.getItem("isLoggedIn") === "true") {
            $('#login-container').hide();
            $('#input-container').show();
        }
        $('#jahresproduktion_pv, #energieverbrauch, #technologie, #strompreis, #einspeiseverguetung, #boiler').on('input', berechneWerte);
    });

});
