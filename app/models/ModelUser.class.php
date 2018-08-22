<?php
	namespace Models;

	use Core\Model as Model;
	use Core\DB as DB;
	use Models\ModelPage as Page;
	use Models\ModelAuth as Auth;

	class ModelUser extends Model {
		private function getId($id) {
			if ($id == 'me')
			{
				if (ModelAuth::isLoggedIn())
					$id = $_SESSION['logged_in_user'];
				else
				{
					\Helpers\redirect('/404/index');
					exit();
				}
			}
			return ($id);
		}

		private function getUserData($id) {
			global $DB_USERS;
			global $DB_AVATARS;

			$user = DB::getRowData($DB_USERS, '*', 'id', $id);

			if (!$user)
			{
				\Helpers\showMessage('ERROR: there are no such user!', ERROR);
				\Helpers\redirect('/main/index');
				exit();
			}

			$userData['name'] = $user['username'];
			$userData['email'] = $user['email'];

			// $avatar = DB::getRowData($DB_AVATARS, 'src', 'uid', $id);

			// if ($avatar)
			// 	$userData['avatar'] = ;
			// else
			// 	$userData['avatar'] = ;

			// $userData['photos'] = DB::getAllData($DB_PHOTOS, '*', 'uid', $id);

			return ($userData);
		}

		function getProfileData($id) {
			$id = $this->getId($id);
			$data = Page::getInitPageData('Profile page');
			$data['user'] = $this->getUserData($id);
			return ($data);
		}

		function getSettingsData() {

		}

		function getPhotoData() {
			$data = Page::getInitPageData('Photo page');
			return ($data);
		}
	}
?>