<?php
	function db_connect() {
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

	function get_users() {
		$db = db_connect();

		$response = $db->query('SELECT * FROM camagru.users')->fetchAll();
		if ($response)
			return $response;
		else
			return [];
	}

	function add_user($email, $username, $password) {
		$db = db_connect();

		$db->query('INSERT INTO camagru.users (`email`, `username`, `password`) VALUES (\'' . $email . '\', \'' . $username .'\', \'' . $password . '\')');
	}
?>