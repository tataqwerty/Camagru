<?php
	namespace Controllers;

	use Core\Controller as Controller;

	class ControllerURI extends Controller {
		static function getURI() {
			$URI = trim($_SERVER['REQUEST_URI'], '/');
			$URI = explode('/', $URI);
			$URI = array_filter($URI, function($arg) {
				return (strlen($arg));
			});
			$URI = array_values($URI);
			return $URI;
		}

		static function redirect($url) {
			$host = 'http://' . $_SERVER['HTTP_HOST'] . $url;
			header('Location: ' . $host);
			exit();
		}
	}
?>