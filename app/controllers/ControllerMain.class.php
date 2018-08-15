<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Models\ModelMain as ModelMain;
	use Core\View as View;

	class ControllerMain extends Controller {
		function __construct() {
			$this->view = new View;
			$this->model = new ModelMain;
		}

		function actionIndex() {
			$data = $this->model->getIndexData();
			$this->view->show('view_main', $data);
		}
	}
?>