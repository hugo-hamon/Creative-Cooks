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
    <link rel="stylesheet" type="text/css" href="../../css/create_plat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css">
    <title>Creative cooks</title>
</head>

<body>
    <!-- Nav Bar!-->
    <?php show_nav_bar() ?>

    <!-- Aliments !-->
    <h1 id="page-title">Aliments</h1>
    <hr class="separator">

    <div class="add-aliment-container">
        <ul id="myUL">
            <li>Hit the gym</li>
        </ul>
        <div id="add-aliment-div">
            <span onclick="newElement()" class="add-aliment-button"><i class="fas fa-plus"></i></span>
        </div>
    </div>

</body>

</html>