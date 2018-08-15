<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Core\View as View;
	use Models\ModelMain as ModelMain;

	class ControllerMain extends Controller {
		function __construct() {
			$this->view = new View;
			$this->model = new ModelMain;
		}

		function actionIndex() {
			$this->view->generate('Main Page', 'ViewMain');
		}
	}
?>