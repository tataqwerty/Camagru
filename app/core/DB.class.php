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

		/*
		** This function selects data from table where $col = $needle
		*/
		function getDataWhereFrom($table, $select, $col, $needle) {
			$db = DB::connect();

			$query = $db->prepare("SELECT $select FROM $table WHERE $col = ?");
			$response = $query->execute([$needle]);

			if ($response)
				return ($response->fetchAll());
			return null;
		}

		function addUserToDB($email, $username, $password, $activationKey) {
			$db = DB::connect();
			$status = UNVERIFIED;

			$query = $db->prepare("Insert INTO camagru.users (`email`, `username`, `password`, `activationKey`, `status`) VALUES(?, ?, ?, ?, ?)");

			$query->execute([$email, $username, $password, $activationKey, $status]);
		}
	}
?>