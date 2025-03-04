<?php

// function to display a view (by default) or a template when specified as 2nd argument
// with possibility to pass data (empty array by default)
function render($path, $template = false, $data = [])
{
	// Convertir les clés de $data en variables accessibles dans la vue
    extract($data);
	if ($template) {
		require "templates/$path.php";
	} else {
		require "views/$path.php";
	}
}

// function to check if the user is logged in
function isLogged() {
	// return isset($_SESSION['user_id']) ? true : false;
	return isset($_SESSION['user']) ? true : false;
}
