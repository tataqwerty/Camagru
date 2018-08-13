<?php
	session_start();

	ini_set('display_errors', 'on');
	define('ROOT', __DIR__ . '/');
	define('CHECK_LOGGED_IN', 1);
	define('CHECK_LOGGED_OUT', 2);
	$style_link = '/app/resources/styles/style.css';
	require ROOT . 'app/src/staff.php';
	require ROOT . 'app/config/database.php';
	require ROOT . 'app/src/core/db.php';
	require ROOT . 'app/src/router.php';

	router();
?>