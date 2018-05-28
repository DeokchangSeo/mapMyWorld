<?php
/* Read Host, UserID, Password and UserDB */
require "mysql.php";

/* Open connection and select database. */
function get_db() {

	$conn = "mysql:host=".HOST.";dbname=".DATABASE;

	try {
		$db = new PDO($conn, USER, PASSWORD);
		$db->exec("set names utf8");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $db;
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
}
?>