<?php
	ini_set('display_errors', E_ALL);

	function debug($var) {
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}

	define('ROOT', dirname(__FILE__));
	require_once (ROOT.'/app/components/Router.class.php');
	require_once (ROOT.'/app/components/DB.class.php');

	$router = new Router;
	
	$router->run();
?>