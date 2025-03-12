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

        <div class="subtabContent" id="create">
            <?php
            // var_dump($users);
            if(count($users) > 0) {
                echo "<table border='1'><thead><tr>";
            
                foreach(array_keys($users[0]) as $colname) {
                    echo "<th>" . htmlspecialchars($colname) . "</th>";
                }
                echo"</tr></thead><tbody>";
                foreach($users as $user) {
                    echo "<tr>";
                    foreach($user as $key => $value) {
                        echo "<td align='center'>". htmlspecialchars($value ?? ''). "</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            
            } else {
                echo "Aucun utilisateur trouvé";
            }
            ?>
        </div>
        <br>
        <div class="subtabs">
            <button class="subtabLink" data-target="create">Créer un utilisateur</button>
            <button class="subtabLink" data-target="read">Voir un/des utilisateurs</button>
            <button class="subtabLink" data-target="update">Modifier un utilisateur</button>
            <button class="subtabLink" data-target="delete">Supprimer un utilisateur</button>
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