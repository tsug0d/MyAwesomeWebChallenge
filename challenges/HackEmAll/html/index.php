<?php
session_start();
include('secret.php');
ob_start();
?>
<link href="assets/nes.min.css" rel="stylesheet" />
<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/8bit-wonder" type="text/css"/>
    <style>
      * {
           font-family: '8BITWONDERNominal';
           font-weight: lighter;
           font-style: normal;
        }
      div {
          width: 50%;
        }

      #header
      {
          color: white;
          font-size: 2.5em;
          -webkit-text-stroke: 2px #38b6ff;
      }
    </style>
<h1 id="header"><center>Gotta Hack 'Em All</center></h1><br>

<?php

class Trainer
{
  public $name;

  function use_poke_ball()
  {
      $this->name = htmlentities($this->name);
      $pkm = htmlentities($_POST['pokemon']);
      if($_SESSION['poke_ball']>0)
      {
        $_SESSION['poke_ball']-=1;
        $rate = rand(0,1);
        if($_POST['pokemon']==="Flag")
        {
          $rate=0;
        }

        if($rate === 1)
        {
          if($_POST['pokemon']==="Pokedex_Source")
          {
            show_source(__FILE__);
          }
          die($this->name. ' captured '.$pkm.'! Cool trainer!!!! Adventure <a href="index.php">more</a>');
        }
        else
        {
          die('Failed! Trainer '. $this->name . ' should go Adventure <a href="index.php">more</a>');
        }
      }
      else
      {
        die('No Poke ball!!! Trainer '. $this->name. ' should take some ball <a href="get_more_ball.php">here</a>');
      }
  }

  function use_master_ball()
  {
      $this->name = htmlentities($this->name);
      $pkm = htmlentities($_POST['pokemon']);
      if($_SESSION['master_ball']>0)
      {
        $_SESSION['master_ball']-=1;
        if($_POST['pokemon']==="Flag")
        {
          die('Captured Flag: '. $GLOBALS['flag']);
        }
        else
        {
          die($this->name. ' captured '.$pkm.'! Cool trainer!!!! Adventure <a href="index.php">more</a>');
        }
      }
      else
      {
        die('No Master Ball!!! Trainer '. $this->name. ' should take some ball <a href="get_more_ball.php">here</a>');
      }
  }
}

if (!isset($_COOKIE['name']))
{
    if(isset($_POST['name']) && !empty($_POST['name']))
    {
      $trainer = new trainer;
      $trainer->name = $_POST['name'];
      setcookie('name', serialize($trainer), time() + (86400 * 30), "/");
    }
    else
    {
      $require_name = <<<EOF
      <center>
      <div id="nescss">
        <div class="container">
          <main class="main-content">
            <section class="topic">
              <section class="nes-container with-title">
              <h3 class="title">Hello Trainer</h3>
                <center><strong><br>Enter Your Name<br></strong><br><form method="POST" action="index.php"><input type="text" class="nes-input is-success" id="inline_field" name="name"></input><br><br><button class="nes-btn is-primary" type="submit" value="submit" /></form></center>
              </section>
            </section>
          </main>
        </div>
      </div>
      </center>
EOF;
      die($require_name);
    }
}
else
{
    $trainer = new Trainer;
    $trainer = unserialize($_COOKIE['name']);
}

if (!isset($_SESSION['poke_ball']) or !isset($_SESSION['master_ball']))
{
    $_SESSION['poke_ball'] = 5;
    $_SESSION['master_ball'] = 0;
}

?>

<center><?php echo htmlentities($trainer->name); ?><br><br><i class="nes-ash"></i></center>
<br>
<center> <img src='assets/pokeball.jpg' width="2%" />&nbsp;Poke Ball: <?php echo $_SESSION['poke_ball'] ?> <br> <img src='assets/masterball.jpg' width="2%" />&nbsp;Master Ball: <?php echo $_SESSION['master_ball'] ?></center>

<?php
if ($_SESSION['poke_ball']===0 and $_SESSION['master_ball']===0)
{
  echo '<br><center>Take some ball <a href="get_more_ball.php">here</a></center>';
}
?>

<center><br><strong>
<?php
if(isset($_POST['poke_ball']) && isset($_POST['pokemon']) && !empty($_POST['pokemon']))
{
    $trainer->use_poke_ball();
}
elseif(isset($_POST['master_ball']) && isset($_POST['pokemon']) && !empty($_POST['pokemon']))
{
    $trainer->use_master_ball();
}
?>
</strong></center>

<center>
<section class="showcase">
<div class="nes-container with-title">
<br><br><br>
<?php
$rand_poke = Array('Pippi', 'Pikachu', 'Meow', 'Flag', 'Pokedex_Source');
$poke = $rand_poke[rand(0,count($rand_poke)-1)];
?>
<h1> <div class="nes-container is-rounded">Wild <?php echo $poke; ?> appeared!</div></h1>
<br>
<img src="assets/<?php echo $poke?>.png" width="15%"/>
<br><br>
<?php
echo '<form method="POST" action="index.php">';
if($_SESSION['poke_ball'] > 0)
{
  echo '<input class="nes-btn is-success" type="submit" name="poke_ball" value=".....Use Poke Ball....."" />';
}
elseif($_SESSION['poke_ball'] <= 0)
{
  echo '<input disabled class="nes-btn is-disabled" type="submit" name="poke_ball" value=".....Use Poke Ball....." />';
}
if($_SESSION['master_ball'] > 0)
{
  echo '<br><input class="nes-btn is-success" type="submit" name="master_ball" value="Use Master Ball" />';
}
elseif($_SESSION['master_ball'] <= 0)
{
  echo '<br><input disabled class="nes-btn is-disabled" type="submit" name="master_ball" value="Use Master Ball" />';
}
echo '<input hidden name="pokemon" value="'.$poke.'" />';
echo '</form>';
?>
&nbsp;<input class="nes-btn is-error" type="submit" name="run" onClick="window.location.href='.';" value="Run Away" />
</div>
</section>
</center>
