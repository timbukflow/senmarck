$(document).ready(function() {
    // Handhabung von Dokument-Links
    $('.doc-link').on('click', function(e) {
        e.preventDefault();
        var docUrl = $(this).attr('href');
        $('#popup-iframe').attr('src', docUrl);
        $('#popup').css('display', 'flex');
    });

    // Schließen des Popups
    $('.close-btn').on('click', function() {
        $('#popup').css('display', 'none');
        $('#popup-iframe').attr('src', '');
    });

    // Akkordeon-Logik
    $(".accordion").click(function() {
        $(this).toggleClass("active");
        var panel = $(this).next(".panel");
        if (panel.css("max-height") === "0px") {
            panel.css("max-height", panel.prop("scrollHeight") + "px");
        } else {
            panel.css("max-height", "0px");
        }
    });
});
