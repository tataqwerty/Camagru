<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Core\View as View;
	use Models\ModelUser as ModelUser;
	use Models\ModelRegister as ModelRegister;

	if (ModelUser::isLoggedIn())
		\Helpers\redirect('/main/index');
	/*
	** Only logged-out users can go further.
	*/

	class ControllerRegister extends Controller {
		function __construct() {
			$this->view = new View;
			$this->model = new ModelRegister;
		}

		function actionIndex() {
			$data = $this->model->getIndexData();
			$this->view->show('view_register', $data);
		}
	}
?>