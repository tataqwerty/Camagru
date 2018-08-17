<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Core\View as View;
	use Models\ModelUser as ModelUser;
	use Models\ModelPage as ModelPage;

	class ControllerUser extends Controller {
		function __construct() {
			$this->view = new View;
			$this->model = new ModelUser;
		}

		function actionLogout() {
			$this->model->logout();
			\Helpers\redirect('/main/index');
		}

		function actionLogin() {
			$this->model->login();
			\Helpers\redirect('/main/index');
		}

		/*
		** If registration process was successful then user wil be redirected to verification page, else to main ** page.
		*/
		function actionRegister() {
			$this->model->register();
			\Helpers\redirect('/main/index');
		}

		/*
		** This function verifies certain user by activationKey.
		*/
		function actionVerify($params) {
			$key = array_shift($params);
			$this->model->verify($key);
			\Helpers\redirect('/main/index');
		}

		/*
		** This function repeats send of activation key to certain email.
		*/
		function actionVerificationRepeat() {
			$this->model->sendVerificationKey();
			\Helpers\redirect('/main/index');
		}

		function actionPasswordReset() {
		}
	}
?>