<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include '../functions/nav_bar.php';
    $reset_password_statue =  !empty($_SESSION['reset_password_statue']) ? $_SESSION['reset_password_statue'] : ["", ""];
    $reset_statue_number = 0;
    if ($reset_password_statue[1] != "") {
        if ($reset_password_statue[1] == "Bon token"){
            $reset_statue_number = 2;
        } else {
            $reset_statue_number = 1;
        } 
    }
    unset($_SESSION['reset_password_statue']);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/reset_password.css">
    <title>Creative cooks</title>
</head>

<body>
    <!-- Nav Bar!-->
    <?php show_nav_bar() ?>

    <!-- Login Form!-->
    <div class="reset-password-div">
        <div class="reset-password-logo"></div>
        <div class="title">Creative Cooks</div>
        <div class="sub-title">BETA</div>
        <form action="../php_traite_pages/reset_password_traite.php" method="post">
            <div class="fields">
                <?php
                    if ($reset_statue_number == 0 or $reset_password_statue[1] == "Bon token" and $reset_password_statue[0] != "") {
                        echo "<div class='reset-password-statue-bad'>$reset_password_statue[0]</div>";
                    } else {
                        echo "<div class='reset-password-statue-fine'>$reset_password_statue[1]</div>";
                    }
                ?>
                <div class="mail"><svg class="svg-icon" viewBox="0 0 20 20">
                        <path d="M17.388,4.751H2.613c-0.213,0-0.389,0.175-0.389,0.389v9.72c0,0.216,0.175,0.389,0.389,0.389h14.775c0.214,0,0.389-0.173,0.389-0.389v-9.72C17.776,4.926,17.602,4.751,17.388,4.751 M16.448,5.53L10,11.984L3.552,5.53H16.448zM3.002,6.081l3.921,3.925l-3.921,3.925V6.081z M3.56,14.471l3.914-3.916l2.253,2.253c0.153,0.153,0.395,0.153,0.548,0l2.253-2.253l3.913,3.916H3.56z M16.999,13.931l-3.921-3.925l3.921-3.925V13.931z"></path>
                    </svg><input type="text" class="user-input" placeholder='<?php echo ($reset_statue_number == 0) ? "Adresse mail" : (($reset_statue_number == 1) ? "Token" : "Nouveau mot de passe"); ?>' name='<?php echo ($reset_statue_number == 0) ? "mail" : (($reset_statue_number == 1) ? "token" : "password"); ?>' /></div>
            </div>
            <input type="submit" class="reset-password-button" value="Envoyer">
        </form>
    </div>
</body>

</html>