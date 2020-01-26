<body>
<style>
input[type=text] {
    width: 40%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid red;
    background-color: #ebfff8;
    border-radius: 4px;
}

button[type=submit] {
    width: 10%;
    background-color: #F94848;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type=submit]:hover {
    background-color: #45a049;
}

body {
    background-image: url("money.jpg");
}
</style>

<?php
class Object 
{ 
  var $jackpot;
  var $enter; 
}
?>


<?php

include('secret.php');

if(isset($_GET['input']))  
{
  $obj = unserialize(base64_decode($_GET['input']));
  if($obj)
  {
    $obj->jackpot = rand(10,99).' '.rand(10,99).' '.rand(10,99).' '.rand(10,99).' '.rand(10,99).' '.rand(10,99); 
    if($obj->enter === $obj->jackpot)
    {
      echo "<center><strong><font color='white'>CONGRATULATION! You Won JACKPOT PriZe !!! </font></strong></center>". "<br><center><strong><font color='white' size='20'>".$obj->jackpot."</font></strong></center>";
      echo "<br><center><strong><font color='green' size='25'>".$flag."</font></strong></center><br>";
      echo "<center><img src='http://www.relatably.com/m/img/cross-memes/5378589.jpg' /></center>";

    }
    else
    {
      echo "<br><br><center><strong><font color='white'>Wrong! True Six Numbers Are: </font></strong></center>". "<br><center><strong><font color='white' size='25'>".$obj->jackpot."</font></strong></center><br>";
    }
  }
  else
  {
    echo "<center><strong><font color='white'>- Something wrong, do not hack us please! -</font></strong></center>";
  }
}
else
{
  echo "";
}
?>
<center>
<br><h2><font color='yellow' size=8>-- TSU</font><font color='red' size=8>LOTT --</font></h2>
<p><p><font color='white'>Input your code to win jackpot!</font><p>
<form>
          <input type="text" name="input" /><p><p>
          <button type="submit" name="btn-submit" value="go">send</button>
</form>
</center>
<?php
if (isset($_GET['gen_code']) && !empty($_GET['gen_code']))
{
  $temp = new Object;
  $temp->enter=$_GET['gen_code'];
  $code=base64_encode(serialize($temp)); 
  echo '<center><font color=\'white\'>Here is your code, please use it to Lott: <strong>'.$code.'</strong></font></center>';
}
?>
<center>
<font color='white'>-----------------------------------------------------------------------------------------------------------------------------</font>
<h3><font color='white'>Take code</font></h3><p>
<p><font color='white'>Pick your six numbers (Ex: 15 02 94 11 88 76)</font><p>
<form>
      <input type="text" name="gen_code" maxlength="17" /><p><p>
      <button type="submit" name="btn-submit" value="go">send</button>
</form>
</center>
<!-- debug: GET is_debug=1 -->
<?php
if(isset($_GET['is_debug']) && $_GET['is_debug']==='1')
{
   show_source(__FILE__);
}
?>
</body>
