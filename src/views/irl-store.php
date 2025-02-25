<?php ob_start(); ?>

        <div class="irl-store">
            <h2><img src="assets/img/icones/meeple.svg" alt="icone d'un pion 'meeple' de jeu de société">
                Rendez-nous visite !</h2>
            <div class="container-user">
                <div class="cards row gx-3 gy-3">
                    <div class="col-6 col-md-3 col-lg-3">
                        <a href="product-card.html" class="card h-100">
                            <div class="card-image">
                                <img src="assets/img/irl-store/irl-details.webp"
                                    alt="image symbolisant les informations pratiques d'une boutique physique"
                                    class="card-img-top" />
                            </div>
                            <div class="card-body">
                                <p class="card-title">Informations pratiques</p>
                                <!-- <p class="card-text">Description du jeu</p> -->
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3 col-lg-3">
                        <a href="product-card.html" class="card h-100">
                            <div class="card-image">
                                <img src="assets/img/irl-store/irl-address.png"
                                    alt="image symbolisant l'adresse du magasin" class="card-img-top" />
                            </div>
                            <div class="card-body">
                                <p class="card-title">Nous rendre visite</p>
                                <!-- <p class="card-text">Description du jeu</p> -->
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3 col-lg-3">
                        <a href="product-card.html" class="card h-100">
                            <div class="card-image">
                                <img src="assets/img/irl-store/irl-events.webp"
                                    alt="image symbolisant les évènements de la boutique" class="card-img-top" />
                            </div>
                            <div class="card-body">
                                <p class="card-title">Nos évènements</p>
                                <!-- <p class="card-text">Description du jeu</p> -->
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3 col-lg-3">
                        <a href="product-card.html" class="card h-100">
                            <div class="card-image">
                                <img src="assets/img/irl-store/irl-contact.webp"
                                    alt="image symbolisant le contact de la boutique" class="card-img-top" />
                            </div>
                            <div class="card-body">
                                <p class="card-title">Nous contacter</p>
                                <!-- <p class="card-text">Description du jeu</p> -->
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>      

<?php 

$content = ob_get_clean();
$defaultDescription = $_SESSION['defaultDescription'];
$description = "Découvrez notre boutique physique, ouverte du lundi au vendredi de 10h a 19h, et inscrivez-vous à nos évènements ludiques.";

render('layout', true, [
    'description' => $description,
    'title' => "Le Grenier du Joueur - La boutique IRL",
    'css' => ['/lib/bootstrap/css/bootstrap.min.css', '/assets/css/styles.css', 'assets/css/irl-store.css'],
    'content' => $content,
    'js' => ['/lib/bootstrap/js/bootstrap.bundle.min.js', '/assets/js/main.js']
]);

?>