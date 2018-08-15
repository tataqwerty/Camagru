<?php
	namespace Core;

	use Controllers\ControllerURI as ControllerURI;

	class Router {
		function createRoute($controllerName, $actionName, $params) {
			$route = [];
			$route['controllerName'] = $controllerName;
			$route['actionName'] = $actionName;
			$route['params'] = $params;
			return ($route);
		}

		function getRoute() {
			$uriSegments = ControllerURI::getURI();

			$controllerName = 'ControllerMain';
			$actionName = 'actionIndex';

			if (count($uriSegments) > 0)
				$controllerName = 'Controller' . ucfirst(array_shift($uriSegments));
			if (count($uriSegments) > 0)
				$actionName = 'action' . ucfirst(array_shift($uriSegments));
			$params = $uriSegments;

			return (self::createRoute($controllerName, $actionName, $params));
		}

		function go() {
			extract(self::getRoute());

			$controllerFile = ROOT . 'app/controllers/' . $controllerName . '.class.php';
			if (file_exists($controllerFile))
			{
				$controllerName = 'Controllers\\' . $controllerName;
				$controller = new $controllerName;
			}
			else
				ControllerURI::redirect('/404');
			$action = $actionName;
			if (method_exists($controller, $action))
				$controller->$action();
			else
				ControllerURI::redirect('/404');
		}
	}
?>