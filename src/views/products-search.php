<?php ob_start(); ?>

        <div class="container-filter">
            <form action="" method="GET" id="filtersForm" class="filters row gx-1 gy-3">
                <input type="hidden" name="action" value="filter">
                <h2 class="">Affiner ma recherche</h2>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="category" id="category">
                        <option value="" selected><label for="category">Catégorie : </label></option>
                        <?php foreach($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['id_categories']) ?>">
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="theme" id="theme">
                        <option value="" selected><label for="theme">Thème : </label></option>
                        <?php foreach($themes as $theme): ?>
                            <?php if($theme['licensed'] === 'false'): ?>
                                <option value="<?=htmlspecialchars($theme['id_themes']) ?>">
                                    <?= htmlspecialchars($theme['name']) ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <hr>
                        <optgroup label="Licences">
                        <?php foreach($themes as $theme): ?>
                            <?php if($theme['licensed'] === 'true'): ?>
                                <option value="<?= htmlspecialchars($theme['id_themes']) ?>">
                                    <?= htmlspecialchars($theme['name']) ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="difficulty" id="difficulty">
                        <option value="" selected><label for="difficulty">Difficulté : </label></option>
                        <?php foreach($difficulties as $difficulty): ?>
                            <option value="<?= htmlspecialchars($difficulty['id_difficulty']) ?>">
                                <?= htmlspecialchars($difficulty['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="min_players" id="min_players">
                        <option value="" selected><label for="players">Joueur(s) minimum : </label></option>
                        <?php foreach($min_players as $key => $value): ?>
                            <option value="<?= $value['min_players'] ?>">
                                <?= $value['min_players'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="max_players" id="max_players">
                        <option value="" selected><label for="players">Joueur(s) maximum : </label></option>
                        <?php foreach($max_players as $key => $value): ?>
                            <option value="<?= $value['max_players'] ?>">
                                <?= $value['max_players'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="age" id="age">
                        <option value="" selected><label for="age">Âge conseillé max : </label></option>
                        <?php foreach($age as $key => $value): ?>
                            <option value="<?= $value['recommended_age'] ?>">
                                <?= $value['recommended_age'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <select name="playtime" id="playtime">
                        <option value="" selected><label for="playtime">Durée max : </label></option>
                        <?php foreach($playtime as $key => $value): ?>
                            <option value="<?=$value['playing_time'] ?>">
                                <?= $value['playing_time'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="price col-12 col-md-8 col-lg-6">
                    <label for="max_price">Prix maximal : <span id="value"></span></label>
                    <input type="range" name="max_price" id="max_price" value="150" min="0" max="150" step="10">
                </div>
                <div class="submit-button col-12 col-md-4 col-lg-12">
                    <label for="submit-filters"></label>
                    <button type="submit" id="submit-filters">Filtrer</button>
                </div>
            </form>
        </div>

        <div class="products">
            <div class="container-products">
                <div class="cards row gx-3 gy-5">

                    <?php
                    foreach($products as $product) {
                        render('components/gameCard', true, [
                            'thumbnail' => $product['pathThumbnail'],
                            'fullImage' => $product['pathP1'],
                            'title' => $product['title'],
                            'gameId' => $product['id_games']
                        ]);
                    }
                    ?>
                    
                </div>                    
            </div>
        </div>

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