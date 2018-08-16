<?php
	namespace Models;

	use Core\Model as Model;
	use Core\DB as DB;

	class ModelAuth extends Model {
		function login() {
			if (!isset($_POST['submit']) || !isset($_POST['username']) || !isset($_POST['password']))
				\Helpers\showErrorMessage('ERROR: Missed some inputs!');
			else
			{
				$username = strtolower($_POST['username']);
				$password = strtolower($_POST['password']);

				$user = DB::getUserByUsername($username);
				if ($user && $user['password'] == $password)
				{
					$_SESSION['logged_in_user'] = $username;
					\Helpers\showMessage("You're now logged-in!");
				}
				else
					\Helpers\showErrorMessage('ERROR: Invalid username or password!');
			}
		}

		function register() {
			if (!isset($_POST['submit']) || !isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['confirm-password']))
				\Helpers\showErrorMessage('ERROR: Missed some inputs!');
			else
			{
				$username = strtolower($_POST['username']);
				$username = strtolower($_POST['email']);
				$password = strtolower($_POST['password']);
				$passwordConfirm = strtolower($_POST['passwordConfirm']);

				
			}
		}
	}
?>