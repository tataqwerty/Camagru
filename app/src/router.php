<?php
	function getURI() {
		$URI = trim($_SERVER['REQUEST_URI'], '/');
		$URI = explode('/', $URI);
		$URI = array_filter($URI, function($arg) {
			return (strlen($arg));
		});
		$URI = array_values($URI);
		return $URI;
	}

	function createInitdata($module, $action, $params) {
		$data = [];
		$data['module'] = $module;
		$data['action'] = $action;
		$data['params'] = $params;
		return ($data);
	}

	function getRoute() {
		$uri_segments = getURI();

		$module = 'main';
		$action = 'index';
		$params = [];

		if (count($uri_segments) > 0)
			$module = array_shift($uri_segments);
		if (count($uri_segments) > 0)
			$action = array_shift($uri_segments);
		$params = $uri_segments;

		return (createInitData($module, $action, $params));
	}

	function router() {
		extract(getRoute());

		if ($module != 'login' && $module != 'register')
			check_auth();

		$module_file = ROOT . 'app/src/modules/' . $module . '.php';
		if (file_exists($module_file))
			require $module_file;
		else
			error_page404();
		if (function_exists($action))
			$action($params);
		else
			error_page404();
	}
?>