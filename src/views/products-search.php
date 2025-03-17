<?php ob_start(); ?>

        <div class="container-filter">
            <div class="filters row gx-1 gy-3">
                <h2 class="">Affiner ma recherche</h2>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="category" id="category">
                        <option value="" selected><label for="category">Catégorie : </label></option>
                        <option value="enfant">Pour enfants</option>
                        <option value="carte">Jeux de carte</option>
                        <option value="des">Jeux de dés</option>
                        <option value="classique">Jeux classiques</option>
                        <option value="reflexion">Jeux de réflexion</option>
                        <option value="role">Jeux de rôle</option>
                        <option value="strategie">Jeux de stratégie</option>
                        <option value="ambiance">Jeux d'ambiance</option>
                        <option value="accessoires">Accessoires de jeu</option>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="theme" id="theme">
                        <option value="" selected><label for="theme">Thème : </label></option>
                        <option value="abstrait">Abstrait</option>
                        <option value="animaux-nature">Animaux/Nature</option>
                        <option value="asie">Asie</option>
                        <option value="creatures-monstres">Créatures/Monstres</option>
                        <option value="fantastique">Fantastique</option>
                        <option value="medieval">Médiéval</option>
                        <option value="science-fiction">Science-Fiction</option>
                        <option value="sorcellerie">Sorcellerie</option>
                        <hr>
                        <optgroup label="Licences">
                            <option value="harry-potter">Harry Potter</option>
                            <option value="star-wars">Star Wars</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="difficulty" id="difficulty">
                        <option value="" selected><label for="difficulty">Difficulté : </label></option>
                        <option value="enfant">Enfant</option>
                        <option value="famille">Familial</option>
                        <option value="connaisseur">Connaisseur</option>
                        <option value="expert">Expert</option>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="players" id="players">
                        <option value="" selected><label for="players">Joueurs : </label></option>
                        <option value="solo">Solo</option>
                        <option value="duo">Duo</option>
                        <option value="1+">1+</option>
                        <option value="2+">2+</option>
                        <option value="3+">3+</option>
                        <option value="max4">max. 4</option>
                        <option value="max6">max. 5-6</option>
                        <option value="max7-8">max. 7-8</option>
                        <option value="max8+">max. > 8</option>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="age" id="age">
                        <option value="" selected><label for="age">Âge conseillé : </label></option>
                        <option value="5-7">5-7 ans +</option>
                        <option value="8-9">8-9 ans +</option>
                        <option value="10">10 ans +</option>
                        <option value="12">12 ans +</option>
                        <option value="14">14 ans +</option>
                        <option value="18">18 ans +</option>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="playtime" id="playtime">
                        <option value="" selected><label for="playtime">Durée : </label></option>
                        <option value="15">15 minutes</option>
                        <option value="30">30 minutes</option>
                        <option value="45">45 minutes</option>
                        <option value="60">1 heure</option>
                        <option value="90">1 heure 30</option>
                        <option value="120">2 heures et plus</option>
                    </select>
                </div>
                <div class="price col-12 col-md-8 col-lg-6">
                    <label for="price-max">Prix maximal : <span id="value"></span></label>
                    <input type="range" id="price-max" value="50" min="0" max="150" step="10">
                </div>
                <div class="submit-button col-12 col-md-4 col-lg-12">
                    <label for="submit-filters"></label>
                    <button type="submit" id="submit-filters">Filtrer</button>
                </div>
            </div>
        </div>

        <div class="products">
            <div class="container-products">
                <div class="cards row gx-3 gy-5">
                    <?php
                    foreach($products as $product) {
                        render('components/gameCard', true, [
                            'thumbnail' => $product['pathThumbnail'],
                            'fullImage' => $product['pathP1'],
                            'title' => $product['title']
                        ]);
                    }
                    ?>
                </div>

                    
            </div>
        </div>

        <!-- <div class="categories">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center fs-5 fw-bold">Pour enfants</div>
                        <div class="card-body d-flex flex-column">
                            <img src="assets/img/categories/Cat_enfants2.png" alt="image de catégorie jeux pour enfants" class="card-img-top">
                            <p class="card-text">Des jeux ludiques et éducatifs pour éveiller l'imagination des plus jeunes tout en s'amusant.</p>
                            <a href="#" class="btn mt-auto">Explorer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

<?php 

$content = ob_get_clean();
$description = "Parcourez notre catalogue de jeux de société, trouvez rapidement les produits idéals pour toute occasion grâce à nos filtres de recherche avancée.";

render('layout', true, [
    'description' => $description,
    'title' => "Le Grenier du Joueur - Parcourez nos produits",
    'css' => ['/lib/bootstrap/css/bootstrap.min.css', '/assets/css/styles.css', 'assets/css/products-search.css'],
    'content' => $content,
    'js' => ['/lib/bootstrap/js/bootstrap.bundle.min.js', '/assets/js/main.js', '/assets/js/product-search.js']
]);

?>