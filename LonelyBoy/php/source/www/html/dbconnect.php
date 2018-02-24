<?php
	ini_set("session.cookie_httponly", 1);
	// this will avoid mysql_connect() deprecation error.
	//error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	//ini_set("display_errors", 1);
	// but I strongly suggest you to use PDO or MySQLi.
	
	define('DBHOST', 'mysql');
	define('DBUSER', 'root');
	define('DBPASS', '111111');
	define('DBNAME', 'lonelyboy');
	
	$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
	
	
	if ( !$conn ) {
		die("Connection failed : " . mysql_error());
	}
	
