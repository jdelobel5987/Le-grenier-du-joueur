<?php 
$product = getProductWithMediaById($gameId);
$desc = $product['description'];
$image = $product['pathP1'];

ob_start(); ?> 

<!-- html code -->
 
<div class="gameDetails">
    <h3><?=$title?></h3>
    <div class="game">
        <img src="<?=$image?>" alt="image du jeu <?=$title?>">
        <div class="details">
            <div class="description">
                <h4>Description : </h4>
                <p><?=$desc?></p>
            </div>
            <div class="interactions">
                <div class="priceTag">PRIX ET LOGO ETIQUETTE</div>
                <div class="toWhishlist">LOGO COEUR -> TO WISHLIST</div>
                <div class="toCart">LOGO CADIE OU PANIER -> TO CART</div>
            </div>
        </div>
    </div>
</div>
<div class="media">

    <!-- <iframe 
        src="https://www.youtube.com/embed/?list=<?=$playlistId?>" 
        width="300" 
        height="150" 
        allowfullscreen
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share">
    </iframe> -->
    <h6>Un doute sur le jeu ? Appréhendez rapidement les règles pour vous faire votre avis !</h6>
    <h6>Plongez au cœur des mécaniques et stratégies avec cette vidéo explicative complète : maîtrisez les règles avant de faire de ce jeu une pièce maîtresse de votre collection !</h6>
    <h6>Laissez-vous tenter par une ambiance musicale pour une immersion complète !</h6>
    <input id="playlistId" hidden="true" value="<?=$playlistId?>"></input>
    <?= !empty($playlistId) ? "<div id='player' class='videoFrame'></div>" : "Aucune playliste musicale disponible pour ce jeu"?>

</div>




<?php

$content = ob_get_clean();
$description = "détails des jeux de société: description, prix, images, règles vidéo et playlistes pour une immersion personnalisée.";

render('layout', true, [
    'description' => $description,
    'title' => "Le Grenier du Joueur - Détails du jeu",
    'css' => ['/lib/bootstrap/css/bootstrap.min.css', '/assets/css/styles.css', '/assets/css/gamePage.css'],
    'content' => $content,
    'js' => ['/lib/bootstrap/js/bootstrap.bundle.min.js', '/assets/js/main.js', '/assets/js/videoPlayer.js', 'https://www.youtube.com/iframe_api']
])
?>