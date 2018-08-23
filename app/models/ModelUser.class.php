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

		private function getSuperposables() {
			$files = scandir(SUPERPOSABLES_DIR);

			if (isset($files))
			{
				$files = array_map(function($file) {
					return SUPERPOSABLES . strrchr($file, '/');
				}, array_filter(array_map(function($file) {
					return SUPERPOSABLES_DIR . '/' . $file;
				}, $files), function($file) {
					if (is_file($file) && strstr($file, '.png'))
						return $file;
				}));
			}

			return (array_values($files));
		}

		function getPhotoData() {
			$data = Page::getInitPageData('Photo page');
			$data['superposables'] = $this->getSuperposables();
			return ($data);
		}

		// private function decodeImg($img) {
		// 	$img = str_replace('data:image/png;base64,', '', $img);
		// 	$img = str_replace(' ', '+', $img);
		// 	$data = base64_decode($img);
		// 	file_put_contents('file.png', $data);
		// 	return $data;
		// }

		function photoMerge() {
			if (isset($_FILES['main']) && isset($_FILES['superposable']))
			{
				$dest = imagecreatefrompng($_FILES['main']['tmp_name']);
				// $src = imagecreatefrompng($_FILES['superposable']['tmp_name']);

				// list($srcWidth, $srcHeight) = getimagesize($_FILES['superposable']['tmp_name']);

				// imagecopy($dest, $src, 0, 0, 0, 0, $srcWidth, $srcHeight);

				imagepng($dest, ROOT . '../data/tmp.png');

				imagedestroy($dest);
				// imagedestroy($src);
			}
		}
	}
?>