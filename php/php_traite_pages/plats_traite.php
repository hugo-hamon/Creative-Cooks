<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $card_id = !empty($_POST['card_id']) ? $_POST['card_id'] : NULL;
    $is_redirect = false;
    
    if ($card_id == 1 or $card_id == 2 or $card_id == 4){
        if(!empty($_SESSION['user_id'])){
            $is_redirect = true;
        }
    }

    if ($card_id == 3){
        header('Location: ../php_pages/community_plats.php');
    } elseif ($card_id == 1 or $card_id == 2 or $card_id == 4){
        if ($is_redirect){
            if ($card_id == 1){
                header('Location: ../php_pages/create_plat.php');
            } elseif ($card_id == 2){
                header('Location: ../php_pages/my_plats.php');
            } elseif ($card_id == 4){
                header('Location: ../php_pages/favorit_plats.php');
            }
        } else{
            $_SESSION['login_statue'] = "Veuilez d'abord vous connecter";
            header('Location: ../php_pages/login.php');
        }
    }
    
?>