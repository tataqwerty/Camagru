<?php
	namespace Helpers;

	function findRoute($uri) {
		$routes = require ROOT . 'config/routes.php';
		$route = "";

		foreach ($routes as $pattern => $path) {
			if (preg_match('#^' . $pattern . '$#', $uri))
			{
				$route = preg_replace('#^' . $pattern . '$#', $path, $uri);
				break ;
			}
		}
		return ($route);
	}

	function getCurrentLink() {
		$currentLink = findRoute(getURI());
		return ($currentLink);
	}

	function getURI() {
		return (trim($_SERVER['REQUEST_URI'], '/'));
	}

	function redirect($url) {
		$host = 'http://' . $_SERVER['HTTP_HOST'] . $url;
		header('Location: ' . $host);
		exit();
	}

	function debug($var) {
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}

	function showErrorMessage($msg) {
		$_SESSION['alertMsg'] = $msg;
		$_SESSION['alertColor'] = 'danger';
	}

	function showMessage($msg) {
		$_SESSION['alertMsg'] = $msg;
		$_SESSION['alertColor'] = 'success';
	}
?>