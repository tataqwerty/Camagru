<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Models\ModelUser as ModelUser;
	use Models\ModelAuth as ModelAuth;

	if (ModelUser::isLoggedIn())
		Helpers\redirect('/main/index');
	/*
	** Only logged-out users can go further.
	*/

	class ControllerRegister extends Controller {
		function __construct() {
			$this->model = new ModelAuth;
		}

		function actionIndex() {
		}
	}
?>