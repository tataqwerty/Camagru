<?php
	use Core\Router as Router;

	ini_set('display_errors', 'on');

	session_start();

	define('ROOT', __DIR__ . '/app/');
	define('VERIFIED', 1);
	define('UNVERIFIED', 0);

	spl_autoload_register(function($className) {
		$segments = explode('\\', $className);
		if (!$segments)
			$segments = array_push($className); // In order to pop this element on the next line.
		$className = array_pop($segments);

		foreach ($segments as &$segment)
			$segment = strtolower($segment);
		
		if ($segments)
			$pathToClass = implode($segments, '/') . '/';
		else
			$pathToClass = "";
		require ROOT . $pathToClass . $className . '.class.php';
	});

	require ROOT . 'helpers/helpers.php';
	require ROOT . 'config/database.php';

	Router::go();
?>