<?php
	namespace Models;

	use Core\Model as Model;
	use Models\ModelAuth as Auth;

	class ModelPage extends Model {
		static function getMenu() {
			// Get list of menus for logged-in and logged-out users.
			$arrNavs = require ROOT . 'config/nav_data.php';
			if (Auth::isLoggedIn())
				return ($arrNavs['logged-in']);
			else
				return ($arrNavs['logged-out']);
		}

		static function getInitPageData($title) {
			$data = [];
			$data['menu'] = self::getMenu();
			$data['title'] = $title;
			$data['currentLink'] = \Helpers\getCurrentLink();
			return ($data);
		}
	}
?>