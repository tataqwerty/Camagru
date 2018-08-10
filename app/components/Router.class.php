<?php
	class Router {
		private $routes;

		public function __construct() {
			$this->routes = include(ROOT . '/app/config/routes.php');
		}
		/*
		** Returns request string
		*/
		private function getURI() {
			if (!empty($_SERVER['REQUEST_URI']))
				return trim($_SERVER['REQUEST_URI'], '/');
		}

		public function run() {
			$uri = $this->getURI();

			foreach ($this->routes as $URIpattern => $path) {
				if (preg_match("~$URIpattern~", $uri))
				{
					$internal_path = preg_replace("~$URIpattern~", $path, $uri);
					$arr = explode('/', $internal_path);
					$controller = ucfirst(array_shift($arr) . 'Controller');
					$action = 'action' . ucfirst(array_shift($arr));
					$controller_path = ROOT . '/app/controllers/' . $controller . '.class.php';
					if (file_exists($controller_path))
					{
						require_once $controller_path;
						$obj = new $controller;
						call_user_method_array($action, $obj, $arr);
						break ;
					}
				}
			}
		}
	}
?>