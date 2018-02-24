<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #32CD32;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 10px;
  width: 150px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}
.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}
.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}
.button:hover span {
  padding-right: 25px;
}
.button:hover span:after {
  opacity: 1;
  right: 0;
}
.button1 {
    background-color: white; 
    color: black; 
    border: 2px solid #4CAF50;
}
input[type=text] {
    width: 20%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid blue;
    border-radius: 4px;
}
p {
    border: 2px solid black;
    outline: #4CAF50 solid 10px;
    margin: auto;    
    padding: 20px;
    text-align: center;
}
</style>
<title>Free To Flag</title>
<br>
<p>
You don't have to be a rich man to buy flag because the flag is freeeeee!!!!!
<br>It costs <strong><font color=red>-0x1337$</font></strong> meaning that when you unlock it, we also give you 0x1337$ xD.
<br><strong>So try to unlock!</strong>
<br><img src="https://i.imgur.com/jS7oP7c.gif"/>
<br><br>
</p>
<br>
<form method="POST" action="index.php">
<input type=hidden name=money id=money value="1"><br>
<center><button class="button" type="submit" style="vertical-align:middle"><span>Unlock!!! </span></button></center>
</form>

<?php
include('secret.php');
?>

<?php
if(isset($_POST['money']) && !empty($_POST['money']))
{
	$money=$_POST['money'];
	if(ctype_digit($money))
	{
		if((int)($money+0x1337)===0)
		{
			die('<center>Money is just a number! flag > all. Here your flag: <br><font size=5 color=red><strong>'.$flag.'</strong></font></center>');
		}
		else
		{
			die("<strong><center>Sadly, We don't have enough money to give at this time :(</center></strong>");
		}
	}
	else
	{
		die('<strong><center>2k vinoy monkey?</center></strong>');
	}
}

if(isset($_GET['is_debug']) && !empty($_GET['is_debug']) && $_GET['is_debug']==="1")
{
	show_source(__FILE__);
}

?>
<!-- From tsu with l0v3: ?is_debug=1 -->