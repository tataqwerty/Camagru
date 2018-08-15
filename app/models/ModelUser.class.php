<?php
	namespace Models;

	use Core\Model as Model;

	class ModelUser extends Model {
		static function isLoggedIn() {
			if (isset($_SESSION['logged_in_user']))
				return (1);
			return (0);
		}
	}
?>