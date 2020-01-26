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
    if($admin===0)
    {
        mapl_die();
    }
    $log_content='['.date("h:i:sa").' GMT+7] Access Hidden Street!';
    $_SESSION['action']=$log_content;
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
            <li id="menu"><a href="?page=home.php">Home</a></li>
            <li id="menu"><a href="?page=character.php">Character</a></li>
            <li id="menu"><a href="?page=setting.php">Setting</a></li>
            <li id="menu"><a href="?page=game.php">Game</a></li>
<?php
        if($admin===1)
        {
echo <<<EOT
        <li class="active" id="menu"><a href="?page=admin.php">Admin</a></li>
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
    	<h1 id="pagetitle"><font color='blue'>HIDDEN STREET</font></h1>
    	</div>
        
        <div class="row">
        <div class="col-lg-12">
        <h2><font color="red" size="4">Welcome <?php echo stripslashes(stripslashes(htmlentities($character_name))); ?><?php if($admin===1){echo ", admin";} ; ?></font><h2>
        <h2><font color="green" size="4">Today is <?php echo date("Y-m-d"); ?>, It is <?php echo date("h:i:sa"); ?> GMT+7</font></h2>
        <br><h2>Give Pet</h2>
        <br>
        <form action="?page=admin.php" method="POST">
            <img src="assets/image/pet/babydragon.png" /> <input type="radio" name="pet" value="babydragon">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/blackpig.png" /> <input type="radio" name="pet" value="blackpig">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/brownkitty.png" /> <input type="radio" name="pet" value="brownkitty">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/brownpuppy.png" /> <input type="radio" name="pet" value="brownpuppy">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/goldenpig.png" /> <input type="radio" name="pet" value="goldenpig">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/husky.png" /> <input type="radio" name="pet" value="husky">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/jrbalrog.png" /> <input type="radio" name="pet" value="jrbalrog">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/jrreaper.png" /> <input type="radio" name="pet" value="jrreaper">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/minikargo.png" /> <input type="radio" name="pet" value="minikargo">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/panda.png" /> <input type="radio" name="pet" value="panda">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/penguin.png" /> <input type="radio" name="pet" value="penguin">&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="assets/image/pet/rudolph.png" /> <input type="radio" name="pet" value="rudolph">&nbsp;&nbsp;&nbsp;&nbsp;
            <br><h2>To (email)</h2>
            <input type="text" name="email" value="" /></h2>
            <br><br>
            <input type="submit" value="Give" name="submit">
        </form>
        </div>
        </div>

    <?php
    if ( isset($_POST['pet']) && !empty($_POST['pet']) && isset($_POST['email']) && !empty($_POST['email']) )
    {
        $dir='./upload/'.md5($salt.$_POST['email']).'/';
        give_pet($dir,$_POST['pet']);
        if(check_available_pet($_POST['pet']))
        {
                $log_content='['.date("h:i:sa").' GMT+7] gave '.$_POST['pet'].' to player '.search_name_by_mail($conn,$_POST['email']);
                $_SESSION['action']=$log_content;
        }
    }

    ?>
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
