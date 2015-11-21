<?php

session_start();

if (!isset($_SESSION["number"])) {
  $_SESSION["number"] = 0;
  $_SESSION["answer"] = 0;
  $_SESSION["correct"] = 0;
}

print <<<TOP
<html>
<head>
<title> Astronomy Quiz </title>
</head>
<body>
<h3> Astronomy Quiz </h3>
TOP;

$number = $_SESSION["number"];
$answer = $_SESSION["answer"];
$correct = $_SESSION["correct"];

if ($number == 0) {  
  $script = $_SERVER['PHP_SELF'];
  print <<<ONE
  <form method = "post" action = $script>
  <p> <b>1)</b> According to Kepler the orbit of the earth is a circle with the sun at the center.</p>
  <p> <label> <input name = "ans1" type = "radio" value = "true"/> a) True </label>
  <label> <input name = "ans1" type = "radio" value = "false"/> b) False </label> </p>
  <input type = "submit" value = "Next" />
  </form>
ONE;
}

if ($number == 1) {
  if ($_POST["ans1"] == "false") {
    $correct++;
    $_SESSION["correct"] = $correct;
  }
  $script = $_SERVER['PHP_SELF'];
  print <<<TWO
  <form method = "post" action = $script>
  <p> <b>2)</b> Ancient astronomers did consider the heliocentric model of the solar system but rejected it because they could not detect parallax.</p>
  <p> <label> <input name = "ans2" type = "radio" value = "true"/> a) True </label>
  <label> <input name = "ans2" type = "radio" value = "false"/> b) False </label> </p>
  <input type = "submit" value = "Next" />
  </form>
TWO;
}

if ($number == 2) {
  if ($_POST["ans2"] == "true") {
    $correct++;
    $_SESSION["correct"] = $correct;
  }
  $script = $_SERVER['PHP_SELF'];
  print <<<THREE
  <form method = "post" action = $script>
  <p> <b>3)</b> The total amount of energy that a star emits is directly related to its</p>
  <p> <label> <input name = "ans3a" type = "checkbox" value ="a" /> a) surface gravity and magnetic field </label> <br>
  <label> <input name = "ans3b" type = "checkbox" value ="b" /> b) radius and temperature </label> <br> 
  <label> <input name = "ans3c" type = "checkbox" value ="c" /> c) pressure and volume </label> <br>
  <label> <input name = "ans3d" type = "checkbox" value ="d" /> d) location and velocity </label> <br></p>
  <input type = "submit" value = "Next" />
  </form>
THREE;
}

if ($number == 3) {
  if ( ($_POST["ans3b"] == "b") and ($_POST["ans3a"] != "a") and ($_POST["ans3c"] != "c") and ($_POST["ans3d"] != "d") ){
    $correct++;
    $_SESSION["correct"] = $correct;
  }
  $script = $_SERVER['PHP_SELF'];
  print <<<FOUR
  <form method = "post" action = $script>
  <p> <b>4)</b> Stars that live the longest have</p>
  <p> <label> <input name = "ans4a" type = "checkbox" value ="a" /> a) high mass </label> <br>
  <label> <input name = "ans4b" type = "checkbox" value ="b" /> b) high temperature </label> <br> 
  <label> <input name = "ans4c" type = "checkbox" value ="c" /> c) lots of oxygen </label> <br>
  <label> <input name = "ans4d" type = "checkbox" value ="d" /> d) small mass </label> <br></p>
  <input type = "submit" value = "Next" />
  </form>
FOUR;
}

if ($number == 4) {
  if ( ($_POST["ans4d"] == "d") and ($_POST["ans4a"] != "a") and ($_POST["ans4c"] != "c") and ($_POST["ans4b"] != "b") ){
    $correct++;
    $_SESSION["correct"] = $correct;
  }
  $script = $_SERVER['PHP_SELF'];
  print <<<FIVE
  <form method = "post" action = $script>
  <p> <b>5)</b> A collection of a hundred billion stars, gas, and dust is called a <input name = "ans5" type = "text" size = "7" />.</p>
  <input type = "submit" value = "Next" />
  </form>
FIVE;
}

if ($number == 5) {
  if (strpos(strtolower($_POST["ans5"]),"galaxy") !== false) {
    $correct++;
    $_SESSION["correct"] = $correct;
  }
  print <<<SIX
  <form method = "post" action = $script>
  <p> <b>6)</b> The inverse of the Hubble's constant is a measure of the <input name = "ans6" type = "text" size = "7" /> of the universe.</p>
  <input type = "submit" value = "Next" />
  </form>
SIX;
}

if ($number == 6) {
  if (strpos(strtolower($_POST["ans6"]),"age") !== false) {
    $correct++;
    $_SESSION["correct"] = $correct;
  }
}

if ($number >= 6) {
  print <<<FINAL_SCORE
  Your final score is $correct.
FINAL_SCORE;
  session_destroy();
}
else {
  $number++;
  $_SESSION["number"] = $number;
}

print <<<BOTTOM
</body>
</html>
BOTTOM;

?>