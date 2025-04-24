<?php 

require 'models/products.php';
require 'models/filters.php';

// if($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if($_GET['action'] === 'filter') {
        
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
    }

    if($_GET['action'] === 'search' && !empty($_GET['query'])) {
        $query = $_GET['query'];
        if(!empty($query)) {
            if(preg_match('/^[a-zA-Z0-9\s\']+$/', $query)) {
                $validQuery = htmlspecialchars($query);
                
                $gameList = getProductByQuery($validQuery);
                // search in DB with 'LIKE'
                // display results
            } else {
                $error['query'] = "Format de recherche invalide (caractères autorisés: lettres, chiffres, espace, apostrophe).";
            }
        } else {
            $error['query'] = "Le champs de recherche est vide!";
        }
    }

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