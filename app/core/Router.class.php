<?php
	namespace Core;

	class Router {
		private static function getSegmentedRoute($route) {
			$segmentsURI = explode('/', $route);
			$segmentsURI = array_filter($segmentsURI, function($arg) {
				return (strlen($arg));
			});
			$segmentsURI = array_values($segmentsURI);

			// 'Controllers\' here just because Controller is in the Controllers namespace.

			$segmentedRoute[] = 'Controllers\Controller' . ucfirst(array_shift($segmentsURI));
			$segmentedRoute[] = 'action' . ucfirst(array_shift($segmentsURI));
			$segmentedRoute[] = $segmentsURI;

			return ($segmentedRoute);
		}
		/*
		** This function ALWAYS returns array consist of 3 arguments [controllerName, actionName, parameters].
		*/
		private static function getControllerAction($route) {
			$segmentedRoute = self::getSegmentedRoute($route);
			$arrKeys = [
				'controllerName',
				'actionName',
				'params'
			];
			return (array_combine($arrKeys, $segmentedRoute));
		}

		static function go() {
			$route = \Helpers\findRoute(\Helpers\getURI());

			if (!$route)
				$route = "404/index";
			
			extract(self::getControllerAction($route));
			$controller = new $controllerName($route);
			$action = $actionName;
			$controller->$action($params);
		}
	}
?>