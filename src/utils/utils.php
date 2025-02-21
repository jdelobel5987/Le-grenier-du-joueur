<?php

// function to display a view (by default) or a template when specified as 2nd argument
// with possibility to pass data (empty array by default)

function render($path, $template = false, $data = [])
{
	if ($template) {
		require "templates/$path.php";
	} else {
		require "views/$path.php";
	}
}