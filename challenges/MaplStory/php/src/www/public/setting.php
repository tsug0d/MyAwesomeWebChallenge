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
            <li id="menu"><a href="?page=home.php">Home</a></li>
            <li id="menu"><a href="?page=character.php">Character</a></li>
            <li class="active" id="menu"><a href="?page=setting.php">Setting</a></li>
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
    	<h1 id="pagetitle"><font color='blue'>SETTING</font></h1>
    	</div>
        
        <div class="row">
        <div class="col-lg-12">
        <form action="?page=setting.php" method="POST">
            <h2><font color="black" size="4">Character Name</font><br>
            <input type="text" name="name" value="<?php echo stripslashes(stripslashes(htmlentities($character_name))); ?>" /></h2>
            <input type="submit" value="Edit" name="submit">
        </form>
<?php
if (isset($_POST['name']) && !empty($_POST['name']))
{
    if(strlen($_POST['name'])<=22)
    {
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $query="UPDATE users SET userName='$name' WHERE userEmail='$mail'";
    $res2=mysqli_query($conn,$query);
    $userRow2=mysqli_fetch_array($res2);
    $secure_name=encryptData($name,$salt,$key);
    $_SESSION['character_name'] = $secure_name;
    $log_content='['.date("h:i:sa").' GMT+7] Change character name';
    $_SESSION['action']=$log_content;
    header("Refresh:0");
    }
    else
    {
      echo '<font size=4 color="red">Character name too long, please choose another name</font>';
    }
}
?>
        <br><br>
        <form action="?page=setting.php" method="POST">
              <font color="black" size="4">Avatar</font><br><br>
              <img src="assets/image/default.png" height=150px width=150px /><input type="radio" name="avatar" value="default.png">
              <img src="assets/image/spearman.png" height=150px width=150px /><input type="radio" name="avatar" value="spearman.png">
              <img src="assets/image/thief.png" height=150px width=150px /><input type="radio" name="avatar" value="thief.png">
              <img src="assets/image/chubby.gif" height=150px width=150px /><input type="radio" name="avatar" value="chubby.gif">
              <img src="assets/image/logo.png" height=150px width=150px /><input type="radio" name="avatar" value="logo.png">
              <br>
              <img src="assets/image/npc_1.png" height=150px width=150px /><input type="radio" name="avatar" value="npc_1.png">
              <img src="assets/image/npc_2.gif" height=150px width=150px /><input type="radio" name="avatar" value="npc_2.gif">
              <img src="assets/image/npc_3.gif" height=150px width=150px /><input type="radio" name="avatar" value="npc_3.gif">
              <img src="assets/image/npc_4.gif" height=150px width=150px /><input type="radio" name="avatar" value="npc_4.gif">
              <img src="assets/image/npc_5.png" height=150px width=150px /><input type="radio" name="avatar" value="npc_5.png">
              <br>
              <input type="submit" value="Edit" name="submit">
              <br>
        </form>
        </div>
        </div>
<?php

if (isset($_POST['avatar']) && !empty($_POST['avatar']))
{
    $avatar=mysqli_real_escape_string($conn,$_POST['avatar']);
    $query="UPDATE users SET userAvatar='$avatar' WHERE userEmail='$mail'";
    $res2=mysqli_query($conn,$query);
    $userRow2=mysqli_fetch_array($res2);
    $log_content='['.date("h:i:sa").' GMT+7] change avatar';
    $_SESSION['action']=$log_content;
    header("Refresh:0");
}

?>
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
