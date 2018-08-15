<?php
	namespace Core;

	class View {
		function show($contentView, $data = null) {
			if (isset($data))
				extract($data);
			require ROOT . 'components/templates/template.php';
		}
	}
?>