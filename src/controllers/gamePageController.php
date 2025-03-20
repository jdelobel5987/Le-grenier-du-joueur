<?php

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    require 'models/products.php';
    $title = htmlspecialchars($_POST['title']);
    $id = getIdByTitle($title);
    
    // echo $_POST['title'];
    // echo($id);

    render('gamePage', false, [
        'title' => $title,
        'gameId' => $id,
        'playlistId' => getPlaylistFromGameId($id)
    ]);
}
    
?>