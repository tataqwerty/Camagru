<?php
	namespace Models;

	use Core\Model as Model;
	use Models\ModelPage as ModelPage;

	class ModelRegister extends Model {
		function getIndexData() {
			$data = ModelPage::getInitPageData('Register Page');
			return ($data);
		}
	}
?>