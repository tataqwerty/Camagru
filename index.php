<?php
	namespace Core;

	ini_set('display_errors', 'on');

	session_start();

	define('ROOT', __DIR__ . '/');

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

		// echo $pathToClass;
		// echo $className;

		require ROOT . 'app/' . $pathToClass . $className . '.class.php';
	});

	Router::go();
?>