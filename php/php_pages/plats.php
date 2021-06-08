<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../functions/nav_bar.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/plats.css">
    <title>Creative cooks</title>
</head>

<body>
    <!-- Nav Bar!-->
    <?php show_nav_bar() ?>

    <!-- Carte pour créer un plat !-->
    <div id="card-container">
        <div class="card card-1">
            <div class="card-logo card-1-logo"></div>
            <div class="title">Créer un plat</div>
            <div class="sub-title">Créer un plat à partir d'aliments et d'ingrédients en toute liberté.</div>
            <form action="../php_traite_pages/plats_traite.php" method="post">
                <input type="hidden" name="card_id" value="1">
                <input type="submit" class="card-button card-1-button" value="Créer un plat">
            </form>
        </div>
        <div class="card card-2">
            <div class="card-logo card-2-logo"></div>
            <div class="title">Vos plats</div>
            <div class="sub-title">Retrouver ici vos plats créés avec la possibilité de les mettre en ligne.</div>
            <form action="../php_traite_pages/plats_traite.php" method="post">
                <input type="hidden" name="card_id" value="2">
                <input type="submit" class="card-button card-2-button" value="Voir vos plats">
            </form>
        </div>
        <div class="card card-3">
            <div class="card-logo card-3-logo"></div>
            <div class="title">Plats de la communauté</div>
            <div class="sub-title">Besoin d'un plat ? Vous trouverez ce dont vous avez besoins ici.</div>
            <form action="../php_traite_pages/plats_traite.php" method="post">
                <input type="hidden" name="card_id" value="3">
                <input type="submit" class="card-button card-3-button" value="Chercher des plats">
            </form>
        </div>
        <div class="card card-4">
            <div class="card-logo card-4-logo"></div>
            <div class="title">Favoris</div>
            <div class="sub-title">Vous avez mis des plats en favoris ? C'est ici que vous les trouverez.</div>
            <form action="../php_traite_pages/plats_traite.php" method="post">
                <input type="hidden" name="card_id" value="4">
                <input type="submit" class="card-button card-4-button" value="Voir vos favoris">
            </form>
        </div>
    </div>

</body>

</html>