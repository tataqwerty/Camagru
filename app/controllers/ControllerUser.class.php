<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Core\View as View;
	use Models\ModelAuth as ModelAuth;
	use Models\ModelUser as ModelUser;

	class ControllerUser extends Controller {
		function __construct() {
			$this->view = new View;
			$this->model = new ModelUser;
		}

		function actionProfile($params) {
			$id = array_shift($params);
			$data = $this->model->getProfileData($id);
			$this->view->show('view_user_profile', $data);
		}

		function actionSettings() {
			if (!ModelAuth::isloggedIn())
			{
				\Helpers\redirect('/404/index');
				exit();
			}
			$data = $this->model->getSettingsData();
			$this->view->show('view_user_settings', $data);
		}

		function actionPhoto() {
			if (!ModelAuth::isloggedIn())
			{
				\Helpers\redirect('/404/index');
				exit();
			}
			$data = $this->model->getPhotoData();
			$this->view->show('view_user_photo', $data);
		}

		function actionPhotoMerge() {
			$this->model->photoMerge();
		}

		function actionGetSidebar() {
			$this->model->getSidebar();
		}

		function actionSaveImage() {
			$this->model->saveImage();
		}
	}
?>