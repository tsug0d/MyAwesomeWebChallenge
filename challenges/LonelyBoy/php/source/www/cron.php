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
$res=mysqli_query($conn,"SELECT * FROM saved_link limit 1");
$saved_link=mysqli_fetch_array($res);
$id=$saved_link["id"];
$link=$saved_link["link"];
echo 'id: '.$id;
echo '<br>link: '.$link;

//phantomjs here
if (!empty($link))
{
	$cmd="phantomjs /var/www/something.js ".$link;
	system($cmd);
}

//then delete
mysqli_query($conn,"DELETE FROM saved_link WHERE id=$id");

/*
CREATE TABLE saved_link (
    id int NOT NULL AUTO_INCREMENT,
    link varchar(500) NOT NULL,
    PRIMARY KEY (id)
);
*/
?>
