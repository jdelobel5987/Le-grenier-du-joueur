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
            <label for="id">sélectionner un utilisateur : </label>
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
    </div>

    <div class="tabContent" id="statistics">
        <h3>Statistiques</h3>
        <p>Visualiser des statistiques descriptives sur les utilisateurs et les produits</p>
    </div>

    <script src="/assets/js/admin.js"></script>
</body>
</html>