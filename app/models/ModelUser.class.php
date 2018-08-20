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
			\Helpers\showMessage("You're now logged-out!", OK);
		}

		function login() {
			global $DB_USERS;
			if (!isset($_POST['submit']) || !isset($_POST['username']) || !isset($_POST['password']))
				\Helpers\showMessage('ERROR: Missed some inputs!', ERROR);
			else
			{
				$username = strtolower($_POST['username']);
				$password = $_POST['password'];

				$user = DB::getRowData($DB_USERS, '*', 'username', $username);

				if ($user && password_verify($password, $user['password']) && $user['status'] == VERIFIED)
				{
					$_SESSION['logged_in_user'] = $username;
					\Helpers\showMessage("You're now logged-in!", OK);
				}
				else
					\Helpers\showMessage('ERROR: Invalid username or password!', ERROR);
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
				\Helpers\showAjaxMessage('Your are already verified!', ERROR);
			else if ($user)
			{
				$subject = 'Activate your account';
				$message = 'Click http://' . $_SERVER['HTTP_HOST'] . '/verify/' . $user['activationKey'] . ' to activate your account!';
				$this->sendMail($email, $subject, $message);
				\Helpers\showAjaxMessage("Please, check your email to activate your account!", OK);
			}
			else
				\Helpers\showAjaxMessage('ERROR: there are no user with such email!', ERROR);
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
			$this->sendVerificationKey();
		}

		function register() {
			global $DB_USERS;
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
				\Helpers\showAjaxMessage('ERROR: such user already exists!', ERROR);
				return (0);
			}

			/*
			** Check whether certain email is free or not.
			*/
			$user = DB::getRowData($DB_USERS, '*', 'email', $email);
			if ($user)
			{
				\Helpers\showAjaxMessage('ERROR: such email already exists!', ERROR);
				return (0);
			}

			/*
			** Check whether passwords are equal.
			*/
			if ($password != $passwordConfirm)
			{
				\Helpers\showAjaxMessage('ERROR: passwords are not equal!', ERROR);
				return (0);
			}

			/*
			** Add user to database + send an verification email to user.
			*/
			$password = password_hash($password, PASSWORD_BCRYPT);
			$this->acceptUser($email, $username, $password);
		}

		/*
		** This function verifies a user.
		*/
		function verify($key) {
			global $DB_USERS;
			$user = DB::getRowData($DB_USERS, '*', 'activationKey', $key);

			if ($user && $user['status'] == VERIFIED)
				\Helpers\showMessage('Your are already verified', ERROR);
			else if ($user)
			{
				DB::updateRowData($DB_USERS, 'status', VERIFIED, 'username', $user['username']);
				DB::updateRowData($DB_USERS, 'activationKey', null, 'username', $user['username']);
				\Helpers\showMessage('Your are now verified!', OK);
			}
			else
				\Helpers\showMessage('ERROR: Invalid Activation Key!', ERROR);
		}

		/*
		** This function creates new password for user and send him to hiw email.
		*/
		function passwordReset() {
			global $DB_USERS;
			$email = (isset($_POST['email'])) ? $_POST['email'] : "";

			$email = strtolower($email);

			$user = DB::getRowData($DB_USERS, '*', 'email', $email);

			if ($user)
			{
				$newPassword = substr(md5($email . time()), 0, 12);

				$subject = 'Your new password!';
				$message = 'Your new password now is ' . $newPassword . '!';
				$this->sendMail($email, $subject, $message);

				$newPassword = password_hash($newPassword, PASSWORD_BCRYPT);

				DB::updateRowData($DB_USERS, 'password', $newPassword, 'email', $email);
				\Helpers\showAjaxMessage('Check your email to get your new password!', OK);
			}
			else
				\Helpers\showAjaxMessage('ERROR: invalid email!', ERROR);
		}
	}
?>