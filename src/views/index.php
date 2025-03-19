<?php ob_start(); ?>

        <div class="container-carousel">
            <h2>Nouveautés</h2>
            <div class="carousel slide" id="myCarousel" data-bs-touch="true" data-bs-ride="carousel"
                data-bs-pause="hover">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./assets/img/nouveautés/Azul-duel.webp" alt="boîte du jeu Azul duel"
                            class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/Cryptic-nature.webp" alt="boîte du jeu Cryptic nature"
                            class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/Evergreen-ext-giant-trees-and-mushrooms.webp"
                            alt="boîte de l'extension de jeu Evergreen giant trees and mushrooms"
                            class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/Flow.webp" alt="boîte du jeu Flow" class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/Fromage.webp" alt="boîte du jeu Fromage"
                            class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/Refuge.webp" alt="boîte du jeu Refuge" class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/The-gang.webp" alt="boîte du jeu The gang"
                            class="d-block m-auto">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Précédent</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Suivant</span>
                </button>
                <br><br>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" aria-label="Slide 1"
                        aria-current="true" class="active bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="5" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="6" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                </div>
            </div>
        </div>

        <div class="categories">
            <h2>Catégories</h2>
            <div class="row">

                <?php

                require('models/products.php');
                $categories = getAllCategories();

                foreach($categories as $category) {
                    render('components/index_categoryCard', true, [
                        'catName' => $category['name'],
                        'catImage' => $category['image'],
                        'catText' => $category['text']
                    ]);  
                }

                ?>        
                        
            </div>
        </div>

<?php 

$content = ob_get_clean();

render('layout', true, [
    'description' => DEFAULT_DESCRIPTION,
    'title' => "Le Grenier du Joueur - Accueil",
    'css' => ['/lib/bootstrap/css/bootstrap.min.css', '/assets/css/styles.css'],
    'content' => $content,
    'js' => ['/lib/bootstrap/js/bootstrap.bundle.min.js', '/assets/js/main.js', '/assets/js/index_resize-carousel.js']
]);

?>