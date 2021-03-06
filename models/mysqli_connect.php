<?php 
$debugMode = true;
# Script 9.2 - mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL, 
// selects the database, and sets the encoding.

// Set the database access information as constants:
if ($debugMode === false) {
	DEFINE ('DB_USER', 'qyq611');
	DEFINE ('DB_PASSWORD', 'BL4pk2Db');
	DEFINE ('DB_HOST', 'qyq611.santjosepobrer.com');
	DEFINE ('DB_NAME', 'qyq611');
} else {
	DEFINE ('DB_USER', 'root');
	DEFINE ('DB_PASSWORD', null);
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_NAME', 'sjo-jobexchange');
}

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Can\'t connect to the database: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');