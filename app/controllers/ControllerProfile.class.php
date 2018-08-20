<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Core\View as View;
	use Models\ModelProfile as Profile;
	use Models\ModelUser as User;

	class ControllerProfile extends Controller {
		function __construct() {
			$this->view = new View;
			$this->model = new Profile;

			if (!User::isloggedIn())
			{
				\Helpers\redirect('/404/index');
				exit();
			}
		}

		function actionIndex() {
			$data = $this->model->getIndexData();
			$this->view->show('view_profile_index', $data);
		}

		function actionSettings() {
			$data = $this->model->getSettingsData();
			$this->view->show('view_profile_settings', $data);
		}

		function actionPhoto() {
			$data = $this->model->getPhotoData();
			$this->view->show('view_profile_photo', $data);
		}
	}
?>