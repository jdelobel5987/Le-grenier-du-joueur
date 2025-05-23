<?php
// var_dump(ACCOUNT_CARD_CONTENT);
// exit();

ob_start(); ?>
        <?= isset($data['error']) ? $data['error'] : ''; ?>
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
                        <form method="POST" action="accountAction">
                            <input type="hidden" name="action" value="edit">
                            <button type="submit" class="dropdown-item">Éditer mes informations</button>
                        </form>
                    </li>
                    <li>
                        <form method="POST" action="accountAction">
                            <input type="hidden" name="action" value="logout">
                            <button type="submit" class="dropdown-item">Déconnexion</button>
                        </form>
                    </li>
                    <li> <hr> </li>
                    <li>
                        <form method="POST" action="accountAction" id="deleteAccountForm">
                            <input type="hidden" name="action" value="deleteAccount">
                            <!-- <button type="button" class="dropdown-item text-danger" id="deleteAccountButton">Supprimer mon compte</button> -->
                            <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal">Supprimer mon compte</button>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Confirmer la suppression</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est <strong>irréversible</strong> oui oui.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <!-- <button type="button" class="btn btn-danger" id="confirmDeletion">Supprimer</button> -->
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="confirmDeletion">Supprimer</button>
                        </div>
                    </div>
                </div>
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
                    // if((ACCOUNT_CARD_CONTENT) && is_array(ACCOUNT_CARD_CONTENT)) {
                    if(($data['cardContent']) && is_array($data['cardContent'])) {
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