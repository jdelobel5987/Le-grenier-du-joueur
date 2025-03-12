<?php ob_start() ?>

admin board

<?php
$content = ob_get_clean();
$description = "Administration du site, gestion des utilisateurs et produits";

render('layout', true, [
    'description' => $description,
    'title' => 'Le Grenier du Joueur - Administration',
    'css' => [],
    'content' => $content,
    'js' => []
]);

?>
