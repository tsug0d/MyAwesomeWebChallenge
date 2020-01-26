<?php
ob_start();
?>
<html>
<meta http-equiv=Content-Security-Policy content="default-src 'self'; style-src 'self'; img-src 'self'; script-src 'self';">
<link rel="stylesheet" type="text/css" href="assets/tsu.css">
<center>
	<h1 class="simple">Simple Message Storage Service</h1>
<form action="index.php" id="usrform" method="GET">
</form>
<textarea name="message" form="usrform"  rows="15" cols="70"></textarea><br><br>
<input class='new-button' type="submit" form="usrform" value="submit">
<?php

if(!isset($_COOKIE['Test_cookie']))
{
	setcookie('Test_cookie', 'tsutsutsu', time() + (86400 * 30), "/", false, false, 1);
}
//If admin
//setcookie('fl4g', 'xxxxxxxxxxxxxxxxx', time() + (86400 * 30), "/", false , false, 1);

if(isset($_GET['message']) && !empty($_GET['message']))
{
	if(strlen($_GET['message'])>150)
	{
		die('<br><br>Too Long :(</br>');
	}
	$filename = './message/'.uniqid().'.txt';
	file_put_contents($filename, $_GET['message']);
	echo "<br><br><strong>Your Message '". $_GET['message'] . "' is located <a href='$filename' target=_blank >here</a>, wanna share it with <a href='contact.php' target=_blank>me</a>?</strong>";
}

?>

<br><br>We implement many security solutions on this site, so no worries, you are safe by default even somebody hack you!<br>
- Here our Client-side protection info: <a href="clientinfo.php" target=_blank >Click here</a><br>
- Here our Server-side protection info: <a href="serverinfo.php" target=_blank >Click here</a><br>

</center>
</html>