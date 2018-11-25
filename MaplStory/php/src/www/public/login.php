<?php
    ob_start();
    require_once('dbconnect.php');
    require_once('mapl_library.php');
    check_access();

	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['user'])!="" ) 
	{
		header("Location: ?page=home.php");
		exit;
	}
    //setup config
    $configRow=config_connect($conn);
    $salt=$configRow['mapl_salt'];
    $key=$configRow['mapl_key'];
    
	$error = false;
	
	if(isset($_POST['btn-login']) ) 
	{	
		// prevent sql injections/ clear user invalid inputs
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		// prevent sql injections / clear user invalid inputs
		$pass = mysqli_real_escape_string($conn,$_POST['pass']);
		
		if(empty($email))
		{
			$error = true;
			$emailError = "Please enter your email address.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		}
		
		if(empty($pass))
		{
			$error = true;
			$passError = "Please enter your password.";
		}
		
		// if there's no error, continue to login
		if (!$error) 
		{
			$password = hash('sha256', $pass); // password hashing using SHA256
		
			$res=mysqli_query($conn,"SELECT * FROM users WHERE userEmail='$email'");
			$row=mysqli_fetch_array($res);
			$count = mysqli_num_rows($res); 
			
			if( $count === 1 && $row['userPass']===$password ) 
			{
				$secure_email=encryptData($row['userEmail'],$salt,$key);
				$secure_name=encryptData($row['userName'],$salt,$key);
				$log_content='['.date("h:i:sa").' GMT+7] Logged In';
				$_SESSION['character_name'] = $secure_name;
				$_SESSION['user'] = $secure_email;
    			$_SESSION['action']=$log_content;
				if ($row['userIsAdmin']==='1')
				{
					$data='admin'.$salt;
					$role=hash('sha256', $data);
					setcookie('_role',$role);
				}
				else
				{
					$data='user'.$salt;
					$role=hash('sha256', $data);
					setcookie('_role',$role);					
				}
				header("Location: ?page=home.php");
			} 
			else 
			{
				$errMSG = "Incorrect Credentials, Try again...";
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
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<style type="text/css">* {cursor: url(assets/maplcursor.cur), auto !important;}</style>
<body background="assets/background.jpg" class="cenback">

<div class="container">

	<div id="login-form">
    <form method="post" action="?page=login.php" autocomplete="off" id="login_form">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Sign In.</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo htmlentities($errMSG); ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo htmlentities($emailError); ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo htmlentities($passError); ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<a href="?page=register.php">Sign Up Here...</a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>
