<?php
	namespace Models;

	use Core\Model as Model;
	use Models\ModelUser as ModelUser;

	class ModelPage extends Model {
		static function getMenu() {
			// Get list of menus for logged-in and logged-out users.
			$arrNavs = require ROOT . 'app/config/nav_data.php';
			if (ModelUser::isLoggedIn())
				return ($arrNavs['logged-in']);
			else
				return ($arrNavs['logged-out']);
		}
	}
?>