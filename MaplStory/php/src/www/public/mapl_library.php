<?php
    function check_access()
    {
        if (!defined('check_access')) 
        {
        mapl_die();
        }
    }

    function is_login()
    {
        if(!isset($_SESSION['user'])) 
        {
            header("Location: ?page=login.php");
            exit;
        }
    }
    function config_connect($conn)
    {
        $config=mysqli_query($conn,"SELECT * FROM mapl_config");
        return mysqli_fetch_array($config);
    }

    function user_connect($conn,$mail)
    {
        $mail=mysqli_real_escape_string($conn,$mail);
        $user=mysqli_query($conn,"SELECT * FROM users WHERE userEmail='".$mail."'");
        return mysqli_fetch_array($user);
    }

    function is_admin($salt)
    {
        if(isset($_COOKIE['_role']) && !empty($_COOKIE['_role']) && $_COOKIE['_role']===hash('sha256', 'admin'.$salt))
        {
            return 1;
        }
            return 0;
    }

    function encryptData($data,$salt,$key)
    {
            $encrypt=openssl_encrypt($data.$salt,"AES-128-ECB",$key);
            $raw=base64_decode($encrypt);
            $final=implode(unpack("H*", $raw));
            return $final;
    }

    function decryptData($data,$salt,$key)
    {
            $raw=pack("H*", $data);
            $encrypt=base64_encode($raw);
            $decrypt=openssl_decrypt($encrypt,"AES-128-ECB",$key);
            return substr($decrypt,0,-strlen($salt));
    }
    
    function search_name_by_mail($conn,$mail)
    {
        $mail=mysqli_real_escape_string($conn,$mail);
        $res=mysqli_query($conn,"SELECT userName FROM users WHERE userEmail='".$mail."'");
        $userRow=mysqli_fetch_array($res);
        if($userRow['userName'])
        {
            return $userRow['userName'];
        }
        else
        {
            return '[Not Exists Player]';
        }
    }

    function check_available_pet($pet)
    {
        $available_pet=array("babydragon","blackpig","brownkitty","brownpuppy","goldenpig","husky","jrbalrog","jrreaper","minikargo","panda","penguin","rudolph");
        if(in_array($pet, $available_pet,TRUE))
        {
            return True;
        }
        return False;
    }

    function give_pet($dir,$pet)
    {   
        if(check_available_pet($pet))
        {
        copy('assets/image/pet/'.$pet.'.png', $dir.$pet.'.png');
        echo 'success';
        }
    }

    function list_pet($email,$salt)
    {
        $dir='./upload/'.md5($salt.$email);
        if (is_dir($dir))
        {
              if ($dh = opendir($dir))
              {
                while (($file = readdir($dh)) !== false)
                {
                  if ($file === "." or $file === ".." or $file === "index.php" or $file === "command.txt")
                  {
                    echo "";
                  }
                  else
                  {
                    $image=$dir.'/'.$file;
                    echo "<img src='$image'/> ";
                  }
                }
              closedir($dh);
              }
        }
    }

    function check_pet($email,$salt)
    {
        $dir='./upload/'.md5($salt.$email);
        if (is_dir($dir))
        {
            if ($dh = opendir($dir))
            {
              while (($file = readdir($dh)) !== false)
              {
                if(substr($file,-4)===".png")
                {
                return true;
                }
              }
              return false;
            }
        }
    }

    function check_file_content($email,$salt)
    {
        $dir='./upload/'.md5($salt.$email);
        if (is_dir($dir))
        {
            if ($dh = opendir($dir))
            {
              while (($file = readdir($dh)) !== false)
              {
                if($file==="command.txt")
                {
                return true;
                }
              }
              return false;
            }
        }
    }

    function get_command($email,$salt)
    {
        $dir='./upload/'.md5($salt.$email);
        if (is_dir($dir))
        {
            if ($dh = opendir($dir))
            {
              while (($file = readdir($dh)) !== false)
              {
                if($file==="command.txt")
                {
                return file_get_contents($dir.'/'.$file);
                }
              }
              return false;
            }
        }
    }

    function save_command($email,$salt,$data)
    {
        $dir='./upload/'.md5($salt.$email);
        file_put_contents($dir.'/command.txt', $data);
    }



?>
