<?php
ob_start();
session_start();
?>
<html>
<style type="text/css">* {cursor: url(assets/maplcursor.cur), auto !important;}</style>
<head>
  <link rel="stylesheet" href="assets/omega_sector.css">
  <link rel="stylesheet" href="assets/tsu_effect.css">
</head>

<?php


ini_set("display_errors", 0);
include('secret.php');

if(!isset($_SESSION['auth']) or $_SESSION['auth']!==hash('sha256', 'alien'.$salt))
{
	mapl_die();
}

?>

<?php

if(isset($_POST['message']) and !empty($_POST['message']) and isset($_POST['type']) and !empty($_POST['type']))
{
	$unique=md5(uniqid(rand(), true));
	$type=$_POST['type'];
	if(is_array($_POST['message']))
	{
		$check=implode('',$_POST['message']);
	}
	else
	{
	$check=$_POST['message'];
	}	
	if(!preg_match_all('/[a-z0-9]/is',$check))
	{
		if(strlen($check)>40)
		{
			echo "<h2 id=\"intro\" class=\"alien_language\">Signal OVERLOAD!!!!! only 40 o e i e</h2>";
		}
		else
		{
		file_put_contents('alien_message/'.$unique.'.'.$_POST['type'], $check);
		echo "<h2 id=\"intro\" class=\"alien_language\">Saved in alien_message/$unique.$type</h2>";
		}
	}
	else
	{
		echo "<h2 id=\"intro\" class=\"alien_language\">Uh huh? Wut is this language?</h2>";
	}
}

?>
<div class="alien_language">
<h2 id="intro" class="neon">Looks like the aliens aren't here, so please leave the message, they will come later.</h2>
</div>
<form action="alien_sector.php" method="POST">
<textarea class="shadow" id="main" name="message"></textarea>
<input type='text' name='type' value='alien' hidden />
<button type="submit" id="button"><div class="alien_language">Save</div></button>
</form>
<body background="assets/alien_sector.jpg" class="cenback"></body>
<audio controls autoplay hidden>
  <source src="assets/omegasector.mp3" type="audio/mpeg">
</audio>
</html>
<?php ob_end_flush(); ?>