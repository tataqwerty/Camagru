<?php
	function index() {
		$title = 'Register Page';
		if (isset($_SESSION['error']))
		{
			$error = '<div class="error error_register">' . $_SESSION['error'] . '</div>';
			unset($_SESSION['error']);
		}
		$content_view = 'view_register';
		require ROOT . 'app/views/templates/template_auth.php';
	}

	function check_username($username) {
		$users = get_users();

		foreach($users as $user)
			if ($user['username'] == $username)
				return (0);
		return (1);
	}

	function check_email($email) {
		$users = get_users();

		foreach($users as $user)
			if ($user['email'] == $email)
				return (0);
		return (1);	
	}

	function check() {
		if (!isset($_POST['submit']))
			redirect('/register/index');
		else if (!isset($_POST['email']) || !isset($_POST['username']) || !isset($_POST['password']))
			error_redirect('Error: not enough data.', '/register/index');
		else
		{
			$email = $_POST['email'];
			$username = $_POST['username'];
			$password = hash('whirlpool', $_POST['password']);

			if (!check_email($email))
				error_redirect('Error: such email already exists', '/register/index');
			else if (!check_username($username))
				error_redirect('Error: such username already exists', '/register/index');
			else
			{
				add_user($email, $username, $password);
				redirect('/login/index');
			}
		}
	}
?>