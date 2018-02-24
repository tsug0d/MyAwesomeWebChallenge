<?php

	ini_set('error_reporting', 0);
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

input[type=submit] {
    width: 20%;
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

input[type=file] {
    width: 20%;
    background-color: #77aaff;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
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
            <li class="active"><a href="upload.php">Upload</a></li>
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
    	<h1><font color='blue'>Upload</font></h1>
    	</div>
        <div class="row">
        <div class="col-lg-12">
        <h2> Image Section </h2>
        <?php
        $salt="MuchWowSoSecure1337";
        $email = $userRow['userEmail'];
        $folder=md5($salt.$email);
        $target_dir = "upload/".$folder."/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) 
        {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false or $imageFileType==='svg') 
          {
            echo "File is an image " . $check["mime"] . ".";
            $uploadOk = 1;
          } 
          else 
          {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }
// Check if file already exists
        if (file_exists($target_file)) 
        {
          echo "";
          $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 100000) 
        {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }
// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "svg") 
        {
          echo "Only JPG, JPEG, SVG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) 
        {
          echo "";
// if everything is ok, try to upload file
        } 
        else 
        {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
          {
            echo "The file has been uploaded.";
          } 
          else 
          {
            echo "Sorry, there was an error uploading your file.";
          }
        }
      ?>
      <form action="upload.php" method="post" enctype="multipart/form-data">
      Select file to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload Image" name="submit">
      </form>
        </div>
        </div>
    
    <?php
    if ($userRow['is_friend']==="1")
    {
echo <<<EOT
      <h2>Everything Section (Friend Only)</h2>
      <form action="upload.php" method="post" enctype="multipart/form-data">
      Select file to upload:
      <input type="file" name="fileToUpload2" id="fileToUpload2">
      <input type="submit" value="Upload" name="submit2">
      </form>
EOT;
    $salt="MuchWowSoSecure1337";
    $email = $userRow['userEmail'];
    $folder=md5($salt.$email);
    $target_dir = "upload/".$folder."/";
    $target_file = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if(isset($_POST["submit2"])) 
      {
	$fileContent = file_get_contents($_FILES["fileToUpload2"]["tmp_name"]);
        $regex2="/(php|php5|php1|php2|php3|php4|php6|php7|php8|php9|phtml|phtm|html|htm|phps|shtml|pht)/i";
	$regex3="/\.ht.*/i";
	$regex4="/(escapeshellarg|escapeshellcmd|exec|passthru|proc_close|proc_get_status|proc_nice|proc_open|proc_terminate|shell_exec|`|system|include|require|eval|assert|readfile|scandir)/i";
        if(preg_match_all($regex2,$imageFileType) || preg_match_all($regex3,$_FILES["fileToUpload2"]["name"])) 
        {
	  echo "All .ht, .php, and .html family is Not Allowed! Note that its not racist...";
          $uploadOk = 0;
        }

        if(preg_match_all($regex4,$fileContent))
        {
          echo "Malicious!";
          $uploadOk = 0;
        }
	
	if($_FILES["fileToUpload2"]["size"]>20)
        {
          echo 'Too large, you are liar!!!! My friend only send me letter less than 20 chars!!!!';
          $uploadOk = 0;
        }

        if ($uploadOk == 0) 
        {
          echo "";
// if everything is ok, try to upload file
        } 
        else 
        {
          if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) 
          {
            echo "The file has been uploaded.";
          } 
          else 
          {
            echo "Sorry, there was an error uploading your file.";
          }
        }
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
