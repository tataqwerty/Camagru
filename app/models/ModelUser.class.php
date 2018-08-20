<?php
	namespace Models;

	use Core\Model as Model;
	use Core\DB as DB;

	class ModelUser extends Model {
		static function isLoggedIn() {
			if (isset($_SESSION['logged_in_user']))
				return (1);
			return (0);
		}

		function logout() {
			unset($_SESSION['logged_in_user']);
		}

		function login() {
			global $DB_USERS;
			if (!isset($_POST['submit']) || !isset($_POST['username']) || !isset($_POST['password']))
				\Helpers\showErrorMessage('ERROR: Missed some inputs!');
			else
			{
				$username = strtolower($_POST['username']);
				$password = $_POST['password'];

				$user = DB::getRowData($DB_USERS, '*', 'username', $username);

				if ($user && $user['password'] == $password && $user['status'] == VERIFIED)	// ATTENTION: Needs to be hashed!!!!!!
				{
					$_SESSION['logged_in_user'] = $username;
					\Helpers\showMessage("You're now logged-in!");
				}
				else
					\Helpers\showErrorMessage('ERROR: Invalid username or password!');
			}
		}

		function sendMail($email, $subject, $message) {

			$subjectPreferences = [
				'input-charset' => 'UTF-8',
				'output-charset' => 'UTF-8',
				'line-length' => 76,
				'line-break-chars' => '\r\n'
			];

			$header = 'Content-Type: text/html; charset=UTF-8\r\n';
			$header .= 'From: <tarasik2000@gmail.com>\r\n';
			$header .= 'Reply-To: tarasik2000@gmail.com';
			$header .= 'MIME-Version: 1.0\r\n';
			$header .= 'Content-Transfer-Enconding: 8bit\r\n';
			$header .= 'Date: ' . date('r (T)') . '\r\n';
			$header .= iconv_mime_encode('subject', $subject, $subjectPreferences);

			mail($email, $subject, $message, $header);
		}

		function sendVerificationKey() {
			global $DB_USERS;
			$email = (isset($_POST['email'])) ? $_POST['email'] : "";

			$user = DB::getRowData($DB_USERS, 'status, activationKey', 'email', $email);

			if ($user && $user['status'] == VERIFIED)
				\Helpers\showErrorMessage('Your are already verified');
			else if ($user)
			{
				$subject = 'Activate your account';
				$message = 'Click http://' . $_SERVER['HTTP_HOST'] . '/verify/' . $user['activationKey'] . ' to activate your account!';
				$this->sendMail($email, $subject, $message);
				\Helpers\showMessage("Please, check your email to activate your account!");
				return (1);
			}
			else
				\Helpers\showErrorMessage('ERROR: there are not user with such email!');
		}

		/*
		** Function that adds user to database + genereates activation key especially to user + send an email
		** with this activation key.
		*/
		private function acceptUser($email, $username, $password) {
			global $DB_USERS;
			$activationKey = md5($email . time());

			$values = [
				'email' => $email,
				'username' => $username,
				'password' => $password,
				'activationKey' => $activationKey,
				'status' => UNVERIFIED
			];

			DB::insertRowData($DB_USERS, $values);

			if ($this->sendVerificationKey())
				\Helpers\showMessage("Please, check your email to activate your account!");
			else
				\Helpers\showErrorMessage('ERROR: there are not user with such email!');
		}

		function register() {
			global $DB_USERS;
			if (!isset($_POST['submit']) || !isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['confirm-password']))
			{
				\Helpers\showErrorMessage('ERROR: Missed some inputs!');
				return (0);
			}
			else
			{
				$username = strtolower($_POST['username']);
				$email = strtolower($_POST['email']);
				$password = $_POST['password'];
				$passwordConfirm = $_POST['confirm-password'];

				/*
				** Check whether certain username is free or not.
				*/
				$user = DB::getRowData($DB_USERS, '*', 'username', $username);
				if ($user)
				{
					\Helpers\showErrorMessage('ERROR: such user already exists!');
					return (0);
				}

				/*
				** Check whether certain email is free or not.
				*/
				$user = DB::getRowData($DB_USERS, '*', 'email', $email);
				if ($user)
				{
					\Helpers\showErrorMessage('ERROR: such email already exists!');
					return (0);
				}

				/*
				** Check whether passwords are equal.
				*/
				if ($password != $passwordConfirm)
				{
					\Helpers\showErrorMessage('ERROR: passwords are not equal!');
					return (0);
				}

				/*
				** Add user to database + send an verification email to user.
				*/
				$this->acceptUser($email, $username, $password);	// PASSWORD NEEDS TO BE HASHED
				return (1);
			}
		}

		function verify($key) {
			global $DB_USERS;
			$user = DB::getRowData($DB_USERS, '*', 'activationKey', $key);

			if ($user && $user['status'] == VERIFIED)
				\Helpers\showErrorMessage('Your are already verified');
			else if ($user)
			{
				DB::updateRowData($DB_USERS, 'status', VERIFIED, 'username', $user['username']);
				DB::updateRowData($DB_USERS, 'activationKey', null, 'username', $user['username']);
				\Helpers\showMessage('Your are now verified!');
			}
			else
				\Helpers\showErrorMessage('ERROR: Invalid Activation Key!');
		}
	}
?>