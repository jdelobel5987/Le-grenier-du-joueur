<?php

// useful functions/variables for MVC architecture, called here for a constant availability
require_once 'utils/session.php';
require_once 'utils/utils.php';
require_once 'utils/variables.php';

require_once 'secret/database.php';

// check the user session (inactivity-based logout) before calling a controller
checkUserSession();

// get the path of the requested page
$path = $_SERVER['REDIRECT_URL'];

// call the indexController if path is '/' (home page), else call the appropriate controller based on the path
// the controller must be named after the path: 'path'Controller.php
if ($path == '/') {
	require 'controllers/indexController.php';
} else {
	// only keep the string behind the '/' as $path
	$path = explode('/', $path)[1];
	
	// reconstruct a controller path, then check if it leads to an existing file. If not, call the error404 view
	$controller = 'controllers/' . $path . 'Controller.php';

	if (file_exists($controller)) {
		require $controller;
	} else {
		require 'views/error404.php';
	}
}