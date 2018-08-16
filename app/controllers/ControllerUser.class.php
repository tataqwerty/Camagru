<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Core\View as View;
	use Models\ModelUser as ModelUser;

	class ControllerUser extends Controller {
		function __construct() {
			$this->view = new View;
			$this->model = new ModelUser;
		}

		function actionLogin() {
			$this->model->login();
			\Helpers\redirect('/main/index');
		}

		function actionRegister() {
			$this->model->register();
			\Helpers\redirect('/main/index');
		}

		function actionPasswordReset() {
		}
	}
?>