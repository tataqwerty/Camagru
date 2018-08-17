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

		function dataAllData($table, $needleCol) {
			$db = DB::connect();

			$query = $db->prepare("SELECT " . $needleCol . " FROM " . $table . ";");

			$response = $query->execute();
			if ($response)
				return ($query->fetchAll());
			return (null);
		}

		/*
		** This function gets just one row from table.
		**
		** $table - name of the table from which I want to get data
		** $col - name of column from which I want to get data
		** $keyCol - name of column where I will search $keyValue
		** $keyValue - value that I will search in $keyCol
		*/
		function getRowData($table, $needleCol, $keyCol, $keyValue) {
			$db = DB::connect();

			$query = $db->prepare("SELECT " . $needleCol . " FROM " . $table . " WHERE " . $keyCol . " = :keyValue;");
			
			$query->bindValue(':keyValue', $keyValue);

			$response = $query->execute();
			if ($response)
				return ($query->fetch());
			return (null);
		}

		/*
		** This function updates data in table in column.
		**
		** $table - name of the table in which I want to change data
		** $col - name of column in which I want to change value
		** $value - value that will be substituted instead
		** $keyCol - name of column where I will search $keyValue
		** $keyValue - value that I will search in $keyCol
		*/
		function updateRowData($table, $col, $value, $keyCol, $keyValue) {
			$db = DB::connect();

			$query = $db->prepare("UPDATE " . $table . " SET " . $col . " = :value WHERE " . $keyCol . " = :keyValue;");

			$query->bindValue(':value', $value);
			$query->bindValue(':keyValue', $keyValue);

			$query->execute();
		}

		/*
		** This function inserts in cols certain values.
		**
		** $table - name of the table in which I want to insert data
		** $arrValues - array in which keys are cols, and values are values.
		*/
		function insertRowData($table, $arrValues) {
			$db = DB::connect();
			$arrCols = [];

			foreach ($arrValues as $key => $value) {
				$arrCols[] = "`" . $key . "`";
			}
			$queryCols = implode(',', $arrCols);
			$queryValues = '?' . str_repeat(',?', count($arrValues) - 1);

			$query = $db->prepare("INSERT INTO ? (" . $queryCols . ") VALUES($queryValues);");
			$query->execute($arrValues);
		}
	}
?>