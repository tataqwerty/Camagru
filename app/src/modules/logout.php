<?php
	check_auth('/login/index', CHECK_LOGGED_IN);

	function index() {
		unset($_SESSION['logged_in_user']);
		redirect('/login/index');
	}
?>