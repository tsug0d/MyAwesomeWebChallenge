<?php
    ob_start();
    require_once('dbconnect.php');
    require_once('mapl_library.php');
    check_access();
    is_login();

    //setup config
    $configRow=config_connect($conn);
    $salt=$configRow['mapl_salt'];
    $key=$configRow['mapl_key'];

    //get information
    $mail=mysqli_real_escape_string($conn,decryptData($_SESSION['user'],$salt,$key));
    $character_name=mysqli_real_escape_string($conn,decryptData($_SESSION['character_name'],$salt,$key));
    $userRow=user_connect($conn,$mail);
    $admin=is_admin($salt);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="assets/image/logo.png" type="image/gif" sizes="16x16">
<title>Mapl Story</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<style type="text/css">* {cursor: url(assets/maplcursor.cur), auto !important;}</style>
<body background="assets/background.jpg" class="cenback">
	<nav class="navbar navbar-inverse navbar-fixed-top">
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
            <li class="active" id="menu"><a href="?page=home.php">Home</a></li>
            <li id="menu"><a href="?page=character.php">Character</a></li>
            <li id="menu"><a href="?page=setting.php">Setting</a></li>
            <li id="menu"><a href="?page=game.php">Game</a></li>
<?php
        if($admin===1)
        {
echo <<<EOT
        <li id="menu"><a href="?page=admin.php">Admin</a></li>
EOT;
}
?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo stripslashes(stripslashes(htmlentities($character_name))); ?>&nbsp;<span class="caret"></span></a>
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
    	<h1 id="pagetitle"><font color='blue'>HOME</font></h1>
    	</div>
        
        <div class="row">
        <div class="col-lg-12">
        <h2><font color="red" size="4">Welcome <?php echo stripslashes(stripslashes(htmlentities($character_name))); ?></font><h2>
        <h2><font color="green" size="4">This is the page that let you make your mapl story name and avatar<br> If it is good enough, you will win a cute pet!</font></h2>
        <h2><font size="4">Your last action: </font><br><font color="blue" size="4"><?php echo htmlentities($_SESSION['action']);?></font></h2>
        </div>
        </div>
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
