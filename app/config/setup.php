#!/usr/bin/php
<?php
	require 'database.php';

	try {
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query_drop_db = 'DROP DATABASE IF EXISTS `camagru`;';
		$query_create_db = 'CREATE DATABASE `camagru`;';
		$query_create_table_users = 'CREATE TABLE camagru.users (
			`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`email` varchar(256) NOT NULL,
			`username` varchar(256) NOT NULL,
			`password` varchar(256) NOT NULL,
			`activationKey` char(32),
			`status` char(1)
		);';

		$db->query($query_drop_db);
		$db->query($query_create_db);
		$db->query($query_create_table_users);

		// Here i am going to add tables.

	} catch (PDOException $e) {
		echo 'Connection failed ' . $e->getMessage() . PHP_EOL;
	}
?>
