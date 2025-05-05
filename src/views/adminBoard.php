<?php 

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_games'])) {
    $id = $_POST['id_games'];
    $game = getProductById($id);
    // echo $id;
    // var_dump($game);
}

$productUpdateTabActive = isset($game) ? 'active' : '';
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Grenier du Joueur - panneau d'administration</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>

    <h1>Admin Board</h1>
    <nav>
        <a href="/" class="btn">Retour à l'acceuil </a>
    </nav>

    <div class="tabs">
        <button class="tabLink" data-target="users">Utilisateurs</button>
        <button class="tabLink" data-target="products">Produits</button>
        <button class="tabLink" data-target="statistics">Statistiques</button>
    </div>

    <div class="tabContent" id="users">
        <h3>Base des comptes utilisateurs</h3>
        <!-- <p>CRUD utilisateurs</p> -->

        <div class="subtabs">            
            <button class="subtabLink" data-target="read">Voir les utilisateurs</button>
            <button class="subtabLink" data-target="create">Créer un utilisateur</button>
            <button class="subtabLink" data-target="update">Modifier un utilisateur</button>
            <button class="subtabLink" data-target="delete">Supprimer un utilisateur</button>
        </div>
        <br>

        <div class="subtabContent" id="subtab-read">
            test read<br><br>
            <?php
            // var_dump($users);
            
            // dynamic user table display
            if(count($users) > 0) {
                echo "<table border='1'><thead><tr>";
                
                // create table header = column names from DB ($users is a left join of users and addresses)
                foreach(array_keys($users[0]) as $colname) {
                    echo "<th>" . htmlspecialchars($colname) . "</th>";
                }
                echo"</tr></thead><tbody>";
            
                // populate the table with $users data
                foreach($users as $user) {
                    echo "<tr>";
                    foreach($user as $key => $value) {
                        echo "<td align='center'>" . htmlspecialchars($value ?? '') . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            
            } else {
                echo "Aucun utilisateur trouvé";
            }
            ?>

            <br><label for="id">sélectionner un utilisateur : </label>
            <select name="id_users" id="id">
                <?php
            foreach($users as $user) {
                echo "<option value='" . $user['id'] . "'>" . $user['id'] . "</option>";
            }
            ?>
            </select><br>
        </div>
        <div class="subtabContent" id="subtab-create">
            test create<br><br>
            
            <form action="adminAction" method="post">
                <input type="hidden" name="DB_table" value="users">
                <input type="hidden" name="action" value="create">
                <div class="panel required">
                    <div class="field">
                        <label for="firstname">Prénom : </label>
                        <input id="firstname" name="firstname" type="text" required>
                    </div>
                    <div class="field">
                        <label for="lastname">Nom : </label>
                        <input id="lastname" name="lastname" type="text" required>
                    </div>
                    <div class="field">
                        <label for="email">Email : </label>
                        <input id="email" name="email" type="email" required>
                    </div>
                    <div class="field">
                        <label for="password">Mot de passe : </label>
                        <input id="password" name="password" type="password" required>
                    </div>
                </div>
                <div class="panel address">
                    <div class="field">
                        <label for="address">Adresse : </label>
                        <input id="address" name="address" type="text">
                    </div>
                    <div class="field">
                        <label for="complement">Complément : </label>
                        <input id="complement" name="complement" type="text">
                    </div>
                    <div class="field">
                        <label for="zipcode">Code postal : </label>
                        <input id="zipcode" name="zipcode" type="text">
                    </div>
                    <div class="field">
                        <label for="city">Ville : </label>
                        <input id="city" name="city" type="text">
                    </div>
                </div>
                <div class="panel communication">
                    <div class="field">
                        <label for="phone">Numéro de téléphone : </label>
                        <input id="phone" name="phone" type="tel">
                    </div>
                    <div class="field">
                        <label for="communication">Mode de communication</label>
                        <select name="communication" id="communication">
                            <option value="email" selected>Email</option>
                            <option value="sms">SMS</option>
                            <option value="both">Email et SMS</option>
                            <option value="none">Aucune</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="newsletter">Je souhaite recevoir la newsletter</label>
                        <select name="newsletter" id="newsletter">
                            <option value="true" selected>Oui</option>
                            <option value="false">Non</option>
                        </select>
                    </div>
                    <button type="submit">Enregistrer</button>
                </div>
            </form>


        </div>
        <div class="subtabContent" id="subtab-update">
            test update<br><br>
            <label for="id">sélectionner un utilisateur : </label>
            <select name="id_users" id="id">
                <?php
            foreach($users as $user) {
                echo "<option value='" . $user['id'] . "'>" . $user['id'] . "</option>";
            }
            ?>
            </select><br>
        </div>
        <div class="subtabContent" id="subtab-delete">
            test delete<br><br>
            <label for="id">sélectionner un utilisateur : </label>
            <select name="id_users" id="id">
                <?php
            foreach($users as $user) {
                echo "<option value='" . $user['id'] . "'>" . $user['id'] . "</option>";
            }
            ?>
            </select><br>
        </div>
    </div>

    <div class="tabContent" id="products">
        <h3>Base des produits</h3>

        <div class="subtabs">            
            <button class="subtabLink" data-target="readProduct">Voir les produits</button>
            <button class="subtabLink" data-target="createProduct">Créer un produit</button>
            <button class="subtabLink" data-target="updateProduct">Modifier un produit</button>
            <button class="subtabLink" data-target="deleteProduct">Supprimer un produit</button>
        </div>
        <br>

        <div class="subtabContent" id="subtab-readProduct">
            test read<br><br>
            
            <br><label for="title">sélectionner un produit : </label>
            <select name="title_games" id="title">
            <?php
            foreach($products as $product) {
                echo "<option value='" . $product['id'] . "'>" . $product['titre'] . "</option>";
            }
            ?>
            </select><br><br>

            <?php
            // var_dump($products);
            // dynamic user table display
            if(isset($products) && count($products) > 0) {
                echo "<table border='1'><thead><tr>";
                
                // create table header = column names from DB ($products is a left join of games and dependent tables)
                foreach(array_keys($products[0]) as $colname) {
                    echo "<th>" . htmlspecialchars($colname) . "</th>";
                }
                echo"</tr></thead><tbody>";
            
                // populate the table with $products data
                foreach($products as $product) {
                    echo "<tr>";
                    foreach($product as $key => $value) {
                        echo "<td align='center'>" . htmlspecialchars($value ?? '') . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            
            } else {
                echo "Aucun produit trouvé";
            }
            ?>
        </div>
        <div class="subtabContent" id="subtab-createProduct">
            test create<br><br>
        
            <form action="adminAction" method="post">
                <input type="hidden" name="DB_table" value="products">
                <input type="hidden" name="action" value="create">

                <div class="panel required">
                    <div class="field">
                        <label for="title">Titre : </label>
                        <input id="title" name="title" type="text" required>
                    </div>
                    <div class="field">
                        <label for="price">Prix : </label>
                        <input id="price" name="price" type="text" required>
                    </div>
                    <div class="field">
                        <label for="stock">Stock : </label>
                        <input id="stock" name="stock" type="text" required>
                    </div>
                    <div class="field">
                        <label for="year_published">Année de création : </label>
                        <input id="year_published" name="year_published" type="text" required>
                    </div>
                    <div class="field">
                        <label for="month_published">Mois de création : </label>
                        <select id="month_published" name="month_published" required>
                            <?php
                            for($i = 1; $i <= 12; $i++) {
                                echo "<option value='" . $i . "'>" . $i . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="panel play">
                    <div class="field">
                        <label for="id_difficulty">Difficulté : </label>
                        <select id="id_difficulty" name="id_difficulty" required>
                            <?php
                            foreach($difficulties as $difficulty) {
                                echo "<option value='" . $difficulty['id_difficulty'] . "'>" . $difficulty['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="min_players">Joueurs_min : </label>
                        <input id="min_players" name="min_players" type="text" required>
                    </div>
                    <div class="field">
                        <label for="max_players">Joueurs_max : </label>
                        <input id="max_players" name="max_players" type="text" required>
                    </div>
                    <div class="field">
                        <label for="recommended_age">Âge minimal : </label>
                        <input id="recommended_age" name="recommended_age" type="text" required>
                    </div>
                    <div class="field">
                        <label for="playing_time">Durée estimée : </label>
                        <input id="playing_time" name="playing_time" type="text" required>
                    </div>                    
                </div>

                <div class="panel lore">    
                    <div class="field">
                        <label for="id_categories">Catégories (1+): </label>
                        <select id="id_categories" name="id_categories" multiple>
                            <?php
                            foreach($categories as $category) {
                                echo "<option value='" . $category['id_categories'] . "'>" . $category['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="id_themes">Thèmes (1+): </label>
                        <select id="id_themes" name="id_themes" multiple>
                            <?php
                            foreach($themes as $theme) {
                                if($theme['licensed'] === 'false') { // licensed is not a boolean in DB -> use brackets
                                    echo "<option value='" . $theme['id_themes'] . "'>" . $theme['name'] . "</option>";
                                }
                            }
                            ?>
                            <optgroup label='Licences'>
                            <?php
                            foreach($themes as $theme) {
                                if($theme['licensed'] === 'true') { // same comment, not a bool in DB
                                    echo "<option value='" . $theme['id_themes'] . "'>" . $theme['name'] . "</option>";
                                }
                            }
                            ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="field">
                        <label for="description">Description : </label>
                        <textarea id="description" name="description" rows="3" cols="" required></textarea>
                    </div>
                    <button type="submit">Enregistrer</button>
                </div>
            </form>
        </div>
        <div class="subtabContent" id="subtab-updateProduct">
            test update<br><br>
            <form action="" method="post" id="updateProductForm">
                <label for="id_games">sélectionner un produit : </label>
                <select name="id_games" id="id_games">
                    <?php
                    foreach($products as $product) {
                        $selected = (isset($game) && $product['id'] === $game['id_games']) ? 'selected' : '';
                        echo "<option value='" . $product['id'] . "'" . $selected . ">" . $product['titre'] . "</option>";
                    }
                    ?>
                </select>
            </form><br><br>

            <form action="adminAction" method="post">
                <input type="hidden" name="DB_table" value="products">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id_game" id="id_game" value="<?= isset($id) ? $id : '' ?>">

                <div class="panel required">
                    <div class="field">
                        <label for="update_title">Titre : </label>
                        <input id="update_title" name="title" type="text" value="<?= isset($game) ? $game['title'] : '' ?>" required>
                    </div>
                    <div class="field">
                        <label for="update_price">Prix : </label>
                        <input id="update_price" name="price" type="text" value="<?= isset($game) ? $game['price'] : '' ?>" required>
                    </div>
                    <div class="field">
                        <label for="update_stock">Stock : </label>
                        <input id="update_stock" name="stock" type="text" value="<?= isset($game) ? $game['stock'] : '' ?>" required>
                    </div>
                    <div class="field">
                        <label for="update_year_published">Année de création : </label>
                        <input id="update_year_published" name="year_published" type="text" value="<?= isset($game) ? $game['year_published'] : '' ?>" required>
                    </div>
                    <div class="field">
                        <label for="update_month_published">Mois de création : </label>
                        <select id="update_month_published" name="month_published" required>
                            <?php
                            for($i = 1; $i <= 12; $i++) {
                                $selected = (isset($game) && $i === $game['month_published']) ? 'selected' : '';
                                echo "<option value='" . $i . "'" . $selected . ">" . $i . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="panel play">
                    <div class="field">
                        <label for="update_id_difficulty">Difficulté : </label>
                        <select id="update_id_difficulty" name="id_difficulty" required>
                            <?php
                            foreach($difficulties as $difficulty) {
                                $selected = (isset($game) && $difficulty['id_difficulty'] === $game['id_difficulty']) ? 'selected' : '';
                                echo "<option value='" . $difficulty['id_difficulty'] . "'" . $selected . ">" . $difficulty['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="update_min_players">Joueurs_min : </label>
                        <input id="update_min_players" name="min_players" type="text" value="<?= isset($game) ? $game['min_players'] : '' ?>" required>
                    </div>
                    <div class="field">
                        <label for="update_max_players">Joueurs_max : </label>
                        <input id="update_max_players" name="max_players" type="text" value="<?= isset($game) ? $game['max_players'] : '' ?>" required>
                    </div>
                    <div class="field">
                        <label for="update_recommended_age">Âge minimal : </label>
                        <input id="update_recommended_age" name="recommended_age" type="text" value="<?= isset($game) ? $game['recommended_age'] : '' ?>" required>
                    </div>
                    <div class="field">
                        <label for="update_playing_time">Durée estimée : </label>
                        <input id="update_playing_time" name="playing_time" type="text" value="<?= isset($game) ? $game['playing_time'] : '' ?>" required>
                    </div>                    
                </div>

                <div class="panel lore">    
                    <div class="field">
                        <label for="update_id_categories">Catégories (1+): </label>
                        <select id="update_id_categories" name="id_categories" multiple>
                            <?php
                            foreach($categories as $category) {
                                echo "<option value='" . $category['id_categories'] . "'>" . $category['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="update_id_themes">Thèmes (1+): </label>
                        <select id="update_id_themes" name="id_themes" multiple>
                            <?php
                            foreach($themes as $theme) {
                                if($theme['licensed'] === 'false') { // licensed is not a boolean in DB -> use brackets
                                    echo "<option value='" . $theme['id_themes'] . "'>" . $theme['name'] . "</option>";
                                }
                            }
                            ?>
                            <optgroup label='Licences'>
                            <?php
                            foreach($themes as $theme) {
                                if($theme['licensed'] === 'true') { // same comment, not a bool in DB
                                    echo "<option value='" . $theme['id_themes'] . "'>" . $theme['name'] . "</option>";
                                }
                            }
                            ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="field">
                        <label for="update_description">Description : </label>
                        <textarea id="update_description" name="description" rows="3" cols="" required><?= isset($game) ? $game['description'] : '' ?></textarea>
                    </div>
                    <button type="submit">Enregistrer</button>
                </div>
            </form>
        </div>
        <div class="subtabContent" id="subtab-deleteProduct">
            test delete<br><br>
            <label for="id">sélectionner un produit : </label>
            <select name="id_games" id="id">
                <?php
            foreach($products as $product) {
                echo "<option value='" . $product['id'] . "'>" . $product['titre'] . "</option>";
            }
            ?>
            </select><br>
        </div>
    </div>

    <div class="tabContent" id="statistics">
        <h3>Statistiques</h3>
        <p>Visualiser des statistiques descriptives sur les utilisateurs et les produits</p>
    </div>

    <script src="/assets/js/admin.js"></script>
</body>
</html>