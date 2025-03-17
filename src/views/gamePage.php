<?php ob_start(); ?> 

<!-- html code -->


<iframe 
    width="560" 
    height="315" 
    src="https://www.youtube.com/embed/Qqi6-q7Ph9c?si=mo73iPCvk5iEhf9b" 
    title="YouTube video player" 
    frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
    referrerpolicy="strict-origin-when-cross-origin" 
    allowfullscreen>
</iframe>

<?php

$content = ob_get_clean();
$description = "détails des jeux de société: description, prix, images, règles vidéo et playlistes pour une immersion personnalisée.";

render('layout', true, [
    'description' => $description,
    'title' => "Le Grenier du Joueur - Détails du jeu",
    'css' => ['/lib/bootstrap/css/bootstrap.min.css', '/assets/css/styles.css'],
    'content' => $content,
    'js' => ['/lib/bootstrap/js/bootstrap.bundle.min.js', '/assets/js/main.js']
])
?>