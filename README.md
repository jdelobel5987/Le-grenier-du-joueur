`<strong>`Le Grenier du Joueur `</strong>` est un projet de formation professionnelle en web development effectuée à LaManu en 2024-2025. Le nom fait évidemment référence au célèbre personnage du `<strong>`Joueur du Grenier `</strong>` bien connu de la communauté web et gaming.
C'est mon premier veritable projet dev web et ma première véritable utilisation d'un système de versioning.

Il s'agit d'un site fictif d'e-commerce de vente de jeux de société. Le site doit être codé mobile-first avec un design responsive pour les formats supérieurs (tablette, desktop).

Les grandes étapes de ce projet sont:

* Conception intellectuelle du projet
  * pitch
  * segmentation
  * personas
  * user stories
  * mind map
  * analyse MoSCoW
  * charte graphique
* Conception graphique (mobile & desktop)
  * Zoning (Miro)
  * Wireframing (Miro)
  * Maquettage (Figma)
* Codage de la partie front
  * IDE: Visual Studio Code
  * stack: HTML5, CSS3, JS, bootstrap 5.3
* Design de la base de donnée
  * modèle conceptuel et modèle logique (looping)
  * SGBDR (système de gestion de bases de données relationnelles): MySQL
* Codage de la partie Back-end
  * passage en architecture MVC Model-View-Controller
  * stack: configuration AMP: Apache, mySQL, phpMyAdmin
  * différentes configurations possibles
    * Laragon (sous Windows)
    * VM Debian avec Apache et phpmyadmin + connexion SSH VS Code hôte windows
    * :rocket configuration de développement utilisée :rocket : conteneurisation (docker) PHP / MySQL / phpmyadmin (sous windows)

<hr>

A la création de ce repository, plusieurs éléments sont déjà en place:`<br>`

<ol>
  <li>Le dossier de conception initial contenant pitch/segmentation/personas/user stories/mind map/analyse MoSCoW/charte graphique/wireframe mobile et desktop/maquettage mobile et desktop/prototype mobile</li>
  <li>index.html: header, footer et icon-nav-bar (mobile only) qui seront communs à toutes les pages; plus un carousel des nouveautés produits et des cards de catégories de produits (en framework Bootstrap 5.3)</li>
  <li>une gestion responsive de la taille des images du carousel est codée en javascript (détermination de la taille écran du device, eventListener de resizing, comparaison des tailles initiale et courante à des valeurs seuil, et modification des classes BS de largeur des images)</li>
  <li>le style CSS de la page index est défini</li>
  <li>une page recherche-produit est en cours d'élaboration: design d'un bloc de filtres de recherche mis en place. Le design des cards "produit" est à faire ainsi que la dimension responsive.</li><br>
</ol>

A faire: `<br>`

<ol>
  <li>le design HTML-CSS des pages de connection/inscription, la page profile utilisateur/admin, la page-type produit, la page panier, les pages du processus d'achat, la page "boutique physique", la page admin-board</li>
  <li>les fonctionnalités dynamiques en JavaScript</li>
</ol>
