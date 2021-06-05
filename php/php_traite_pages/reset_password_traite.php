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
    if ($user_input_email != NULL){
        $_SESSION['reset_password_email'] = $user_input_email;
    }
    $user_input_token = !empty($_POST['token']) ? $_POST['token'] : NULL;
    $user_input_password = !empty($_POST['password']) ? $_POST['password'] : NULL;

    // Gestion des erreurs
    $statue = ["", ""];

    if ($user_input_email != NULL){
        //Test si l'adresse mail existe
        $email_query = mysqli_query($bdd_conn, "SELECT id FROM utilisateurs WHERE email = '$user_input_email'");
        
        if($email_query){
            if (mysqli_num_rows($email_query) == 1){
                $statue[1] = "Code envoyé";
            } else {
                $statue[0] = "Email invalide";
            }
        } else {
            $statue[0] = "Email invalide";
        }
    }
    
    // test si le token a été rentré
    if ($user_input_token != NULL){
        $token_query = mysqli_query($bdd_conn, "SELECT reset_mdp FROM utilisateurs WHERE reset_mdp = '$user_input_token'");
        if($token_query){
            if (mysqli_num_rows($token_query) == 1){
                $statue[1] = "Bon token";
            } else {
                $statue[0] = "Token invalide";
            }
        } else {
            $statue[0] = "Token invalide";
        }
    }

    // test si un mot de passe à été rentré
    if ($user_input_password != NULL){
        if (strlen($user_input_password) < 4){
            $statue[0] = "Mot de passe trop court";
            $statue[1] = "Bon token";
        } else {
            $mail = $_SESSION['reset_password_email'];
            unset($_SESSION['reset_password_email']);
            $pwd_hache = password_hash($user_input_password, PASSWORD_DEFAULT);
            $password_query = mysqli_query($bdd_conn, "UPDATE `utilisateurs` SET `mdp` = '$pwd_hache' WHERE `utilisateurs`.`email` = '$mail';");
            $statue[1] = "Mot de passe changé";
        }
    }

    //Création d'un token pour la récupération du mot de passe et envoie du mail
    if ($statue[0] == "" and $user_input_email != NULL){
        $random_string = bin2hex(random_bytes(5));
        $headers  = 'From: [your_gmail_account_username]@gmail.com' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-type: text/html; charset=utf-8';

        // Envoie du mail
        if (mail("$user_input_email", 'Changement de mot de passe', "Voici votre token pour changer votre mot de passe: ".$random_string, $headers)){
            // Mise à jour du token dans la base de donnée
            $reset_password_query = "UPDATE `utilisateurs` SET `reset_mdp` = '$random_string' WHERE `utilisateurs`.`email` = '$user_input_email';";
            mysqli_query($bdd_conn, $reset_password_query);
        } else {
            $statue[0] = "Erreur lors de l'envoie du mail";
            $statue[1] = "";
        }

        $_SESSION['reset_password_statue'] = $statue;
        header('Location: ../php_pages/reset_password.php');
    } else {
        $_SESSION['reset_password_statue'] = $statue;
        header('Location: ../php_pages/reset_password.php');
    }
    mysqli_close($bdd_conn);
?>