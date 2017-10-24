<?php ob_start(); ?>
<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #32CD32;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 10px;
  width: 150px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

.button1 {
    background-color: white; 
    color: black; 
    border: 2px solid #4CAF50;
}

input[type=text] {
    width: 20%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid blue;
    border-radius: 4px;
}
</style>
<br>
<center><font size=10 color='red'>👌🏻 💪🏻 READY TO GET THE FLAG? 💪🏻 👌🏻</font></center>
<br>
<?php

function print_default()
{
unset($_COOKIE['level']);
if (isset($_POST["Command"]) && !empty($_POST["Command"]) && $_POST["Command"]==="start")
  {
    setcookie("level", "865c0c0b4ab0e063e5caa3387c1a8741", time() + (86400 * 30), "/");
    header("Refresh:0");
  }
else
  {
$str = <<<'EOD'
<br>
<form action="index.php" method="POST">
<input type="hidden" name="Command" value="start">
<center><button class="button" type="submit" style="vertical-align:middle"><span>Go </span></button></center>
</form>
EOD;
echo $str;
  }
}

function level1()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>1. What is the value of x in the equation x + 3 = 1 👩🏼‍🎓</font></center><br>
<center>
<form action="index.php" method="POST">
  <input type="checkbox" name="level1_choice" value="-3"> -3<br>
  <input type="checkbox" name="level1_choice" value="-2"> -2<br>
  <input type="checkbox" name="level1_choice" value="-1"> -1<br>
  <input type="checkbox" name="level1_choice" value="-4"> -4<br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level1_choice']) && !empty($_POST['level1_choice']))
  {  
    if($_POST['level1_choice']==="-2")
    {
      setcookie("level", md5('ii'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}


function level2()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>2. What is the value of x in the equation x * x = 121 👨🏼‍🎓 </font></center><br>
<center>
<form action="index.php" method="POST">
  <input type="checkbox" name="level2_choice" value="10"> 10<br>
  <input type="checkbox" name="level2_choice" value="11"> 11<br>
  <input type="checkbox" name="level2_choice" value="12"> 12<br>
  <input type="checkbox" name="level2_choice" value="13"> 13<br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level2_choice']) && !empty($_POST['level2_choice']))
  {  
    if($_POST['level2_choice']==="11")
    {
      setcookie("level", md5('iii'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level3()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>3. How many triangle in the picture below? (answer number in word) 👨🏽‍🏫</font></center><br>
<center>
<img src="http://i.imgur.com/Jf8NVc6.jpg" /><br><br>
<form action="index.php" method="POST">
  <input type="text" name="level3_choice"><br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level3_choice']) && !empty($_POST['level3_choice']))
  {  
    if(strtolower($_POST['level3_choice'])==="zero")
    {
      setcookie("level", md5('iv'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level4()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>4. What animal is this? 🐘</font></center><br>
<center>
<img src="http://i.imgur.com/LFG0Fl3.jpg" /><br><br>
<form action="index.php" method="POST">
  <input type="text" name="level4_choice"><br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level4_choice']) && !empty($_POST['level4_choice']))
  {  
    if(strtolower($_POST['level4_choice'])==="elephant")
    {
      setcookie("level", md5('v'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level5()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>5. Find the plaintext of this crypt: gfhvfunaqfbzr 🕵🏻</font></center><br>
<center>
<br><br>
<form action="index.php" method="POST">
  <input type="text" name="level5_choice"><br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level5_choice']) && !empty($_POST['level5_choice']))
  {  
    if(strtolower($_POST['level5_choice'])==="tsuishandsome")
    {
      setcookie("level", md5('vi'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level6()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>6. One rainbow has 7 colours, so how many colours does three rainbows has? 🌈</font></center><br>
<center>
<br><br>
<form action="index.php" method="POST">
  <input type="text" name="level6_choice"><br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level6_choice']) && !empty($_POST['level6_choice']))
  {  
    if(strtolower($_POST['level6_choice'])==="7")
    {
      setcookie("level", md5('vii'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level7()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>7. Tsu is 20 years old, his sister age = 1/2 him. So how old is she when Tsu reach 50 years old? 👼🏽</font></center><br>
<center>
<br><br>
<form action="index.php" method="POST">
  <input type="text" name="level7_choice"><br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level7_choice']) && !empty($_POST['level7_choice']))
  {  
    if(strtolower($_POST['level7_choice'])==="40")
    {
      setcookie("level", md5('viii'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level8()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>8. If there are 6 apples and you take away 4, how many do you have? 🍎</font></center><br>
<center>
<br><br>
<form action="index.php" method="POST">
  <input type="text" name="level8_choice"><br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level8_choice']) && !empty($_POST['level8_choice']))
  {  
    if(strtolower($_POST['level8_choice'])==="4")
    {
      setcookie("level", md5('ix'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level9()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>9. What goes up and down, but still remains in the same place? ↕️</font></center><br>
<center>
<br><br>
<form action="index.php" method="POST">
  <input type="text" name="level9_choice"><br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level9_choice']) && !empty($_POST['level9_choice']))
  {  
    if(strtolower($_POST['level9_choice'])==="stairs")
    {
      setcookie("level", md5('x'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level10()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>10. If there are 12 fish and half of them drown, how many are there? 🐟 🐡</font></center><br>
<center>
<br><br>
<form action="index.php" method="POST">
  <input type="text" name="level10_choice"><br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level10_choice']) && !empty($_POST['level10_choice']))
  {  
    if(strtolower($_POST['level10_choice'])==="12")
    {
      setcookie("level", md5('xi'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level11()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>11. How much money that Bill Gate got? (You are so close to flag, keep answer hoho xD) 🏆</font></center><br>
<center>
<br><br>
<form action="index.php" method="POST">
  <input type="text" name="level11_choice"><br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level11_choice']) && !empty($_POST['level11_choice']))
  {  
    if(strtolower($_POST['level11_choice'])==="111122223333444455556666777788880000")
    {
      setcookie("level", md5('xii'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level12()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>12. This is a question! 😂</font></center><br>
<center>
<br><br>
<form action="index.php" method="POST">
  <input type="text" name="level12_choice"><br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level12_choice']) && !empty($_POST['level12_choice']))
  {  
    if(strtolower($_POST['level12_choice'])==="this is an answer")
    {
      setcookie("level", md5('xiii'), time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  header("Refresh:0");
  }
}

function level13()
{
$question = <<<'EOD'
<center><font size=5 color='blue'>13. Is idol of tsu beautiful? 💖💖💖</font></center><br>
<center>
<img src="http://i.imgur.com/4JWwuSz.gif" /><br>
<form action="index.php" method="POST">
  <input type="checkbox" name="level13_choice" value="yes"> Of courses !!!!!<br>
  <input type="checkbox" name="level13_choice" value="yes"> Yes!!!! Yes!!!!!<br>
  <input type="checkbox" name="level13_choice" value="yes"> Absolutely Yes<br>
  <input type="checkbox" name="level13_choice" value="yes"> No Doubt!!!!!!<br>
  <br>
  <button class="button button1" type="submit" style="vertical-align:middle"><span>submit </span></button>
</form>
</center>
EOD;
echo $question;

if (isset($_POST['level13_choice']) && !empty($_POST['level13_choice']))
  {  
    if($_POST['level13_choice']==="yes")
    {
      echo "<center><font size=10 color=blue>Okay...Good Game Well Play! Here your flag:</font><br><font size=5 color=green>PwC{__Oopsss_!!!_M1sc0nfig_EVERYWHERE_!!!_}</font></center>";
      setcookie("level", "", time() + (86400 * 30), "/");
    }
    else
    {
      setcookie("level", "", time() + (86400 * 30), "/");
    }
  }
}
?>

<?php

$choice="";
if (isset($_COOKIE['level']) && !empty($_COOKIE['level']))
{
$choice=$_COOKIE['level'];
}

switch($choice)
{
  case md5("i"):
    level1();
    break;
  case md5("ii"):
    level2();
    break;
  case md5("iii"):
    level3();
    break;
  case md5("iv"):
    level4();
    break;
  case md5("v"):
    level5();
    break;
  case md5("vi"):
    level6();
    break;
  case md5("vii"):
    level7();
    break;
  case md5("viii"):
    level8();
    break;
  case md5("ix"):
    level9();
    break;
  case md5("x"):
    level10();
    break;
  case md5("xi"):
    level11();
    break;
  case md5("xii"):
    level12();
    break;
  case md5("xiii"):
    level13();
    break;
  default:
    print_default();
}

?>

<?php ob_flush(); ?>
