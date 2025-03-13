<?php

if ($_SESSION['user']['id_roles'] !== 1) {
    render('user-account', false, [
        'error' => "Vous n'avez pas les droits requis pour accèder au panneau d'administration."
    ]);
} else {
    require 'models/users.php';
    // require 'models/products.php'; // à créer

    $users = getAllUsers();
    // $products = getAllProducts(); // à créer
    render('adminBoard', false, [
        'users' => $users
    ]);
}

?>