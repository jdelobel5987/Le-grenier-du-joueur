<?php 

// assign the user details
$accountContentCards = [
    "details" => [
        'title' => "Mes informations personnelles",
        'fields' => [
            'Prénom' => $_SESSION['user']['firstname'],
            'Nom' => $_SESSION['user']['lastname'],
            'E-mail' => $_SESSION['user']['email'],
            'Mot de passe' => "••••••••••",
            'Téléphone' => $_SESSION['user']['phone'],
            'Communication' => $_SESSION['user']['communication'],
            'Newsletter' => $_SESSION['user']['newsletter'],
        ]
    ],
    "addresses" => [
        'title' => "Mes adresses",
        'fields' => [
            'Adresse' => $_SESSION['user']['address'],
            'Complément' => $_SESSION['user']['complement'],
            'Code postal' => $_SESSION['user']['zipcode'],
            'Ville' => $_SESSION['user']['city'],
        ]
    ],
    "orders" => [
        'title' => "Mes commandes",
        'fields' => [
            'référence' => "",
            'date' => "",
            'montant' => "",
            'détails' => ""
        ]
    ],
    "wishlist" => [
        'title' => "Ma liste d'envies",
        'fields' => [
            'jeux' => ""
        ]
    ]
];

render('user-account', false, [
    'cardContent' => $accountContentCards
]);

?>