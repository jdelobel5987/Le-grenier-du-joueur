<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content= <?= isset($data['description']) ? $data['description'] : $defaultDescription; ?> >
    <title><?= isset($data['title']) ? $data['title'] : 'Le Grenier du Joueur' ?></title>
    <?php 
    foreach ($data['css'] as $css) {
        echo "<link rel='stylesheet' href='$css'>\n";
    }
    ?>
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
        <?= $data['content']; ?>

        <div class="icon-bar">
            <div class="container-icon-bar">
                <a href="/" class="icon" id="iconHome"><i class="fa-solid fa-house fa-2x"></i></a>
                <a href="/products-search" class="icon" id="iconSearch"><i class="fa-solid fa-magnifying-glass fa-2x"></i></a>
                <a href="/user-account" class="icon" id="iconAccount"><i class="fa-solid fa-user fa-2x"></i></a>
                <a href="/basket" class="icon" id="iconCart"><i class="fa-solid fa-cart-shopping fa-2x"></i></a>
                <a href="/irl-store" class="icon" id="iconStore"><i class="fa-solid fa-dungeon fa-2x"></i></a>
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

    <?php 
    if(isset($data['js'])) {
        foreach($data['js'] as $js) {
            echo "<script src='$js'></script>";
        }
    }
    ?>

</body>

</html>