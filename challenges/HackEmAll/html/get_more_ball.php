<?php
session_start();
ob_start();

echo 'Your IP: '.$_SERVER["REMOTE_ADDR"].'<br>';
if (!isset($_SESSION['poke_ball']) or !isset($_SESSION['master_ball']))
{
	die('Are you a trainer?');
}

if (isset($_POST['ball']) && $_POST['ball'] === "master_ball")
{
		if($_SERVER["REMOTE_ADDR"]==="127.0.0.1" or $_SERVER["REMOTE_ADDR"]==="::1")
		{
			$_SESSION['master_ball'] += 1; 
		}
		else
		{
			die('No ball for you!!!'); 
		}
}
elseif (isset($_POST['ball']) && $_POST['ball'] === "poke_ball")
{
	$_SESSION['poke_ball'] += 1; 
}
else
{
	show_source(__FILE__);
}

?>
