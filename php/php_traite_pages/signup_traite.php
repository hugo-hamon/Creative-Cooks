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
    $user_input_username = !empty($_POST['username']) ? $_POST['username'] : NULL;
    $user_input_password = !empty($_POST['password']) ? $_POST['password'] : NULL;

    // Gestion des erreurs
    $statue = ["", "", "", ""];

    //Test si l'adresse mail n'est pas déja utilisé et si elle est valide
    $email_query = mysqli_query($bdd_conn, "SELECT id FROM utilisateurs WHERE email = '$user_input_email'");

    if (!filter_var($user_input_email, FILTER_VALIDATE_EMAIL)){
        if (strlen($user_input_email) == 0){
            $statue[0] = "Champ vide";
        } else {
            $statue[0] = "email invalide";
        }
        
    }else if($email_query){
        if (mysqli_num_rows($email_query) >= 1){
            $statue[0] = "Email déja pris";
        }
    }

    //Test si le mot de passe est valide
    if (strlen($user_input_password) < 4){
        if (strlen($user_input_password) == 0){
            $statue[1] = "Champ vide";
        } else {
            $statue[1] = "Mot de passe trop court";
        }
    }

    //Test si le pseudo est déja pris
    $username_query = mysqli_query($bdd_conn, "SELECT id FROM utilisateurs WHERE pseudo = '$user_input_username'");
    
    if($username_query){
        if (mysqli_num_rows($username_query) >= 1){
            $statue[2] = "Pseudo déja pris";
        }
    }

    if (strlen($user_input_username) < 2){
        if (strlen($user_input_username) == 0){
            $statue[2] = "Champ vide";
        } else {
            $statue[2] = "Pseudo trop court";
        }
    }

    //Création d'un nouvelle utilisateur ou redirection ver signup 
    if ($statue[0] == "" and $statue[1] == "" and $statue[2] == ""){
        $pwd_hache = password_hash($user_input_password, PASSWORD_DEFAULT);
        $user_query = "INSERT INTO utilisateurs (`pseudo`, `mdp`, `email`, `reset_mdp`, `date_inscription`) VALUES ('$user_input_username', '$pwd_hache', '$user_input_email', '', CURDATE())";
        mysqli_query($bdd_conn, $user_query);
        $statue[3] = "Compte créé avec succès";
        $_SESSION['signup_statue'] = $statue;
        header('Location: ../php_pages/signup.php');
    } else {
        $_SESSION['signup_statue'] = $statue;
        header('Location: ../php_pages/signup.php');
    }
    mysqli_close($bdd_conn);
?>