<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Models\ModelMain as ModelMain;
	use Views\ViewMain as ViewMain;

	class ControllerMain extends Controller {
		function __construct() {
			$this->view = new ViewMain;
			$this->model = new ModelMain;
		}

		function actionIndex() {
			$data = $this->model->getIndexData();
			$this->view->show('main_view', $data);
		}
	}
?>