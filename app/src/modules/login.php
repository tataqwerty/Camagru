<?php
	function index() {
		$title = 'Login Page';
		if (isset($_SESSION['error']))
		{
			$error = '<div class="error error_login">' . $_SESSION['error'] . '</div>';
			unset($_SESSION['error']);
		}
		$content_view = 'view_login';
		require ROOT . 'app/views/templates/template_auth.php';
	}

	function match_found_in_db($username, $password) {
		$users = get_users();

		foreach($users as $user)
		{
			if ($user['username'] == $username)
				return (($user['password'] == $password) ? 1 : 0);
		}
		return (0);
	}

	function check() {
		if (!isset($_POST['submit']))
			redirect('/login/index');
		else if (!isset($_POST['username']) || !isset($_POST['password']))
			error_redirect('Error: not enough data.', '/login/index');
		else
		{
			$username = $_POST['username'];
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