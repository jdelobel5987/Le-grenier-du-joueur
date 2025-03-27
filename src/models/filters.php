<?php
///////////////////////////////////////////////////////////////////////////
///////////// functions relatives to product filtering ////////////////////
///////////////////////////////////////////////////////////////////////////

function getFilter($filter) {
    $allowedFilters = ['categories', 'themes', 'difficulties', 'games'];
    if(!in_array($filter, $allowedFilters)) {
        echo "Filtre non valide.";
        return false;
    }

    $pdo = getConnexion();
    $table = "ijen_" . $filter;
    $sql = "SELECT * FROM `$table` ORDER BY 1 ASC"; // order ASC as per 1st column = id_filter (variable upon the table)

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération du filtre $filter : " . $e->getMessage();
        return false;
    }
}

function getUniqueOf($filter) {
    $allowedFilters = ['min_players', 'max_players', 'recommended_age', 'playing_time', 'price'];
    if(!in_array($filter, $allowedFilters)) {
        echo "Filtre non valide.";
        return false;
    }

    $pdo = getConnexion();
    $sql = "SELECT DISTINCT `$filter` FROM `ijen_games` ORDER BY `$filter` + 0 ASC"; // order ASC as per 1st column = id_filter (variable upon the table)

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération du filtre $filter : " . $e->getMessage();
        return false;
    }
}

function getProductSelection($conditions, $params) {

    $pdo = getConnexion();
    $sql = "SELECT games.*, media.* 
            FROM `ijen_games` AS games
            JOIN `ijen_media` AS media
            ON games.id_games = media.id_games
            LEFT JOIN `ijen_mood` AS mood
            ON games.id_games = mood.id_games
            LEFT JOIN `ijen_universe` AS universe
            ON games.id_games = universe.id_games
            WHERE 1=1
            ";
    
    if (!empty($conditions)) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }

    $sql .= " GROUP BY games.id_games";

    try {
        unset($stmt);   // empty cache from previous similar query
        $stmt = $pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération de la liste filtrée : " . $e->getMessage();
        return false;
    }
}
