<?php
// var_dump(ACCOUNT_CARD_CONTENT);
// exit();

ob_start(); ?>
        <?= $updateMsg ?? ''; ?>
        <div class="user-account">
            <h2><img src="assets/img/icones/user.svg" alt="icone d'utilisateur"><span><?= "Bienvenue " . $_SESSION['user']['firstname'] . " !" ?> </span></h2>
            <div class="dropdown">
                <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mon compte
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!-- <li><a class="dropdown-item" href="#">Paramètres</a></li> -->
                    <li>
                        <form method="POST", action="accountAction">
                            <input type="hidden" name="action" value="edit">
                            <button type="submit" class="dropdown-item">Éditer mes informations</button>
                        </form>
                    </li>
                    <li>
                        <form method="POST", action="accountAction">
                            <input type="hidden" name="action" value="logout">
                            <button type="submit" class="dropdown-item">Déconnexion</button>
                        </form>
                    </li>
                    <li> <hr> </li>
                    <li>
                        <form method="POST", action="accountAction">
                            <input type="hidden" name="action" value="deleteAccount">
                            <button type="submit" class="dropdown-item" style="color: red">Supprimer mon compte</button>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="container userCards">
                <div class="cards row gx-3 gy-3">
                    <?php
                        foreach(ACCOUNT_CARDS as $key => $details) {
                            render('components/account_card', true, [
                                'name' => $key,
                                'src' => $details['src'],
                                'alt' => $details['alt'],
                                'title' => $details['title']
                            ]);
                        }
                    ?>
                </div>
            </div>

            <div class="container userContent">
                <?php
                    if((ACCOUNT_CARD_CONTENT) && is_array(ACCOUNT_CARD_CONTENT)) {
                        foreach(ACCOUNT_CARD_CONTENT as $section => $content) {
                            render('components/account_contentCard', true, [
                                'name' => $section,
                                'title' => $content['title'],
                                'fields' => $content['fields']
                            ]);
                        }
                    } else {
                        echo "<p>Aucun contenu disponible pour l'utilisateur.</p>";
                    }
                ?>
            </div>
        </div>       
<?php 

$content = ob_get_clean();
// $defaultDescription = $_SESSION['defaultDescription'];
$description = "Gérez vos informations personnelles et vos adresses de livraison, suivez l'état de vos commandes et accédez à votre liste de produits favoris.";

render('layout', true, [
    'description' => $description,
    'title' => "Le Grenier du Joueur - Mon compte utilisateur",
    'css' => ['/lib/bootstrap/css/bootstrap.min.css', '/assets/css/styles.css', 'assets/css/user-account.css'],
    'content' => $content,
    'js' => ['/lib/bootstrap/js/bootstrap.bundle.min.js', '/assets/js/main.js', '/assets/js/user-account.js']
]);

?>