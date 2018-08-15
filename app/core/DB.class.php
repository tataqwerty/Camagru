<?php
	require ROOT . 'app/config/database.php';

	class DB {
		function connect() {
			global $DB_DSN;
			global $DB_USER;
			global $DB_PASSWORD;
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			];

			$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
			return ($db);
		}
	}
?>