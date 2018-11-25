<?php
    ob_start();
    require_once('dbconnect.php');
    require_once('mapl_library.php');
    check_access();

	if( isset($_SESSION['user'])!="" )
	{
		header("Location: ?page=home.php");
	}
	//setup config
    $configRow=config_connect($conn);
    $salt=$configRow['mapl_salt'];
    $key=$configRow['mapl_key'];
    
	$error = false;

	if (isset($_POST['btn-signup'])) 
	{
		$name = mysqli_real_escape_string($conn,$_POST['name']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$pass = mysqli_real_escape_string($conn,$_POST['pass']);

		if (empty($name)) 
		{
			$error = true;
			$nameError = "Please enter your character name.";
		} 
		else if (strlen($name)<3) 
		{
			$error = true;
			$nameError = "Character name must have at least 3 characters.";
		} 
		else if (strlen($name)>22)
		{
			$error = true;
			$nameError = "Character name limit to 22 chars";
		}
		else if (!preg_match("/^[a-zA-Z ]+$/",$name)) 
		{
			$error = true;
			$nameError = "Character name must contain alphabets and space.";
		}
		
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) 
		{
			$error = true;
			$emailError = "Please enter valid email address.";
		} 
		else 
		{
			// check email exist or not
			$query = "SELECT userEmail FROM users WHERE userEmail='$email'";
			$result = mysqli_query($conn,$query);
			$count = mysqli_num_rows($result);
			if($count!=0)
			{
				$error = true;
				$emailError = "Provided Email is already in use.";
			}
		}
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
		}
		
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		
		// if there's no error, continue to signup
		if( !$error ) {
			$folder=md5($salt.$email);
			mkdir('./upload/'.$folder);
			$waf = fopen('./upload/'.$folder."/index.php", "w") or die("Unable to open file!");
			
			$txt = <<<EOF
<?php echo 'Simple waf disabled directory listing, nothing here'; ?>
EOF;
			fwrite($waf, $txt);
			fclose($waf);
			$query = "INSERT INTO users(`userName`, `userEmail`, `userPass`, `userIsAdmin`, `userDesc`, `userAvatar`) VALUES('$name','$email','$password',0,' ','default.png')";
			$res = mysqli_query($conn,$query);
				
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";	
			}	
				
		}
		
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="assets/image/logo.png" type="image/gif" sizes="16x16">
<title>Mapl Story</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="assets/css/style.css" type="text/css" />
</head>
<style type="text/css">* {cursor: url(assets/maplcursor.cur), auto !important;}</style>
<body background="assets/background.jpg" class="cenback">

<div class="container">

	<div id="login-form">
    <form method="post" action="?page=register.php" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Sign Up.</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo htmlentities($name); ?>" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo htmlentities($email); ?>" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<a href="index.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>
