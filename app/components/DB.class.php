<?php
	require_once ROOT . '/app/config/db_config.php';

	class DB {
		public static function connect() {
			$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			return ($db);
		}
	}
?>