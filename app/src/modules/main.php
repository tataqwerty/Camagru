<?php
	check_auth('/login/index', CHECK_LOGGED_IN);

	function index() {
		$title = 'Main Page';
		$sidebar = 1;
		$content_view = 'view_main';
		require ROOT . 'app/views/templates/template_view.php';
	}
?>