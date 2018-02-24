<?php
	ini_set("session.cookie_httponly", 1);
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	header("X-Powered-By: PHP-fpm/5.6");	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysqli_fetch_array($res);
?>

<?php
function check_localhost($data)
{
  if($data==="::1" or $data==="127.0.0.1")
    {
    return "(localhost|127\.0\.0\.1)";
    }
  return $data;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LonelyBoy</title>
<link rel="stylesheet" href="/assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="/style.css" type="text/css" />
</head>
<body>
<style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

</style>
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="home.php">Home</a></li>
            <li><a href="upload.php">Upload</a></li>
            <li><a href="files.php">Files</a></li>
            <li class="active"><a href="send.php">Send to Tsu</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

	<div id="wrapper">

	<div class="container">
    	<div class="page-header">
    	<h1><font color='blue'>Send-Box</font></h1>
    	</div>
        <div class="row">
        <div class="col-lg-12">
        <center><img src="http://i.imgur.com/u2GbZY6.png" /></center>
	<form action="send.php" method="POST">
          <label for="url">Send me something good, thanks</label>
          <input type="text" id="url" name="url" placeholder="url here..">
          <input type="submit" value="Submit">
        </form>
        <?php

        if (isset($_POST['url']) && !empty($_POST['url']))
        {
          $server='localhost\:7001';
          $regex = "/((http|https)\:\/\/".$server."\/.*)/i";
          if (preg_match($regex,$_POST['url']))
          {
            if (!preg_match('/(;|&&|\||\$|%0d|%0a|`|})/i', urldecode($_POST['url']) ))
            {
            echo 'Woa... u care about me..... I\'m so happy <3, i\'ll read it!';
            $url=mysqli_real_escape_string($conn,$_POST['url']);
            $sql = "INSERT INTO saved_link (link) VALUES (\"$url\")";
            mysqli_query($conn, $sql);
            }
            else
            {
            echo 'What are u trying to do?';
            }
          }
          else
          {
            echo 'only url from my webiste is allowed (localhost:7001), don\'t made me sad more...';
          }

        }

        ?>
        </div>
        </div>
    
    </div>
    
    </div>
    
    <script src="/assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
