<?php
	function check_auth($url, $flag) {
		$logged_in = (isset($_SESSION['logged_in_user'])) ? 1 : 0;

		if (!$logged_in && $flag == CHECK_LOGGED_IN)
			redirect($url);
		else if ($logged_in && $flag == CHECK_LOGGED_OUT)
			redirect($url);
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