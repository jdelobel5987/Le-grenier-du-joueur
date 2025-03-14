<?php

// currently for admin board display, might need more JOINs for user filtering (or create an alternate function)
function getAllProducts() {
    $pdo = getConnexion();
    $sql = "SELECT id_games AS id, ijen_games.title AS titre, price AS prix, min_players AS joueurs_min, max_players AS joueurs_max, recommended_age AS âge, playing_time AS durée, year_published AS année, month_published AS mois, stock, ijen_games.id_difficulty AS niveau, ijen_difficulties.name AS difficulté 
            FROM `ijen_games`
            LEFT JOIN `ijen_difficulties`
            ON `ijen_games`.`id_difficulty` = `ijen_difficulties`.`id_difficulty`";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération des produits : " . $e->getMessage();
        return false;
    }
}

?>