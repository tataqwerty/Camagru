<?php
	namespace Core;

	class DB {
		function connect() {
			global $DB_DSN;
			global $DB_USER;
			global $DB_PASSWORD;
			$options = [
				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
			];

			$db = new \PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
			return ($db);
		}

		function getUserByUsername($username) {
			$db = self::connect();
			$user = $db->query('SELECT * FROM camagru.users WHERE `username` = "' . $username . '"');

			if ($user)
				return ($user->fetch());
			return (null);
		}
	}
?>