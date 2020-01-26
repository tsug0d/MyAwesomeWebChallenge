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
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LonelyBoy</title>
<link rel="stylesheet" href="/assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="/style.css" type="text/css" />
</head>
<body>

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
            <li class="active"><a href="files.php">Files</a></li>
            <li><a href="send.php">Send to Tsu</a></li>
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
    	<h1><font color='blue'>Your Uploaded Files</font></h1>
    	</div>
        
        <div class="row">
        <div class="col-lg-12">
	<center>** Files will be deleted short time after **</center> 
        <center><img src="http://i.imgur.com/CUkk9bT.png" /></center>
	<?php 
        $salt="MuchWowSoSecure1337";
        $email = $userRow['userEmail'];
        $folder=md5($salt.$email);
        $dir='./upload/'.$folder;
        if (is_dir($dir))
        {
          if ($dh = opendir($dir))
          {
          while (($file = readdir($dh)) !== false)
            {
              if ($file === "." or $file === ".." or $file === "index.php")
              {
                echo "";
              }
              else
              {
                echo "<strong><font size=3 color=red>Filename:  </font></strong><a href=\"".$dir."/".$file."\" target=\"_blank\" >".htmlentities($file)."</a><br>";
              }
            }
          closedir($dh);
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
