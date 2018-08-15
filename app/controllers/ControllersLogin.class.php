<?php
	if (ControllerUser::isLoggedIn())
		ControllerURI::redirect('/main/index');
	/*
	** Only logged-out users can go further.
	*/
	require ROOT . 'app/models/ModelAuth.class.php';

	class ControllerLogin extends Controller {
		function __construct() {
			$this->model = new ModelAuth;
		}

		function actionIndex() {
		}
	}
?>