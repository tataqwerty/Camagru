<?php
	check_auth('/main/index', CHECK_LOGGED_OUT);

	function index() {
		$title = 'Login Page';
		if (isset($_SESSION['error']))
		{
			$error = '<div class="error error_login">' . $_SESSION['error'] . '</div>';
			unset($_SESSION['error']);
		}
		$content_view = 'view_login';
		require ROOT . 'app/views/templates/template_view.php';
	}

	function match_found_in_db($username, $password) {
		$user = get_user_by_name($username);

		if ($user && $user['password'] == $password)
			return (1);
		return (0);
	}

	function check() {
		if (!isset($_POST['submit']))
			redirect('/login/index');
		else if (!isset($_POST['username']) || !isset($_POST['password']))
			error_redirect('Error: not enough data.', '/login/index');
		else
		{
			$username = strtolower($_POST['username']);
			$password = hash('whirlpool', $_POST['password']);

			if (match_found_in_db($username, $password))
			{
				$_SESSION['logged_in_user'] = $username;
				redirect('/main/index');
			}
			else
				error_redirect('Error: invalid username or password', '/login/index');
		}
	}
?>