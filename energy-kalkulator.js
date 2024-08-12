$(document).ready(function() {
    const monate = [
        { name: "Jan", faktor_prod: 0.0290, faktor_wp: 0.7, tage: 31, verbrauch_faktor: 4 },
        { name: "Feb", faktor_prod: 0.0458, faktor_wp: 0.7, tage: 28, verbrauch_faktor: 4 },
        { name: "März", faktor_prod: 0.0833, faktor_wp: 0.3, tage: 31, verbrauch_faktor: 8 },
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
        const einspeiseverguetung = parseFloat($('#einspeisevergütung').val());
        const boiler = $('#boiler').val();
        const boilerFaktor = boiler === 'ja' ? 1.1 : 1.0;
        const tabelle = $('#berechnung-tabelle');
        tabelle.empty(); // Tabelle leeren

        let totalErsparnis10 = 0;
        let totalErsparnis15 = 0;
        let totalErsparnis20 = 0;

        monate.forEach((monat) => {
            const produktionMonat = (jahresproduktion * monat.faktor_prod).toFixed(2);
            const produktionTag = (produktionMonat / monat.tage).toFixed(2);

            let verbrauchMonat, verbrauchTag, speichermoeglichkeitTag;

            if (technologie === 'wärmepumpe') {
                // Wärmepumpe Berechnung
                verbrauchMonat = (jahresverbrauch * monat.faktor_wp / monat.verbrauch_faktor).toFixed(2);
            } else {
                // Andere Technologien
                verbrauchMonat = (jahresverbrauch / 12).toFixed(2);
            }
            verbrauchTag = (verbrauchMonat / monat.tage).toFixed(2);

            // Berechnung der Speichermöglichkeit pro Tag
            speichermoeglichkeitTag = (produktionTag - verbrauchTag).toFixed(2);

            // Wenn Speichermöglichkeit kleiner als 0 ist, auf 0 setzen
            speichermoeglichkeitTag = speichermoeglichkeitTag < 0 ? 0 : speichermoeglichkeitTag;

            // Anpassung an die Speichergrößen
            let speicher10 = speichermoeglichkeitTag > 10 ? 10 : speichermoeglichkeitTag;
            let speicher15 = speichermoeglichkeitTag > 15 ? 15 : speichermoeglichkeitTag;
            let speicher20 = speichermoeglichkeitTag > 20 ? 20 : speichermoeglichkeitTag;

            // Berechnung der Ersparnisse pro Speichergröße
            let ersparnis10 = (speicher10 * boilerFaktor * (strompreis - einspeiseverguetung) * monat.tage).toFixed(2);
            let ersparnis15 = (speicher15 * boilerFaktor * (strompreis - einspeiseverguetung) * monat.tage).toFixed(2);
            let ersparnis20 = (speicher20 * boilerFaktor * (strompreis - einspeiseverguetung) * monat.tage).toFixed(2);

            // Summiere die Ersparnisse für das Jahr
            totalErsparnis10 += parseFloat(ersparnis10);
            totalErsparnis15 += parseFloat(ersparnis15);
            totalErsparnis20 += parseFloat(ersparnis20);

            const row = `
                <tr>
                    <td>${monat.name}</td>
                    <td><input type="number" value="${jahresproduktion}" class="yellow-bg" readonly></td>
                    <td><input type="number" value="${monat.faktor_prod}" class="yellow-bg" readonly></td>
                    <td><input type="number" value="${produktionMonat}" readonly></td>
                    <td><input type="number" value="${jahresverbrauch}" class="yellow-bg" readonly></td>
                    <td><input type="number" value="${verbrauchMonat}" readonly></td>
                    <td><input type="number" value="${monat.tage}" class="yellow-bg" readonly></td>
                    <td><input type="number" value="${produktionTag}" readonly></td>
                    <td><input type="number" value="${verbrauchTag}" readonly></td>
                    <td><input type="number" value="${speichermoeglichkeitTag}" readonly></td>
                    <td><input type="number" value="${speicher10}" readonly></td>
                    <td><input type="number" value="${speicher15}" readonly></td>
                    <td><input type="number" value="${speicher20}" readonly></td>
                    <td><input type="number" value="${ersparnis10}" readonly></td>
                    <td><input type="number" value="${ersparnis15}" readonly></td>
                    <td><input type="number" value="${ersparnis20}" readonly></td>
                </tr>
            `;

            tabelle.append(row);
        });

        // Zeige die jährlichen Ersparnisse in der Totalzeile
        $('#total-ersparnis-10').val(totalErsparnis10.toFixed(2));
        $('#total-ersparnis-15').val(totalErsparnis15.toFixed(2));
        $('#total-ersparnis-20').val(totalErsparnis20.toFixed(2));

        // Berechne die Amortisation in Jahren
        const investition10 = 9000;
        const investition15 = 12000;
        const investition20 = 15000;

        const amortisation10 = investition10 / totalErsparnis10;
        const amortisation15 = investition15 / totalErsparnis15;
        const amortisation20 = investition20 / totalErsparnis20;

        // Zeige die Amortisation in der Totalzeile
        $('#amortisation-10').val(amortisation10.toFixed(2));
        $('#amortisation-15').val(amortisation15.toFixed(2));
        $('#amortisation-20').val(amortisation20.toFixed(2));
    }

    // Beim Laden der Seite und bei Änderungen der Eingaben wird die Tabelle berechnet
    $(document).ready(function() {
        berechneWerte();
        $('#jahresproduktion_pv, #energieverbrauch, #technologie, #strompreis, #einspeisevergütung, #boiler').on('input', berechneWerte);
    });
    
});
