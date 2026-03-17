<!--

Made by Schwizer Design GmbH
Say hello @ schwizerdesign.ch

-->

<?php http_response_code(404); ?>

<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">
    <title>Seite nicht gefunden | Senmarck Schweiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <link rel="icon" type="image/svg+xml" href="/img/favicon.svg">
    <link rel="icon" type="image/png" href="/img/favicon.png">

    <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css'); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>

    <?php require_once 'nav.php'; ?>

    <section class="grid error-page">
        <div class="error-content">
            <h1>404</h1>
            <p>Diese Seite wurde leider nicht gefunden.</p>
            <a href="/" class="bluebtn button-link">Zur Startseite</a>
        </div>
    </section>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'script.php'; ?>

</body>
</html>
