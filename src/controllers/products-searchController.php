<?php 

require 'models/products.php';

// calls the products-search view
render('products-search', false, [
    'products' => getAllProductsWithMedia()
]);

?>