<?php
	namespace Models;

	use Core\Model as Model;
	use Core\DB as DB;

	class ModelAuth extends Model {
		function login() {
			if (!isset($_POST['submit']) || !isset($_POST['username']) || !isset($_POST['password']))
				$_SESSION['error'] = 'Missed some inputs!';
			else
			{
				$username = strtolower($_POST['username']);
				$password = strtolower($_POST['password']);

				$user = DB::getUserByUsername($username);
				if ($user && $user['password'] == $password)
					$_SESSION['logged_in_user'] = $username;
				else
					$_SESSION['error'] = 'Invalid username or password!';
			}
		}
	}
?>