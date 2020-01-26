<html>
<body>
<link rel="stylesheet" href="assets/tsu_effect.css">
<link rel="stylesheet" href="assets/tsu_layout.css">

<div class="topnav">
  <a href="report.php">Report Bug</a>
  <a href="product.php">Product</a>
  <a href="index.php">Home</a>
</div>
<script src="assets/jquery.min.js"></script>


<?php

function block_your_sunshine_lul($payload)
{
    $regex="/[a-zA-Z]|#|\*|&|-|\+|;|\/|%|\r|\n/i";
    if (preg_match($regex,$payload))
    {
        return True;
    }
    return False;
}

function trial_user($payload)
{
    $regex="/18|27|36|69|74|76|79|100|101|121/i";
    if (preg_match($regex,$payload))
    {
        return True;
    }
    return False;
}
?>

<script>

<?php
if(isset($_GET['numb']) && !empty($_GET['numb']))
{
    if(block_your_sunshine_lul($_GET['numb']))
    {
    echo "document.write(\"<p id='default'>Only number pls!</p><br><center><img src='https://i.imgur.com/1g3CDzX.png'></center><br>\")";
    }
    elseif(trial_user($_GET['numb']))
    {
    echo "document.write(\"<p id='default'>Sorry, some number is limited in demo version, pls buy full!</p><br><center>\")";
    }
    else
    {
    echo "document.write('<p id=\'number\'>');";
    echo "document.write('" . htmlentities($_GET['numb']) . "');";
    echo "document.write('</p><br>');";
    }
}
else
{
    echo "document.write(\"<p id='default'>Hi, here the demo, just <a href='?numb=123'>try</a> it~</p>\");";
}
?>

$(document).ready(function(){
    $("button#red").click(function(){
    	$("#number").removeClass("galaxy")
    	$("#number").removeClass("shadow")
    	$("#number").removeClass("neon");
    	$("#number").removeClass("rainbow");
        $("#number").css("color", "red").css("font-size","100px").css("font-family",'"Warnes",Helvetica, sans-serif').css("margin","50px auto").css("text-align","center");
    });
    $("button#blue").click(function(){
    	$("#number").removeClass("galaxy")
    	$("#number").removeClass("shadow")
    	$("#number").removeClass("neon");
    	$("#number").removeClass("rainbow");
        $("#number").css("color", "blue").css("font-size","100px").css("font-family",'"Warnes",Helvetica, sans-serif').css("margin","50px auto").css("text-align","center");
    });
    $("button#yellow").click(function(){
    	$("#number").removeClass("galaxy")
    	$("#number").removeClass("shadow")
    	$("#number").removeClass("neon");
    	$("#number").removeClass("rainbow");
        $("#number").css("color", "yellow").css("font-size","100px").css("font-family",'"Warnes",Helvetica, sans-serif').css("margin","50px auto").css("text-align","center");
    });
    $("button#rainbow").click(function(){
    	$("#number").removeClass("galaxy")
    	$("#number").removeClass("shadow")
    	$("#number").removeClass("neon");
        $("#number").addClass("rainbow")
    });
    $("button#neon").click(function(){
    	$("#number").removeClass("galaxy")
    	$("#number").removeClass("shadow")
    	$("#number").removeClass("rainbow").css("color","black");
        $("#number").addClass("neon")
    });
    $("button#shadow").click(function(){
    	$("#number").removeClass("galaxy")
    	$("#number").removeClass("rainbow").css("color","black");
        $("#number").removeClass("neon").css("color","black");
        $("#number").addClass("shadow");
    });
    $("button#galaxy").click(function(){
    	$("#number").removeClass("shadow")
    	$("#number").removeClass("rainbow").css("color","black");
        $("#number").removeClass("neon").css("color","black");
        $("#number").addClass("galaxy");
    });
    $("button#reset").click(function(){
    	$("#number").removeClass("galaxy")
    	$("#number").removeClass("shadow")
    	$("#number").removeClass("neon");
    	$("#number").removeClass("rainbow");
        $("#number").css("color", "black").css("font-size","100px").css("font-family",'"Warnes",Helvetica, sans-serif').css("margin","50px auto").css("text-align","center");
    });
});



</script>

<center>
<button id='red' class="btn">Red</button>
<button id='blue' class="btn">Blue</button>
<button id='yellow' class="btn">Yellow</button>
<button id='rainbow' class="btn">Rainbow</button>
<button id='neon' class="btn">Neon</button>
<button id='shadow' class="btn">Shadow</button>
<button id='galaxy' class="btn">Galaxy</button>
<button id='reset' class="btn">Reset</button>
</center>

</body>
</html>
