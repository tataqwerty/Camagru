<?php
	namespace Core;

	class View {
		private $_title;
		private $_contentView;

		private function setTitle($title) {
			$this->_title = $title;
		}

		private function setContentView($contentView) {
			$this->_contentView = $contentView
		}

		function generate($title, $contentView) {
			$this->setTitle($title);
			$this->setContentView($contentView);
		}

		function show($params = null) {
			if (isset($params))
				extract($params);
			require ROOT . 'app/views/templates/template.php';
		}
	}
?>