<?php
	namespace Models;

	use Core\Model as Model;
	use Models\ModelPage as ModelPage;

	class ModelLogin extends Model {
		function getIndexData() {
			$data = ModelPage::getInitPageData('Login Page');
			return ($data);
		}
	}
?>