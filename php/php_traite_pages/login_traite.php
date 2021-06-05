<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include '../php_pages/bdd.php';

    //Connection à la base de donnée
    $bdd_conn = mysqli_connect($serveur, $login, $mdp);
    mysqli_select_db($bdd_conn, $bdd_name);

    // Si une erreur apparait lors de la connexion à la base de données on l'affiche
    if (!$bdd_conn) {
        die('Erreur: '.mysqli_connect_error());
    }

    //Récuperation des données du formulaire
    $user_input_email = !empty($_POST['mail']) ? $_POST['mail'] : NULL;
    $user_input_password = !empty($_POST['password']) ? $_POST['password'] : NULL;
    $statue = "";

    $user_info_query = mysqli_query($bdd_conn, "SELECT id, mdp, pseudo FROM utilisateurs WHERE email = '$user_input_email'");
    if ($user_info_query) {
        $etu = mysqli_fetch_array($user_info_query);
        if (!empty($etu['id'])) {
            $is_pwd_correct = password_verify($user_input_password, $etu['mdp']);
            if ($is_pwd_correct) {
                $_SESSION['user_id'] = $etu['id'];
                $_SESSION['pseudo'] = $etu['pseudo'];
            } else {
                $statue = "Erreur de saisie";
            }
        } else {
            $statue = "Erreur de saisie";
        }
    }
    if ($statue == "") {
        header('Location: ../php_pages/menus.php');
    } else {
        $_SESSION['login_statue'] = $statue;
        header('Location: ../php_pages/login.php');
    }
    mysqli_close($bdd_conn);
?>