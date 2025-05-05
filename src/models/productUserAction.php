<?php
///////////////////////////////////////////////////////////////////////////
///////////// functions relatives to user wishlist & cart//////////////////
///////////////////////////////////////////////////////////////////////////

// add product to cart or wishlist
function addProductTo($table, $gameId) {
    $pdo = getConnexion();
    
    $userId = htmlspecialchars($_SESSION['user']['id_users']);
    // $table = "ijen_".$table; 

    $sql = "INSERT INTO `ijen_$table` (`id_users`, `id_games`) 
            VALUES (:userId, :gameId)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    } catch(PDOException $e) {
        echo "Erreur lors de l'ajout à la wishlist : " . $e->getMessage();
        return false;
    }
}

// remove product from cart or wishlist
function removeProductFrom($table, $gameId) {
    $pdo = getConnexion();
    
    $userId = htmlspecialchars($_SESSION['user']['id_users']);
    // $table = "ijen_".$table; 

    $sql = "DELETE FROM `ijen_$table` (`id_users`, `id_games`) 
            WHERE `ijen_$table`.`id_users` = :userId 
            AND `ijen_$table`.`id_games` = :gameId";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    } catch(PDOException $e) {
        echo "Erreur lors de l'ajout à la wishlist : " . $e->getMessage();
        return false;
    }
}