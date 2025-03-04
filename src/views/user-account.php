<?php

// echo '<pre>';
// print_r($data);
// echo '</pre>';

// echo $_SESSION['user']['address'];
// global $data;
// var_dump($data['cardContent']);
global $accountCards; 
// echo "accountCards:";
// var_dump($accountCards);
global $accountContentCards;
// echo "accountContentCards:";
// var_dump($accountContentCards);
// echo "SESSION['user']:";
// var_dump($_SESSION['user']);

ob_start(); ?>

        <div class="user-account">
            <h2><img src="assets/img/icones/user.svg" alt="icone d'utilisateur"><span><?= "Bienvenue " . $_SESSION['user']['firstname'] . " !" ?> </span></h2>
            <div class="container userCards">
                <div class="cards row gx-3 gy-3">
                    <?php
                        foreach($accountCards as $key => $details) {
                            render('components/account_card', true, [
                                'name' => $key,
                                'src' => $details['src'],
                                'alt' => $details['alt'],
                                'title' => $details['title']
                            ]);
                        }
                    ?>
                </div>
            </div>

            <div class="container userContent">
                <?php
                    foreach($accountContentCards as $key => $modal) {
                        render('components/account_contentCard', true, [
                            'name' => $key,
                            'title' => $modal['title'],
                            'fields' => $modal['fields']
                        ]);
                    }
                ?>





            </div>
        </div>       

<?php 

$content = ob_get_clean();
$defaultDescription = $_SESSION['defaultDescription'];
$description = "Gérez vos informations personnelles et vos adresses de livraison, suivez l'état de vos commandes et accédez à votre liste de produits favoris.";



render('layout', true, [
    'description' => $description,
    'title' => "Le Grenier du Joueur - Mon compte utilisateur",
    'css' => ['/lib/bootstrap/css/bootstrap.min.css', '/assets/css/styles.css', 'assets/css/user-account.css'],
    'content' => $content,
    'js' => ['/lib/bootstrap/js/bootstrap.bundle.min.js', '/assets/js/main.js', '/assets/js/user-account.js']
]);

?>