<?php
	session_start();

	ini_set('display_errors', 'on');
	define('ROOT', __DIR__ . '/');
	require ROOT . 'app/src/staff.php';
	require ROOT . 'app/config/database.php';
	require ROOT . 'app/src/core/db.php';
	require ROOT . 'app/src/router.php';

	router();
?>