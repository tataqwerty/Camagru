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

		function getSidebar() {
			if (ModelAuth::isLoggedIn())
			{
				$files = scandir(ROOT . '../data/tmp/' . $_SESSION['logged_in_user']);

				$files = array_map(function($file) {
					return '/data/tmp/' . $_SESSION['logged_in_user'] . '/' . $file;
				}, array_filter($files, function($file) {
					if (is_file(ROOT . '../data/tmp/' . $_SESSION['logged_in_user'] . '/' . $file) && strstr($file, '.png'))
						return $file;
				}));


				echo json_encode(array_values($files));
			}
		}

		// http://php.net/manual/ru/function.imagecopymerge.php
		private function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {
			$cut = imagecreatetruecolor($src_w, $src_h); 

			imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 

			imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 

			imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
		}

		function photoMerge() {
			if (isset($_FILES['main']) && isset($_POST['superposable']))
			{
				switch($_FILES['main']['type']) {
					case 'image/gif':
						$newImage = imagecreatefromgif($_FILES['main']['tmp_name']);
						break;
					case 'image/jpg':
						$newImage = imagecreatefromjpeg($_FILES['main']['tmp_name']);
						break;
					case 'image/png':
						$newImage = imagecreatefrompng($_FILES['main']['tmp_name']);
						break;
				}

				list($srcWidth, $srcHeight) = getimagesize($_POST['superposable']);

				$superposable = imagecreatefrompng($_POST['superposable']);

				$this->imagecopymerge_alpha($newImage, $superposable, 0, 0, 0, 0, $srcWidth, $srcHeight, 100);

				$fileDir = '/data/tmp/' . $_SESSION['logged_in_user'];
				if (!file_exists(ROOT . '..' . $fileDir))
					mkdir(ROOT . '..' . $fileDir);

				$fi = glob(ROOT . '..' . $fileDir . "/*.*");
				$i = count($fi);
				$fileName = '/' . $i . '.png';

				imagepng($newImage, ROOT . '..' . $fileDir . $fileName);

				echo json_encode(['image' => $fileDir . $fileName]);
			}
		}

		function saveImage() {
			global $DB_USERS;
			global $DB_AVATARS;
			global $DB_PHOTOS;

			if (ModelAuth::isLoggedIn() && isset($_POST['image']) && isset($_POST['avatar']))
			{
				if ($_POST['avatar'] == 1)
				{
					if (DB::getRowData($DB_AVATARS, '*', 'uid', $_SESSION['logged_in_user']))
					{
						if (file_exists(ROOT . '..' . $_POST['image']))
							DB::updateRowData($DB_AVATARS, 'path', $_POST['image'], 'uid', $_SESSION['logged_in_user']);
					}
					else
						DB::insertRowData($DB_AVATARS, ['uid' => $_SESSION['logged_in_user'], 'avatar' => $_POST['image']]);
				}
				else
				{
					DB::insertRowData($DB_PHOTOS, ['uid' => $_SESSION['logged_in_user'], 'likes' => 0, 'comments' => 0, 'src' => $_POST['image']]);
				}
			}
		}
	}
?>