<?php

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gameId'])) {
    require 'models/products.php';
    $gameId = $_POST['gameId'];
    $title = getProductById($gameId)['title'];
    // $id = getIdByTitle(htmlspecialchars($title));
    
    // echo $_POST['gameId'];
    // echo "id récupérée depuis \$_post" . $gameId;

    render('gamePage', false, [
        'gameId' => $gameId,
        'title' => $title,
        'playlistId' => getPlaylistFromGameId($gameId)
    ]);
}
    
?>