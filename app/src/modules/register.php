<?php
	check_auth('/main/index', CHECK_LOGGED_OUT);

	function index() {
		$title = 'Register Page';
		if (isset($_SESSION['error']))
		{
			$error = '<div class="error error_register">' . $_SESSION['error'] . '</div>';
			unset($_SESSION['error']);
		}
		$content_view = 'view_register';
		require ROOT . 'app/views/templates/template_view.php';
	}

	function send_activation_link($email) {
		$user = get_user_by_email($email);

		if ($user)
		{
			$link = 'http://' . $_SERVER['HTTP_HOST'] . '/register/activate/' . $user['id'];
			$subject = 'Account activation';
			$content = '<a href="' . $link . '">ACTIVATE</a>\r\n';
			$from = 'FROM Camagru team\r\n';

			mail($email, $subject, $content, $from);
		}
	}

	function activate($id) {
		echo 'Activation';
	}

	function activation_time() {
		$title = 'Pre activation';
		$content_view = 'view_pre_activation';
		require ROOT . 'app/views/templates/template_view.php';
	}

	function check() {
		if (!isset($_POST['submit']))
			redirect('/register/index');
		else if (!isset($_POST['email']) || !isset($_POST['username']) || !isset($_POST['password']))
			error_redirect('Error: not enough data.', '/register/index');
		else
		{
			$email = strtolower($_POST['email']);
			$username = strtolower($_POST['username']);
			$password = hash('whirlpool', $_POST['password']);

			if (!match_email($email))
				error_redirect('Error: such email already exists', '/register/index');
			else if (!match_username($username))
				error_redirect('Error: such username already exists', '/register/index');
			else
			{
				add_user_to_db($email, $username, $password);
				send_activation_link($email);
				redirect('/register/activation_time');
			}
		}
	}
?>