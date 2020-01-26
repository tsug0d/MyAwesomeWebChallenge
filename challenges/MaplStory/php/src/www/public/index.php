<?php

ini_set("display_errors", 0);
ini_set("session.cookie_httponly", 1);
session_start();
date_default_timezone_set("Asia/Bangkok");
define("check_access", "check");
include('die.php');

function bad_words($value)
{
	//My A.I TsuGo show me that when player using these words below they feel angry, so i decide to censor them.
	//Maybe some word is false positive but pls accept it, for a no-cancer gaming environment!
	$too_bad="/(fuck|bakayaro|ditme|bitch|caonima|idiot|bobo|tanga|pin|gago|tangina|\/\/|damn|noob|pro|nishigou|stupid|ass|\(.+\)|`.+`|vcl|cyka|dcm)/is";
	$value = preg_replace($too_bad, str_repeat("*",3) ,$value);
	return $value;
}

foreach($_GET as $key=>$value)
{
    if (is_array($value))
    {
    	mapl_die();
    }
	$value=bad_words($value);
	$_GET[$key]=$value;
}

foreach($_POST as $key2=>$value2)
{
    if (is_array($value2))
    {
    	mapl_die();
    }
	$value2=bad_words($value2);
	$_POST[$key2]=$value2;
}


if(isset($_GET['page']) && !empty($_GET['page']))
{
	include($_GET['page']);
}
else
{
	header("Location: ?page=login.php");
}

?>

<!-- All images/medias belongs to nexon, wizet -->
