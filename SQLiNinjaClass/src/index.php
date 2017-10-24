<html>
<body background="background.jpg">
<br>
<style>
div.transbox {
  margin: 30px;
  background-color: #ffffff;
  border: 1px solid black;
  opacity: 0.2;
  filter: alpha(opacity=60); /* For IE8 and earlier */
}

div.transbox p {
  margin: 5%;
  font-weight: bold;
  color: #000000;
}
</style>
<style>
h1,h2{
  text-align:center;
}
h1{
  color:rgba(100, 50, 255, .8);
}
.rainbow {
   /* Chrome, Safari, Opera */
  -webkit-animation: rainbow 1s infinite; 
  
  /* Internet Explorer */
  -ms-animation: rainbow 1s infinite;
  
  /* Standar Syntax */
  animation: rainbow 1s infinite; 
}

/* Chrome, Safari, Opera */
@-webkit-keyframes rainbow{
	20%{color: red;}
	40%{color: yellow;}
	60%{color: green;}
	80%{color: blue;}
	100%{color: orange;}	
}
/* Internet Explorer */
@-ms-keyframes rainbow{
	20%{color: red;}
	40%{color: yellow;}
	60%{color: green;}
	80%{color: blue;}
	100%{color: orange;}	
}

/* Standar Syntax */
@keyframes rainbow{
	20%{color: red;}
	40%{color: yellow;}
	60%{color: green;}
	80%{color: blue;}
	100%{color: orange;}	
}
</style>
<center><h1 class="rainbow">💉 SQLi Ninja Class 🗡</h1></center>
<center><font color='white'>Today sensei will teach you how to use comment in SQL Query. The comment is used to break a Sql query, so all the things after the comment become meaningless, there are 3 comment symbols: "#", "-- " and "/* */". Moreover, Ill show you a special technique!!! ";%00"</font></center><br><br>
<?php
function no_malicious($query)
{
	$regex="/(or|>|<|mid|sub|pad|sleep|mark|if|case|when|reg|like|sound|into|produce|is|count|=|\+|-|,|\/|\\\|\|exp|extract|xml|floor|rand|\||!|file|~)/i";
	$regex2="/[0-9a-zA-Z]+\(/i";
	if(preg_match($regex,$query) || preg_match($regex2,$query))
	{
		die('<h2 class="rainbow">Ninja Need NoThinG!</h2>');
	}
	return $query;
}
?>
<?php
	//author: tsug0d
	//challenge name: SQLi Ninja Class
	//goal: get flag in database!
	require_once 'dbconnect.php';
	error_reporting(0);

	//Ninja needs n0th1ng~~~
	$q1=addslashes($_GET['query1']);
	$q2=addslashes($_GET['query2']);
	$q3=addslashes($_GET['query3']);
	$q4=addslashes($_GET['query4']);
	$q1=no_malicious($q1);
	$q2=no_malicious($q2);
	$q3=no_malicious($q3);
	$q4=no_malicious($q4);

	// the # course!
	$query="SELECT 1 from dual#".$q1;
	echo "<center><font size=5 color='yellow'>Practice with #</font></center>";
	echo "<div class=\"transbox\">";
	echo "<center><strong>{$query}</strong></center>"; 
	echo "</div>";
	$res=mysqli_query($conn,$query);
	$userRow=mysqli_fetch_array($res);
	if($userRow)
	{
		echo '<font color="red">Success</font><br>';
	}


	// the --  course!
	$query2="SELECT 2 from dual-- ".$q2;
	echo "<center><font size=5 color='yellow'>Practice with -- </font></center>";
	echo "<div class=\"transbox\">";
	echo "<center><strong>{$query2}</strong></center>"; 
	echo "</div>";
	$res2=mysqli_query($conn,$query2);
	$userRow2=mysqli_fetch_array($res2);
	if($userRow2)
	{
		echo '<font color="red">Success</font><br>';
	}


	// the /* */ course!
	$query3="SELECT 3 from dual/*".$q3."*/";
	echo "<center><font size=5 color='yellow'>Practice with /* */</font></center>";
	echo "<div class=\"transbox\">";
	echo "<center><strong>{$query3}</strong></center>"; 
	echo "</div>";
	$res3=mysqli_query($conn,$query3);
	$userRow3=mysqli_fetch_array($res3);
	if($userRow3)
	{
		echo '<font color="red">Success</font><br>';
	}


	// the special ;%00 course!
	echo "<center><font size=5 color='yellow'>Special Technique ;%00</font></center>";
	$query4="SELECT 4 from dual;\x00"."%00".$q4;
	echo "<div class=\"transbox\">";
	echo "<center><strong>{$query4}</strong></center>"; 
	echo "</div>";
	$res4=mysqli_query($conn,$query4);
	$userRow4=mysqli_fetch_array($res4);
	if($userRow4)
	{
		echo '<font color="red">Success</font><br>';
	}

?>

<!-- Debug ?is_debug=1 -->
<?php

if (isset($_GET['is_debug']) && !empty($_GET['is_debug']) && $_GET['is_debug']==='1')
{
	show_source(__FILE__);
}

?>


</body>
</html>