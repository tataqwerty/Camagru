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

	function match_username($username) {
		$db = db_connect();

		$response = $db->query("SELECT `username` FROM camagru.users WHERE `username` = '" . $username . "'")->fetch();
		return (1);
	}

	function match_email($email) {
		$db = db_connect();

		$response = $db->query("SELECT `email` FROM camagru.users WHERE `email` = '" . $email . "'")->fetch();
		if ($response)
			return (0);
		return (1);	
	}

	function get_user_by_name($username) {
		$db = db_connect();

		$response = $db->query("SELECT * FROM camagru.users WHERE `username` = '" . $username . "'")->fetch();
		if ($response)
			return ($response);
		return (null);
	}

	function get_user_by_email($email) {
		$db = db_connect();

		$response = $db->query("SELECT * FROM camagru.users WHERE `email` = '" . $email . "'")->fetch();
		if ($response)
			return ($response);
		return (null);
	}

	function add_user_to_db($email, $username, $password) {
		$db = db_connect();

		$db->query("INSERT INTO camagru.users (`email`, `username`, `password`) VALUES ('" . $email . "', '" . $username ."', '" . $password . "')");
	}
?>