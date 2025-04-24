<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content= 
        <?= isset($data['description']) ? $data['description'] : DEFAULT_DESCRIPTION; ?> >
    <title>
        <?= isset($data['title']) ? $data['title'] : 'Le Grenier du Joueur' ?></title>
    <?php 
    if (isset($data['css'])) {
        foreach ($data['css'] as $css) {
            echo "<link rel='stylesheet' href='$css'>\n";
        }
    }
    ?>
    <script src="https://kit.fontawesome.com/e5fa1154d4.js" 
    crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="container-header">
            <div class="name">
                <p>Le<br>Grenier<br>du Joueur</p>
            </div>

            <div class="container-searchbar">
                <form action="products-search" method="GET" class="searchBar">
                    <input type="hidden", name="action", value="search">
                    <input class="input" type="text" name="query" placeholder="Rechercher un jeu" required>
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
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
        <?php
        if(isset($_SESSION['user'])) {
            switch($_SESSION['user']['id_roles']) {
                case '1':
                    render('components/iconBar_admin', true);
                    break;
                case '2':
                    render('components/iconBar', true);
                    break;
                default:
            }
        } else {
            render('components/iconBar', true);
        }
        ?>
    </main>

    <footer>
        <div class="container-footer">
            <p>Copyright © Julien Delobel 2024</p>
            <p>site fictif d'e-commerce: Le Grenier du Joueur</p>
            <a href="./assets/pdf/Mentions_Légales_Le_Grenier_du_Joueur.pdf">
                Mentions légales</a>
            <a href="./assets/pdf/Politique_de_Confidentialite_Le_Grenier_du_Joueur.pdf">
                Politiques de confidentialité</a>
        </div>
    </footer>

    <script type="text/javascript"> 
        const isLogged = <?= json_encode(isLogged()); ?>;
        document.addEventListener('DOMContentLoaded', () => {
            const logBtn = document.querySelector('.connection>button');
            const logBtnText = document.querySelector('.connection span');
            const iconBarUser = document.getElementById('iconAccount');

            if (isLogged) {
              logBtnText.textContent = 'Mon compte';
              logBtn.addEventListener('click', () => {
                window.location.href = '/user-account';
              })
              iconBarUser.href = "/user-account";
            } else {
              logBtnText.textContent = 'Connexion';
              logBtn.addEventListener('click', () => {
                window.location.href = '/connection';
              })
              iconBarUser.href = "/connection"
            }
        });      
    </script>
    
    <?php 
    if(isset($data['js'])) {
        foreach($data['js'] as $js) {
            echo "<script src='$js'></script>";
        }
    }
    ?>

</body>
</html>