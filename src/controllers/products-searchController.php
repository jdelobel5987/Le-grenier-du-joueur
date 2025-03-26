<?php 

require 'models/products.php';
require 'models/filters.php';

if($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {

    $filters = [
        'category' => !empty($_GET['category']) ? (int) $_GET['category'] : null,
        'theme' => !empty($_GET['theme']) ? (int) $_GET['theme'] : null,
        'difficulty' => !empty($_GET['difficulty']) ? (int) $_GET['difficulty'] : null,
        'min_players' => !empty($_GET['min_players']) ? (int) $_GET['min_players'] : null,
        'max_players' => !empty($_GET['max_players']) ? (int) $_GET['max_players'] : null,
        'age' => !empty($_GET['age']) ? (int) $_GET['age'] : null,
        'playtime' => !empty($_GET['playtime']) ? (int) $_GET['playtime'] : null,
        'max_price' => !empty($_GET['max_price']) ? (int) $_GET['max_price'] : null,
    ];

    // Filter out keys with null or empty values
    $filters = array_filter($filters, function($value) {
        return $value !== null && $value !== '';
    });

    // var_dump($filters);

    $conditions = [];
    $params = [];

    if(!empty($filters['category'])) {
        $conditions[] = "mood.id_categories = :category";
        $params[':category'] = $filters['category'];
    }
    
    if(!empty($filters['theme'])) {
        $conditions[] = "universe.id_themes = :theme";
        $params[':theme'] = $filters['theme'];
    }

    if(!empty($filters['difficulty'])) {
        $conditions[] = "games.id_difficulty = :difficulty";
        $params[':difficulty'] = $filters['difficulty'];
    }
    
    if(!empty($filters['min_players'])) {
        $conditions[] = "games.min_players >= :min_players";
        $params[':min_players'] = $filters['min_players'];
    }
    
    if(!empty($filters['max_players'])) {
        $conditions[] = "games.max_players <= :max_players";
        $params[':max_players'] = $filters['max_players'];
    }
    
    if(!empty($filters['age'])) {
        $conditions[] = "games.recommended_age <= :age";
        $params[':age'] = $filters['age'];
    }
    
    if(!empty($filters['playtime'])) {
        $conditions[] = "games.playing_time <= :playtime";
        $params[':playtime'] = $filters['playtime'];
    }
    
    if(!empty($filters['max_price'])) {
        $conditions[] = "games.price <= :max_price";
        $params[':max_price'] = $filters['max_price'];
    }

    $gameList = getProductSelection($conditions, $params);

    render('products-search', false, [
        'products' => $gameList,
        'categories' => getFilter('categories'),
        'themes' => getFilter('themes'),
        'difficulties' => getFilter('difficulties'),
        'min_players' => getUniqueOf('min_players'),
        'max_players' => getUniqueOf('max_players'),
        'age' => getUniqueOf('recommended_age'),
        'playtime' => getUniqueOf('playing_time')
    ]);

} else {
    render('products-search', false, [
        'products' => getAllProductsWithMedia(),
        'categories' => getFilter('categories'),
        'themes' => getFilter('themes'),
        'difficulties' => getFilter('difficulties'),
        'min_players' => getUniqueOf('min_players'),
        'max_players' => getUniqueOf('max_players'),
        'age' => getUniqueOf('recommended_age'),
        'playtime' => getUniqueOf('playing_time')
    ]);
}

?>