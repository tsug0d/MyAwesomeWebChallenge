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

if(!isset($_SESSION['auth']) or $_SESSION['auth']!==hash('sha256', 'human'.$salt))
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
	if(!preg_match_all('/\W/is',$check))
	{
		if(strlen($check)>40)
		{
			echo "<h2 id=\"intro\" >Too long, we can only receive 40 letters for each message</h2>";
		}
		else
		{
		file_put_contents('human_message/'.$unique.'.'.$_POST['type'], $check);
		echo "<h2 id=\"intro\" >Saved in human_message/$unique.$type</h2>";
		}
	}
	else
	{
		echo "<h2 id=\"intro\" >Uh huh? Wut is this language?</h2>";
	}
}

?>

<h2 id="intro" class="neon">Its MesoRangers Time!!!! Please cheer us via your letter ^_^</h2>
<form action="omega_sector.php" method="POST">
<textarea class="shadow" id="main" name="message"></textarea>
<input type='text' name='type' value='human' hidden />
<button type="submit" id="button">Save</button>
</form>
<img src="assets/mesoranger.png" id="rangers" />
<body background="assets/omega_sector.jpg" class="cenback"></body>
<audio controls autoplay hidden>
  <source src="assets/omegasector.mp3" type="audio/mpeg">
</audio>
</html>
<?php ob_end_flush(); ?>