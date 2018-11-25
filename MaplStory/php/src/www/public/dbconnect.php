<?php
	define('DBHOST', 'mysqlserver');
	define('DBUSER', 'root');
	define('DBPASS', 'tsu_tsu_tsu_tsu'); 
	define('DBNAME', 'mapl_story');
	
	$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
	
	
	if ( !$conn ) {
		die("Connection failed : " . mysql_error());
	}
	
