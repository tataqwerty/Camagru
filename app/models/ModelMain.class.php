<?php
	namespace Models;

	use Core\Model as Model;
	use Models\ModelPage as ModelPage;

	class ModelMain extends Model {
		function getIndexData() {
			$data = [];
			$data['menu'] = ModelPage::getMenu();
			$data['title'] = 'Main Page';
			return ($data);
		}
	}
?>