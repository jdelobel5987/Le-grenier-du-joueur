<?php
require 'utils/utils.php';

$path = $_SERVER['REDIRECT_URL'];


if ($path == '/') {
	require 'controllers/indexController.php';
} else {
	$path = explode('/', $path)[1];

	$controlleur = 'controllers/' . $path . 'Controller.php';

	if (file_exists($controller)) {
		require $controller;
	} else {
		require 'views/error404.php';
	}
}
