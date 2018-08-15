<?php
	namespace Views;

	use Core\View as View;

	class ViewMain extends View {
		function dataToHTML($data) {
			$data['menu'] = $this->menuToHTML($data['menu']);
			return ($data);
		}
	}
?>