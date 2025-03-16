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

function getProductById($id) {
    $pdo = getConnexion();
    $sql = "SELECT * FROM `ijen_games` WHERE `id_games` = ?";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération des produits : " . $e->getMessage();
        return false;
    }
}

function getAllDifficulties() {
    $pdo = getConnexion();
    $sql = "SELECT * FROM `ijen_difficulties` ORDER BY `id_difficulty` ASC";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération des difficultés : " . $e->getMessage();
        return false;
    }
}

function getAllCategories() {
    $pdo = getConnexion();
    $sql = "SELECT * FROM `ijen_categories` ORDER BY `id_categories` ASC";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération des categories : " . $e->getMessage();
        return false;
    }
}

function getAllThemes() {
    $pdo = getConnexion();
    $sql = "SELECT * FROM `ijen_themes` ORDER BY `id_themes` ASC";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération des thèmes : " . $e->getMessage();
        return false;
    }
}
?>