<?php 
// echo $gameId;
// echo $title;
// echo $playlistId;
$product = getProductWithMediaById($gameId);
// var_dump($product);
$price = $product['price'];
$isAvailable = $product['stock'] > 0 ? true : false;
$desc = $product['description'];
$image = $product['pathP1'];
$pathLudoChrono = $product['pathVideoLudoChrono'];
$pathVideoRegle = $product['pathVideoYandrev'];
// echo $pathLudoChrono;

ob_start(); ?> 
 
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
                <div class="action price">
                    <i class="fa-solid fa-tag fa-flip fa-2xl" style="color:rgb(214, 160, 10);"></i>
                    <p><?= " " . $price . " €" ?></p>
                </div>

                <!-- <div class="toWhishlist"><i class="fa-solid fa-heart-circle-plus fa-bounce fa-2xl"></i> Ajouter à ma liste de souhaits</div> -->
                <form action="productUserAction" method="POST" class="action toWishlist">
                    <input type="hidden" name="id_games" value="<?= $gameId ?>">
                    <input type="hidden" name="action" value="toWishlist">
                    <button type="submit">
                        <i class="fa-solid fa-heart-circle-plus fa-beat fa-2xl" style="color: #d60a0a;"></i>
                        <p>Ajouter à ma liste de souhaits</p>
                    </button>
                </form>

                <!-- <div class="toWhishlist"><i class="fa-solid fa-heart-circle-check fa-2xl" style="color:rgb(34, 182, 31);"></i> Retirer de ma liste de souhaits</div> -->
                <form action="productUserAction" method="POST" class="action toCart">
                    <input type="hidden" name="id_games" value="<?= $gameId ?>">
                    <input type="hidden" name="action" value="toCart">
                    <button type="submit">
                        <i class="fa-solid fa-cart-plus fa-bounce fa-2xl"></i>
                        <p>Ajouter au panier</p>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- src="https://www.youtube.com/embed/?playlist=<?=$playlistId?>"  -->

<div class="media">
    <!-- <iframe 
        src="https://www.youtube.com/embed?playlist=<?=$playlistId?>" 
        width="300" 
        height="150" 
        allowfullscreen
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share">
    </iframe> -->

    <?php if(!empty($pathLudoChrono)): ?>
        <h5>Un doute sur le jeu ? Appréhendez rapidement les règles pour vous faire votre avis !</h5>
        <iframe 
            src="https://www.youtube.com/embed/<?=htmlspecialchars($pathLudoChrono)?>" 
            width="300" 
            height="150" 
            allowfullscreen
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share">
        </iframe>
        <hr>
    <?php endif; ?>
    
    <?php if(!empty($pathVideoRegles)): ?>
        <h5>Plongez au cœur des mécaniques et stratégies avec cette vidéo explicative complète : maîtrisez les règles avant de faire de ce jeu une pièce maîtresse de votre collection !</h5>
        <iframe 
            src="https://www.youtube.com/embed/<?=htmlspecialchars($pathVideoRegle)?>" 
            width="300" 
            height="150" 
            allowfullscreen
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share">
        </iframe>
        <hr>
    <?php endif; ?>


    <h5>Laissez-vous tenter par une ambiance musicale en jeu pour une immersion complète !</h5>
    <input id="playlistId" hidden="true" value="<?=$playlistId?>"></input>
    <?= !empty($playlistId) ? "<div id='player' class='videoFrame'></div>" : "Aucune playliste musicale disponible pour ce jeu"?>
    <p>La liste musicale est issue du site <strong>Melodice</strong> <a href="https://www.melodice.org/playlist/<?=str_replace(' ', '-', $title);?>" target="_blank"> accessible ici </a>.</p>

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