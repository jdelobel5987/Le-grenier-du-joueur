<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Bienvenue sur le Grenier du Joueur, votre nouvelle expérience achat de jeu de société en ligne. Découvrez nos nouveautés, parcourez vos catégories favorites et recherchez des produits spécifiques.">
    <title>Bienvenue sur le Grenier du Joueur</title>
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <script src="https://kit.fontawesome.com/e5fa1154d4.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="container-header">
            <div class="name">
                <p>Le<br>Grenier<br>du Joueur</p>
            </div>

            <div class="container-searchbar">
                <div class="searchBar">
                    <!-- burger menu -->
                    <input class="input" type="text" placeholder="Rechercher un jeu">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <!-- icone de recherche -->
                </div>
            </div>
            <div class="connection">
                <button type="button">
                    <i class="fa-solid fa-user"></i>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <main>
        <div class="container-carousel">
            <h2>Nouveautés</h2>
            <div class="carousel slide" id="myCarousel" data-bs-touch="true" data-bs-ride="carousel"
                data-bs-pause="hover">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./assets/img/nouveautés/Azul-duel.webp" alt="boîte du jeu Azul duel"
                            class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/Cryptic-nature.webp" alt="boîte du jeu Cryptic nature"
                            class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/Evergreen-ext-giant-trees-and-mushrooms.webp"
                            alt="boîte de l'extension de jeu Evergreen giant trees and mushrooms"
                            class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/Flow.webp" alt="boîte du jeu Flow" class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/Fromage.webp" alt="boîte du jeu Fromage"
                            class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/Refuge.webp" alt="boîte du jeu Refuge" class="d-block m-auto">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/nouveautés/The-gang.webp" alt="boîte du jeu The gang"
                            class="d-block m-auto">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Précédent</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Suivant</span>
                </button>
                <br><br>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" aria-label="Slide 1"
                        aria-current="true" class="active bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="5" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="6" aria-label="Slide 1"
                        class="bg-dark bg-opacity-75"></button>
                </div>
            </div>
        </div>

        <div class="categories">
            <h2>Catégories</h2>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center fs-5 fw-bold">Pour enfants</div>
                        <div class="card-body d-flex flex-column">
                            <img src="assets/img/categories/Cat_enfants2.png" alt="image de catégorie jeux pour enfants"
                                class="card-img-top">
                            <p class="card-text">Des jeux ludiques et éducatifs pour éveiller l'imagination des plus
                                jeunes tout en s'amusant.</p>
                            <a href="#" class="btn mt-auto">Explorer</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center fs-5 fw-bold">Jeux de cartes</div>
                        <div class="card-body d-flex flex-column">
                            <img src="assets/img/categories/Cat_cartes2.png" alt="image de catégorie jeux de cartes"
                                class="card-img-top">
                            <p class="card-text">Construisez votre stratégie carte après carte dans ces jeux captivants
                                et évolutifs.</p>
                            <a href="#" class="btn mt-auto">Explorer</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center fs-5 fw-bold">Jeux de dés</div>
                        <div class="card-body d-flex flex-column">
                            <img src="assets/img/categories/Cat_des2.png" alt="image de catégorie jeux de dés"
                                class="card-img-top">
                            <p class="card-text">Laissez la chance et la stratégie décider de l'issue avec ces jeux
                                dynamiques basés sur les dés.</p>
                            <a href="#" class="btn mt-auto">Explorer</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center fs-5 fw-bold">Jeux classiques</div>
                        <div class="card-body d-flex flex-column">
                            <img src="assets/img/categories/Cat_classique2.png" alt="image de catégorie jeux classiques"
                                class="card-img-top">
                            <p class="card-text">Redécouvrez les incontournables qui traversent les générations et
                                rassemblent tout le monde.</p>
                            <a href="#" class="btn mt-auto">Explorer</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center fs-5 fw-bold">Jeux de réflexion</div>
                        <div class="card-body d-flex flex-column">
                            <img src="assets/img/categories/Cat_reflexion.webp"
                                alt="image de catégorie jeux de réflexion" class="card-img-top">
                            <p class="card-text">Mettez vos méninges à l'épreuve avec ces défis intellectuels
                                passionants.</p>
                            <a href="#" class="btn mt-auto">Explorer</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center fs-5 fw-bold">Jeux de rôles</div>
                        <div class="card-body d-flex flex-column">
                            <img src="assets/img/categories/Cat_jdr.png" alt="image de catégorie jeux de rôles"
                                class="card-img-top">
                            <p class="card-text">Plongez dans des univers immersifs et incarnez des personnages dans des
                                aventures épiques.</p>
                            <a href="#" class="btn mt-auto">Explorer</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center fs-5 fw-bold">Jeux de stratégie</div>
                        <div class="card-body d-flex flex-column">
                            <img src="assets/img/categories/Cat_strategie2.png"
                                alt="image de catégorie jeux de stratégie" class="card-img-top">
                            <p class="card-text">Planifiez, anticipez et dominez vos adversaires avec ces jeux exigeants
                                et captivants.</p>
                            <a href="#" class="btn mt-auto">Explorer</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center fs-5 fw-bold">Jeux d'ambiance</div>
                        <div class="card-body d-flex flex-column">
                            <img src="assets/img/categories/Cat_ambiance.png" alt="image de catégorie jeux d'ambiance"
                                class="card-img-top">
                            <p class="card-text">Créez des moments inoubliables avec des jeux drôles et interactifs
                                parfaits pour les soirées.</p>
                            <a href="#" class="btn mt-auto">Explorer</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 shadow p-3 mb-5 bg-white rounded">
                        <div class="card-header text-center fs-5 fw-bold">Accessoires</div>
                        <div class="card-body d-flex flex-column">
                            <img src="assets/img/categories/Cat_accessoires.jpg"
                                alt="image de catégorie accessoires de jeu" class="card-img-top">
                            <p class="card-text">Complétez vos parties avec des accessoires essentiels pour une
                                expérience de jeu optimale.</p>
                            <a href="#" class="btn mt-auto">Explorer</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="icon-bar">
            <div class="container-icon-bar">
                <a href="index.html" class="icon" id="iconHome"><i class="fa-solid fa-house fa-2x"></i></a>
                <a href="products-search.html" class="icon" id="iconSearch"><i
                        class="fa-solid fa-magnifying-glass fa-2x"></i></a>
                <a href="user-account.html" class="icon" id="iconAccount"><i class="fa-solid fa-user fa-2x"></i></a>
                <a href="basket.html" class="icon" id="iconCart"><i class="fa-solid fa-cart-shopping fa-2x"></i></a>
                <a href="irl-store.html" class="icon" id="iconStore"><i class="fa-solid fa-dungeon fa-2x"></i></a>
            </div>
        </div>
    </main>
    <footer>
        <div class="container-footer">
            <p>Copyright © Julien Delobel 2024</p>
            <p>site fictif d'e-commerce: Le Grenier du Joueur</p>
            <a href="./assets/pdf/Mentions_Légales_Le_Grenier_du_Joueur.pdf">Mentions légales</a>
            <a href="./assets/pdf/Politique_de_Confidentialite_Le_Grenier_du_Joueur.pdf">Politiques de
                confidentialité</a>
        </div>
    </footer>
    <script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/index_resize-carousel.js"></script>
</body>

</html>