<?php
	function check_auth() {
		if ($_SERVER['logged_in_user'] == "")
		{
			$host = 'http://' . $_SERVER['HTTP_HOST'] . '/login/index';
			header('Location: ' . $host);
		}
	}

	function debug($var) {
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}

	function redirect($path) {
		$path = 'http://' . $_SERVER['HTTP_HOST'] . $path;
		header('Location: ' . $path);
	}

	function error_page404() {
		header('HTTP/1.1 404 Not Found');
		redirect('/404');
	}

	function error_redirect($msg, $url) {
		$_SESSION['error'] = $msg;
		redirect($url);
	}
?>