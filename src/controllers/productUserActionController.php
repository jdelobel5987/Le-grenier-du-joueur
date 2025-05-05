<?php

if($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST['id_games']) && !empty($_POST['action'])) {
    require 'utils/session.php';
    $allowedActions = ['toWishlist', 'toCart', 'removeFromWishlist', 'removeFromCart'];

    if(!in_array($_POST['action'], $allowedActions)) {
        // echo "action non valable";
        header('Location: index');
        exit();
    }

    if(!isLogged()) {
        // $_SESSION['error_message'] = "Vous devez vous connecter pour utiliser la liste de souhaits ou le panier";
        header('Location: connection');
        exit();
    }

    // echo "test ajout wishlist ou panier";     
        
    require_once 'models/productUserAction.php';
    
    $gameId = (int) htmlspecialchars($_POST['id_games']);
    // $userId = htmlspecialchars($_SESSION['user']['id_users']);

    switch($_POST['action']) {
        case 'toWishlist':
            $table = 'wishlist';
            addProductTo($table, $gameId);
            break;
        case 'toCart':
            $table = 'cart';
            addProductTo($table, $gameId);
            break;
        default:                    
    }
    
    header('Location: products-search');


}