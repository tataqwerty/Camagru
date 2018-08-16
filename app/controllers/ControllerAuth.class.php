<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Core\View as View;
	use Models\ModelAuth as ModelAuth;

	class ControllerAuth extends Controller {
		function __construct() {
			$this->view = new View;
			$this->model = new ModelAuth;
		}

		function actionLoginCheck() {
			$this->model->login();
			\Helpers\redirect('/main/index');
		}

		function actionRegisterCheck() {
			$this->model->register();
			\Helpers\redirect('/main/index');
		}

		function actionPasswordReset() {

		}
	}
?>