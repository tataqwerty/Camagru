<?php
	namespace Controllers;

	use Core\Controller as Controller;

	class Controller404 extends Controller {
		function actionIndex() {
			echo '404 Page Not Found';
			exit();
		}
	}
?>