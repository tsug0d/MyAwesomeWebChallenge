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
<style> 
input[type=text] {
    width: 20%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid blue;
    border-radius: 4px;
}
input[type=submit] {
    width: 10%;
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
            <li class="active"><a href="home.php">Home</a></li>
            <li><a href="upload.php">Upload</a></li>
            <li><a href="files.php">Files</a></li>
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
    	<h1><font color='blue'>Dashboard</font></h1>
    	</div>
        
        <div class="row">
        <div class="col-lg-12">
        <h2><font color="red">Welcome <?php echo htmlentities($userRow['userName']); ?>, <?php if($userRow['is_admin']==="1"){echo "admin";} else{if($userRow['is_friend']==="0") {echo "my guest";} else {echo "my friend";};} ?>, i want to tell you something...</font><h2>
        <h3>"Tsu is so sad, he fails everything in his life, please <a href="send.php">give</a> him something fun to make him better!"</h3>
        <center><img src="http://i.imgur.com/lBlbLPW.png"></center>
	<?php
        if($userRow['is_admin']==="1")
        {
echo <<<EOT
        <br><br>
        <form action="home.php" method=GET>
        <label for="email">Make friend, please input email of the user you want to become friend!</label><br>
        <input type="text" id="email" name="email_address_of_tsu_friend"><br>
        <input type="submit" value="Submit">
        </form>
EOT;

	if (isset($_GET['email_address_of_tsu_friend']) && !empty($_GET['email_address_of_tsu_friend']))
	{
  		if (filter_var($_GET['email_address_of_tsu_friend'], FILTER_VALIDATE_EMAIL) === false) 
  		{
  		echo("Something wrong!");
  		} 
  		else 
  		{
  			$email=mysqli_real_escape_string($conn, $_GET['email_address_of_tsu_friend']);
  			$sql = "UPDATE users SET is_friend=1 WHERE userEmail=\"$email\"";
  			if (mysqli_query($conn, $sql)) 
    			{
    				echo "";
    			} 
  			else 
    			{
    			echo "Error updating record: " . mysqli_error($conn);
    			}
  		}
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
