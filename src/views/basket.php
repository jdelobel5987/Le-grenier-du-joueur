<?php ob_start(); ?>

        <div class="container">
            <h2>Mon panier</h2>
            <div class="basket-container">
                <div class="basket-unit">
                    <input type="checkbox" id="product-1" checked><img src="assets/img/produits/bunny-kingdom.webp"
                        alt="boîte du jeu Bunny Kingdom">
                    <label for="product-1">Bunny-Kingdom</label>
                    <p><span>39</span> €</p>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="basket-unit">
                    <input type="checkbox" id="product-2" checked><img src="assets/img/produits/calico.webp"
                        alt="boîte du jeu Calico">
                    <label for="product-2">Calico</label>
                    <p><span>25</span> €</p>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="basket-unit">
                    <input type="checkbox" id="product-3" checked><img src="assets/img/produits/cascadia.webp"
                        alt="boîte du jeu Cascadia">
                    <label for="product-3">Cascadia</label>
                    <p><span>30</span> €</p>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="basket-unit">
                    <input type="checkbox" id="product-4" checked><img
                        src="assets/img/produits/TURBULENCES_couverture_2020-600x600.jpg"
                        alt="boîte du jeu Turbulences">
                    <label for="product-4">Turbulences</label>
                    <p><span>60</span> €</p>
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
            <div class="basket-validation">
                <p id="total"></p>
                <button class="btn btn-primary" type="submit"></button>
            </div>
        </div>        

<?php 

$content = ob_get_clean();
$defaultDescription = $_SESSION['defaultDescription'];
$description = "Gérez le contenu de votre panier, sélectionnez vos articles et validez votre commande.";

render('layout', true, [
    'description' => $description,
    'title' => "Le Grenier du Joueur - Mon panier",
    'css' => ['/lib/bootstrap/css/bootstrap.min.css', '/assets/css/styles.css', 'assets/css/basket.css'],
    'content' => $content,
    'js' => ['/lib/bootstrap/js/bootstrap.bundle.min.js', '/assets/js/main.js', '/assets/js/basket.js']
]);

?>