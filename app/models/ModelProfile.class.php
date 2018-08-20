<?php
	namespace Models;

	use Core\Model as Model;
	use Core\DB as DB;
	use Models\ModelPage as Page;

	class ModelProfile extends Model {
		function getUserData() {
			global $DB_USERS;
			$user = DB::getRowData($DB_USERS, '*', 'username', $_SESSION['logged_in_user']);
		}

		function getIndexData() {
			$data = Page::getInitPageData('Profile page');
			$data['user'] = $this->getUserData();
			return ($data);
		}

		function getSettingsData() {

		}

		function getPhotoData() {

		}
	}
?>