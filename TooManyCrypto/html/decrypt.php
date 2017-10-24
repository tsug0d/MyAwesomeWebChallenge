
<?php

include('./secret.php');

if(empty($_SESSION["form_token"]))
{
$gen_token=md5(uniqid(rand(), true));
$_SESSION["form_token"] = $gen_token;
//header("Refresh:0");
}

if(isset($_POST["dec"]) && isset($_POST["token"]))
{
    if($_SESSION["form_token"]===$_POST["token"])
    {
        unset($_SESSION['form_token']);
        $gen_token=md5(uniqid(rand(), true));
        $_SESSION["form_token"] = $gen_token;
        if(base64_decode($_POST["dec"]))
        {
        $final=$_POST['dec'];
        $decrypted3=base64_decode($final);
        $decrypted2=tsu_super_decrypt3($decrypted3);
        $decrypted1=tsu_super_decrypt2($decrypted2);
        $decrypted0=tsu_super_decrypt1($decrypted1,$key);
            if(tsu_super_decrypt0($decrypted0))
            {
            $plaintext=tsu_super_decrypt0($decrypted0);
            echo '<pre><font color="red">Your message....here...baka: </font><font color="blue">'.htmlentities(substr($plaintext,73)).'</font></pre>';
            }
            else
            {
            echo '<pre><font color="red">Onii-chan!!! I Cannot Decrypt It!</font></pre>';
            }
        }
        else
        {
            echo '<pre><font color="red">Hey Onii-chan, Wrong Input! Base64 Only Baka-desu</font></pre>';
        }
    }
}


?>

<font color="red">Please give me your crypt...onii-chan</font>
<form action="?page=decrypt" method="POST" id="usrform">
  <center>
  <textarea rows="6" placeholder="Just type something...baka..." class="form-control" name="dec" form="usrform"></textarea>
  <input type="submit" id="contact-submit" class="btn btn-default btn-send" value="Decrypt">
  <input type="hidden" name="token" value=<?php echo $_SESSION["form_token"];?> />
  </center>
</form>