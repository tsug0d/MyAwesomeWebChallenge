<?php

function mapl_die()
{
        $wrong = <<<EOF
<link rel="stylesheet" href="style.css" type="text/css" />
<audio controls autoplay hidden>
  <source src="assets/freemarket.mp3" type="audio/mpeg">
</audio>
<body background="assets/image/wrong.jpg" class="cenback"></body>
EOF;
        die($wrong);
}

?>