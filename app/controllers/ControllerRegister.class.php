<?php
	if (ControllerUser::isLoggedIn())
		ControllerURI::redirect('/main/index');
	/*
	** Only logged-out users can go further.
	*/
	require ROOT . 'app/models/ModelRegister.class.php';

	class ControllerRegister extends Controller {
		function __construct() {
			$this->model = new ModelRegister;
		}

		function actionIndex() {
		}
	}
?>