#!/usr/bin/php
<?php
	require 'database.php';

	try {
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query_drop_db = 'DROP DATABASE IF EXISTS ' . $DB_NAME . ';';
		$query_create_db = 'CREATE DATABASE ' . $DB_NAME . ';';
		$query_create_table_users = 'CREATE TABLE ' . $DB_USERS . ' (
			`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`email` varchar(256) NOT NULL,
			`username` varchar(256) NOT NULL,
			`password` varchar(255) NOT NULL,
			`activationKey` char(32),
			`status` char(1)
		);';
		$query_create_table_avatars = 'CREATE TABLE ' . $DB_AVATARS . ' (
			`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`uid` int NOT NULL,
			`avatar` varchar(255) NULL
		);';
		$query_create_table_photos = 'CREATE TABLE ' . $DB_PHOTOS . ' (
			`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`uid` int NOT NULL,
			`likes` int NULL,
			`comments` int NULL,
			`src` varchar(255) NOT NULL
		);';
		$query_create_table_comments = 'CREATE TABLE ' . $DB_COMMENTS . ' (
			`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`uid` int NOT NULL,
			`id_photo` int NOT NULL
		);';

		$db->query($query_drop_db);
		$db->query($query_create_db);
		$db->query($query_create_table_users);
		$db->query($query_create_table_avatars);
		$db->query($query_create_table_photos);
		$db->query($query_create_table_comments);

		// Here i am going to add tables.

	} catch (PDOException $e) {
		echo 'Connection failed ' . $e->getMessage() . PHP_EOL;
	}
?>
