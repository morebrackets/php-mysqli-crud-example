<?php 
	// github.com/morebrackets/php-mysqli-crud-example
	// No Copyright. Public Domain. Do anything you want with this code.
	// This example code will get you started with the basics of PHP & MySQLi
	// Create your database, user, and access permissions in MySQL and then update the variables below

	$dbHost='127.0.0.1'; // this could also be localhost or a remore host/ip
	$dbName='YourDbName';
	$dbUser='YourDbUserName';
	$dbPass='YourDbPassword';

	// CONNECT
	$mysqli = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

	if (!$mysqli){ echo "Connection failed: " . mysqli_connect_error() . "<br>\n"; die();}

	// CREATE TABLE
	$result = mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS `".$dbName."`.`test` ( `id` int(16) NOT NULL AUTO_INCREMENT, `name` varchar(50) DEFAULT NULL,  PRIMARY KEY (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

	if (!$result){ echo "CREATE TABLE Error: " . mysqli_error($mysqli) . "<br>\n"; die();}


	// INSERT
	foreach (range(1, 10) as $number) {
		$rawName = (string)uniqid(); // Random string to represent a form value like $_POST['name']
		$name = mysqli_real_escape_string($mysqli, $rawName); // Escape it to prevent SQL Injection

		$result = mysqli_query($mysqli, "INSERT INTO `".$dbName."`.`test` (`name`) VALUES ('".$name."')");

		if (!$result){ echo "INSERT Error: " . mysqli_error($mysqli) . "<br>\n"; die();}
	}

	// UPDATE
	$result = mysqli_query($mysqli, "UPDATE `".$dbName."`.`test` SET `name` = 'Foo Bar' WHERE `id` = 2");

	if (!$result){ echo "UPDATE Error: " . mysqli_error($mysqli) . "<br>\n"; die();}


	// SELECT
	$result = mysqli_query($mysqli, "SELECT * FROM `".$dbName."`.`test` ORDER BY `id` DESC");

	if (!$result){ echo "SELECT Error: " . mysqli_error($mysqli) . "<br>\n"; die();}

	while($res = mysqli_fetch_array($result)) { 		
		echo "ID: " . $res['id'] . ", Name: " . $res['name'] . "<br>\n";
	}

	// DELETE
	$result = mysqli_query($mysqli, "DELETE FROM `".$dbName."`.`test` WHERE id < 200000");

	if (!$result){ echo "DELETE Error: " . mysqli_error($mysqli) . "<br>\n"; die();}


	// DROP TABLE
	$result = mysqli_query($mysqli, "DROP TABLE `".$dbName."`.`test`");

	if (!$result){ echo "DROP TABLE Error: " . mysqli_error($mysqli) . "<br>\n"; die();}

?>
