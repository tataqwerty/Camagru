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

		function login() {
			if (!isset($_POST['submit']) || !isset($_POST['username']) || !isset($_POST['password']))
				\Helpers\showErrorMessage('ERROR: Missed some inputs!');
			else
			{
				$username = strtolower($_POST['username']);
				$password = $_POST['password'];

				$user = DB::getDataWhereFrom('camagru.users', '*', '`username`', $username);
				if ($user && $user['password'] == $password)	// ATTENTION: Needs to be hashed!!!!!!
				{
					$_SESSION['logged_in_user'] = $username;
					\Helpers\showMessage("You're now logged-in!");
				}
				else
					\Helpers\showErrorMessage('ERROR: Invalid username or password!');
			}
		}

		private function sendMail($email, $subject, $message) {
			$encoding = "utf-8";

			// Set preferences for Subject field
			$subject_preferences = array(
				"input-charset" => $encoding,
				"output-charset" => $encoding,
				"line-length" => 76,
				"line-break-chars" => "\r\n"
			);

			// Set mail header
			$header = "Content-type: text/html; charset=".$encoding." \r\n";
			$header .= "From: ".$from_name." <".$from_mail."> \r\n";
			$header .= "MIME-Version: 1.0 \r\n";
			$header .= "Content-Transfer-Encoding: 8bit \r\n";
			$header .= "Date: ".date("r (T)")." \r\n";
			$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);

			// Send mail
			mail($email, $subject, $message, $header);
		}

		private function acceptUser($email, $username, $password) {
			$activationKey = md5($email . time());
			DB::addUserToDB($email, $username, $password, $activationKey);

			$subject = 'Activate your account';
			$message = 'Click http://' . $_SERVER['HTTP_HOST'] . '/' . $activationKey . ' to activate your account!';
			
			$this->sendMail($email, $subject, $message);
			\Helpers\showMessage("You've just registered! Check your email to activate your account!");
		}

		function register() {
			if (!isset($_POST['submit']) || !isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['confirm-password']))
				\Helpers\showErrorMessage('ERROR: Missed some inputs!');
			else
			{
				$username = strtolower($_POST['username']);
				$email = strtolower($_POST['email']);
				$password = $_POST['password'];
				$passwordConfirm = $_POST['passwordConfirm'];

				$user = DB::getDataWhereFrom('camagru.users', '*', '`username`', $username);
				if ($user)
					\Helpers\showErrorMessage('ERROR: such user already exists!');

				$user = DB::getDataWhereFrom('camagru.users', '*', '`email`', $email);
				if ($user)
					\Helpers\showErrorMessage('ERROR: such email already exists!');

				if ($password != $passwordConfirm)
					\Helpers\showErrorMessage('ERROR: passwords are not equal!');

				// Add new user here + send verification email to user.

				$this->acceptUser($email, $username, $password);	// PASSWORD NEEDS TO BE HASHED
			}
		}
	}
?>