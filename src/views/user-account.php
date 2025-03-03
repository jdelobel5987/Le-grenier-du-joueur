<?php ob_start(); ?>

        <div class="user-account">
            <h2><img src="assets/img/icones/user.svg" alt="icone d'utilisateur"><span></span></h2>
            <div class="container userCards">
                <div class="cards row gx-3 gy-3">
                    <!-- create a php object of cards, then do a foreach calling render('templates/ui/user-account-card', true, [src, alt, title] ) 
                     create templates/ui/user-account-card.php containing the html <div class="col-6...> with calls to $data['src'], $data['alt'] and $data['title'] -->
                    <div class="col-6 col-md-3 col-lg-3">
                        <div class="card h-100" id="card-details">
                            <div class="card-image">
                                <img src="assets/img/user-account/account-details.webp"
                                    alt="image symbolisant les informations personnelles de l'utilisateur"
                                    class="card-img-top">
                            </div>
                            <div class="card-body">
                                <p class="card-title">Mes informations</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-3">
                        <div class="card h-100" id="card-addresses">
                            <div class="card-image">
                                <img src="assets/img/user-account/account-addresses.webp"
                                    alt="image symbolisant les adresses de l'utilisateur" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <p class="card-title">Mes adresses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-3">
                        <div class="card h-100" id="card-orders">
                            <div class="card-image">
                                <img src="assets/img/user-account/account-orders.webp"
                                    alt="image symbolisant les commandes de l'utilisateur" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <p class="card-title">Mes commandes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-3">
                        <div class="card h-100" id="card-wishlist">
                            <div class="card-image">
                                <img src="assets/img/user-account/account-wish-list.png"
                                    alt="image symbolisant la liste d'envies de l'utilisateur" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <p class="card-title">Ma liste d'envies</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container userContent">
                <!-- same as cards: create a php object of modals [ ['name'=> 'info perso', 'fields' => [field1 => value1, field2 => value2]], [...], [...] ], 
                 then do a foreach calling render('templates/ui/user-account-modale', true, [title, fields] ), foreach($modals as $item) {render(..., ['name' => $item['name'], 'fields' => $item['fields']])}
                 create templates/ui/user-account-modale.php with calls to foreach $data['name'] and foreach $data['fields'] -->
                <div class="content card-details" id="user-details">
                    <i class="fa fa-close fa-2x"></i>
                    <h3>Mes informations personnelles</h3>
                    <div class="data">
                        <div class="field" id="firstName">
                            <p>Prénom :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="lastName">
                            <p>Nom :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="email">
                            <p>E-mail :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="password">
                            <p>Mot de passe :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="communication">
                            <p>Communication :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="newsletter">
                            <p>Newsletter :&nbsp;</p>
                            <span></span>
                        </div>
                    </div>
                    <button type="button" id="edit-details">Modifier mes informations : <i
                            class="fa-solid fa-edit"></i></button>
                </div>
                <div class="content card-addresses" id="user-addresses">
                    <i class="fa fa-close fa-2x"></i>
                    <h3>Mes adresses</h3>
                    <select name="addresses" id="userAdresses">
                        <option value="address1">Adresse 1</option>
                        <option value="newAddress">Nouvelle adresse</option>
                    </select>
                    <div class="data">
                        <div class="field" id="address">
                            <p>Adresse :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="address-complement">
                            <p>Complément :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="zipcode">
                            <p>Code postal :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="city">
                            <p>Ville :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="phone">
                            <p>Téléphone :&nbsp;</p>
                            <span></span>
                        </div>
                    </div>
                    <button type="button" id="edit-btn">Modifier mes informations : <i class="fa fa-edit"></i></button>
                </div>
                <div class="content card-orders" id="user-orders">
                    <i class="fa fa-close fa-2x"></i>
                    <h3>Mes commandes</h3>
                    <div class="data">
                        <div class="field" id="firstName">
                            <p>Prénom :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="lastName">
                            <p>Nom :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="email">
                            <p>E-mail :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="password">
                            <p>Mot de passe :&nbsp;</p>
                            <span></span>
                        </div>
                    </div>
                    <button type="button" id="edit-btn">Modifier mes informations : <i class="fa fa-edit"></i></button>
                </div>
                <div class="content card-wishlist" id="user-wishlist">
                    <i class="fa fa-close fa-2x"></i>
                    <h3>Ma liste d'envies</h3>
                    <div class="data">
                        <div class="field" id="firstName">
                            <p>Prénom :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="lastName">
                            <p>Nom :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="email">
                            <p>E-mail :&nbsp;</p>
                            <span></span>
                        </div>
                        <div class="field" id="password">
                            <p>Mot de passe :&nbsp;</p>
                            <span></span>
                        </div>
                    </div>
                    <button type="button" id="edit-btn">Modifier mes informations : <i class="fa fa-edit"></i></button>
                </div>

            </div>
        </div>       

<?php 

$content = ob_get_clean();
$defaultDescription = $_SESSION['defaultDescription'];
$description = "Gérez vos informations personnelles et vos adresses de livraison, suivez l'état de vos commandes et accédez à votre liste de produits favoris.";

render('layout', true, [
    'description' => $description,
    'title' => "Le Grenier du Joueur - Mon compte utilisateur",
    'css' => ['/lib/bootstrap/css/bootstrap.min.css', '/assets/css/styles.css', 'assets/css/user-account.css'],
    'content' => $content,
    'js' => ['/lib/bootstrap/js/bootstrap.bundle.min.js', '/assets/js/main.js', '/assets/js/user-account.js']
]);

?>