<?php
	namespace Models;

	use Core\Model as Model;
	use Models\ModelPage as ModelPage;

	class ModelMain extends Model {
		function getIndexData() {
			$data = ModelPage::getInitPageData('Main page');
			return ($data);
		}
	}
?>