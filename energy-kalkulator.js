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
        const tabelle = $('#berechnung-tabelle');
        tabelle.empty(); // Tabelle leeren

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
                </tr>
            `;

            tabelle.append(row);
        });
    }

    // Beim Laden der Seite und bei Änderungen der Eingaben wird die Tabelle berechnet
    $(document).ready(function() {
        berechneWerte();
        $('#jahresproduktion_pv, #energieverbrauch, #technologie').on('input', berechneWerte);
    });
});
