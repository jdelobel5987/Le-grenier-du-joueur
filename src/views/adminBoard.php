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
                echo "<option value='" . $user['id_users'] . "'>" . $user['id_users'] . "</option>";
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
                echo "<option value='" . $user['id_users'] . "'>" . $user['id_users'] . "</option>";
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
                echo "<option value='" . $user['id_users'] . "'>" . $user['id_users'] . "</option>";
            }
            ?>
            </select><br>
        </div>
    </div>

    <div class="tabContent" id="products">
        <h3>Base des produits</h3>
        <p>CRUD produits</p>

        <div class="subtabs">            
            <button class="subtabLink" data-target="readProduct">Voir les produits</button>
            <button class="subtabLink" data-target="createProduct">Créer un produit</button>
            <button class="subtabLink" data-target="updateProduct">Modifier un produit</button>
            <button class="subtabLink" data-target="deleteProduct">Supprimer un produit</button>
        </div>
        <br>

        <div class="subtabContent" id="subtab-readProduct">
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
                echo "<option value='" . $user['id_users'] . "'>" . $user['id_users'] . "</option>";
            }
            ?>
            </select><br>
        </div>
        <div class="subtabContent" id="subtab-createProduct">
            test create<br><br>
            
            <form action="adminAction" method="post">
                <input type="hidden" name="DB_table" value="products">
                <input type="hidden" name="action" value="create">
                <div class="panel required">
                    <div class="field">
                        <label for="name">Titre : </label>
                        <input id="name" name="name" type="text" required>
                    </div>
                    <div class="field">
                        <label for="price">Prix : </label>
                        <input id="price" name="price" type="text" required>
                    </div>
                    <div class="field">
                        <label for="players">Nombre de joueurs : </label>
                        <input id="players" name="players" type="text" required>
                    </div>
                    <div class="field">
                        <label for="age">Âge minimal : </label>
                        <input id="age" name="age" type="text" required>
                    </div>
                    <div class="field">
                        <label for="duration">Durée estimée : </label>
                        <input id="duration" name="duration" type="text" required>
                    </div>
                    <div class="field">
                        <label for="createdAtYear">Année de création : </label>
                        <input id="createdAtYear" name="createdAtYear" type="text" required>
                    </div>
                    <div class="field">
                        <label for="createdAtMonth">Mois de création : </label>
                        <input id="createdAtMonth" name="createdAtMonth" type="text" required>
                    </div>
                    <div class="field">
                        <label for="stock">Stock : </label>
                        <input id="stock" name="stock" type="text" required>
                    </div>
                    <div class="field">
                        <label for="description">Description : </label>
                        <textarea id="description" name="description" rows="" cols="" required></textarea>
                    </div>
                    <div class="field">
                        <label for="difficulty">Difficulté : </label>
                        <input id="difficulty" name="difficulty" type="text" required>
                    </div>
                    <button type="submit">Enregistrer</button>
                </div>
            </form>
        </div>
        <div class="subtabContent" id="subtab-updateProduct">
            test update<br><br>
            <label for="id">sélectionner un utilisateur : </label>
            <select name="id_users" id="id">
                <?php
            foreach($users as $user) {
                echo "<option value='" . $user['id_users'] . "'>" . $user['id_users'] . "</option>";
            }
            ?>
            </select><br>
        </div>
        <div class="subtabContent" id="subtab-deleteProduct">
            test delete<br><br>
            <label for="id">sélectionner un utilisateur : </label>
            <select name="id_users" id="id">
                <?php
            foreach($users as $user) {
                echo "<option value='" . $user['id_users'] . "'>" . $user['id_users'] . "</option>";
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