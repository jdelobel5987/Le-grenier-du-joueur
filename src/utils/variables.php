<?php 

// session_start();

$_SESSION['defaultDescription'] = "Bienvenue sur le Grenier du Joueur, votre nouvelle expérience achat de jeu de société en ligne. Découvrez nos nouveautés, parcourez vos catégories favorites et recherchez des produits spécifiques.";

$accountCards = [
    "details" => [
        'title' => "Mes informations",
        'src' => 'assets/img/user-account/account-details.webp',
        'alt' => "image symbolisant les informations personnelles de l'utilisateur"
    ],
    "addresses" => [
        'title' => "Mes addresses",
        'src' => 'assets/img/user-account/account-addresses.webp',
        'alt' => "image symbolisant les adresses de l'utilisateur"
    ],
    "orders" => [
        'title' => "Mes commandes",
        'src' => 'assets/img/user-account/account-orders.webp',
        'alt' => "image symbolisant les commandes de l'utilisateur"
    ],
    "wishlist" => [
        'title' => "Ma liste d'envies",
        'src' => 'assets/img/user-account/account-wish-list.png',
        'alt' => "image symbolisant la liste d'envies de l'utilisateur"
    ]
];

?>