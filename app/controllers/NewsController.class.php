<?php
	require_once ROOT . '/app/models/NewsModel.class.php';

	class NewsController {
		public function actionIndex($params) {
			echo "NewsController actionIndex";
		}

		public function actionView($category, $id) {
			echo "NewsController actionView";
		}
	}
?>