const main = document.querySelector("main");
// const body = document.querySelector("body");

main.insertAdjacentHTML(
  "beforebegin",
  `<header>
        <div class="container-header">
            <div class="name"><p>Le<br>Grenier<br>du Joueur</p></div>
            <div class="container-searchbar">    
                <div class="searchBar">
                    <!-- burger menu -->
                    <input class="input" type="text" placeholder="Rechercher un jeu">
                    <!-- icone de recherche -->
                </div>
            </div>
            <div class="connexion">                   
                <button type="button">
                    <i class="fa-solid fa-user"></i> 
                    Connexion
                </button>
            </div>
        </div>
    </header>`
);

main.insertAdjacentHTML(
  "beforeend",
  `<div class="icon-bar">
        <div class="container-icon-bar">
            <a href="index.html" class="icon" id="icon-search"><i class="fa-solid fa-house fa-2x"></i></a>
            <a href="products-search.html" class="icon" id="icon-search"><i class="fa-solid fa-magnifying-glass fa-2x"></i></a>
            <a href="user-account.html" class="icon" id="icon-account"><i class="fa-solid fa-user fa-2x"></i></a>
            <a href="basket.html" class="icon" id="icon-cart"><i class="fa-solid fa-cart-shopping fa-2x"></i></a>
            <a href="irl-store.html" class="icon" id="icon-irl-store"><i class="fa-solid fa-dungeon fa-2x"></i></a>
        </div>
    </div>`
);

main.insertAdjacentHTML(
  "afterend",
  `<footer>
        <div class="container-footer">
            <p>Copyright © Julien Delobel 2024</p> 
            <p>site fictif d'e-commerce: Le Grenier du Joueur</p>
            <a href="./assets/pdf/Mentions_Légales_Le_Grenier_du_Joueur.pdf">Mentions légales</a>
            <a href="./assets/pdf/Politique_de_Confidentialite_Le_Grenier_du_Joueur.pdf">Politiques de confidentialité</a>
        </div>
    </footer>`
);

// body.insertAdjacentHTML(
//     "beforeend",
//     // `js scripts here`
// )
