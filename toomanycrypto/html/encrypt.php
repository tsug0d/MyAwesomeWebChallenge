<?php

include('./secret.php');

if(empty($_SESSION["form_token"]))
{
$gen_token=md5(uniqid(rand(), true));
$_SESSION["form_token"] = $gen_token;
//header("Refresh:0");
}

function tsu_super_encrypt0($c)
{
  return gzcompress($c,-1);
}

function tsu_super_encrypt1($c,$key)
{
    $l=strlen($key);
    $string="";
    for($i=0;$i<strlen($c);$i++)
    {
        $string[$i]=chr((ord($c[$i]) | ord($key[$i%$l])) & (256+~(ord($c[$i]) & ord($key[$i%$l])))%256);
    }
    return implode("",$string);
}

function tsu_super_encrypt2($c)
{
    $l=strlen($c);
    $string="";
    for($i=0;$i<$l;$i++)
    {
        $string[$i]=chr((ord($c[$i])+$i)%256);
    }
    return implode("",$string);
}

function tsu_super_encrypt3($c)
{
  $l=strlen($c);
  $k=$l%8;
  $string="";
  for($i=0;$i<$l;$i++)
  {
  $string[$i]=chr(((ord($c[$i])<<$k)|ord($c[$i])>>(8-$k))&0xff);
  }
  return implode("",$string);
}

?>
<html>



<?php


if(isset($_POST["enc"]) && strlen($_POST["enc"]) && isset($_POST["token"]))
{
  if($_SESSION["form_token"]===$_POST["token"])
  {
  unset($_SESSION['form_token']);
  $gen_token=md5(uniqid(rand(), true));
  $_SESSION["form_token"] = $gen_token;
  $enc=$_POST["enc"];
  $query="secret=".$secret_salt."string=".$enc;
  $encrypted0=tsu_super_encrypt0($query);
  $encrypted1=tsu_super_encrypt1($encrypted0,$key);
  $encrypted2=tsu_super_encrypt2($encrypted1);
  $encrypted3=tsu_super_encrypt3($encrypted2); //I'm too sleepy, i think i should stop here..., oyasuminasai...mm..mm..zz..
  $final=base64_encode($encrypted3);
  echo '<pre><font color="red">Hey onii-chan...Here is your crypt...</font><font color="blue">'.$final.'</font></pre>'; 
  
  }
}
?>

<font color="red">Please give me a message...onii-chan</font>
<form action="?page=encrypt" method="POST" id="usrform">
  <center>
  <textarea rows="6" placeholder="I’m here for whenever you need me" class="form-control" name="enc" form="usrform"></textarea>
  <input type="hidden" name="token" value=<?php echo $_SESSION["form_token"];?> />
  <input type="submit" id="contact-submit" class="btn btn-default btn-send" value="Encrypt">
  </center>
</form>




<br>
</html>