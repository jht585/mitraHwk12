  <?php  //            LOGIN PAGE
    //check the username/password have been set
    if (isset($_POST["user"]) and isset($_POST["pswd"])){
      $user = trim( $_POST["user"]);
      $pswd =trim( $_POST["pswd"]);

      //if is set, check if is valid
      if (validate($user, $pswd)){
       
        //if is valid, check if is in results page
        if (inResults($user)){        
         
          //if in results.txt, print out his results
          printResults($user);

       // header('Location: ./newshome.html');    // CHANGE THIS LINK
        }
        else{
          header('Location: ./assignment12.php');
        }
     }

        
      

      //if is not valid, print page with alert
      else {
        login_invalid();
      }

      }
    //if is not set, print page normally
  else{
  print<<<PAGE
  <html>
  <head>
  <title> Login </title>
  </head>
  <body>
  <h3> Login </h3>
  <form action = "./login.php" method = "POST">
  <table border = "0">
    <tr>
      <td> Enter Username: </td><td><input type = "text" name = "user" /></td>
    </tr>
    <tr>
      <td> Enter Password: </td><td> <input type = "text" name = "pswd" /></td>
    </tr>
    <tr>
      <td> <input type = "submit" value = "Submit" /> </td>
      <td> <input type = "reset" value = "Clear" /> </td>
    </tr>
  </table>
  </body>
  </html>
PAGE;
  }

function validate($a,$b)
{
  $found = False;
  $file = fopen("./passwd.txt", "r");
  while (!feof($file))
  {
    $line = fgets($file);
    $lineArr = explode(":", $line);
    $pswd =trim( $lineArr[1]);
    $user =trim( $lineArr[0]);
    if ($a == $user and $b == $pswd){
       $found = True;
       break;
        }
  }
  fclose($file);
  return($found);
}

function login_invalid()
{
  print<<<PAGE
  <head>
  <title> Login </title>
  </head>
  <body>
  <h3> Login </h3>
  <p><i>Login invalid </i><p>
  <form action = "./login.php" method = "POST">
  <table border = "0">
    <tr>
      <td> Enter Username: </td><td><input type = "text" name = "user" /></td>
    </tr>
    <tr>
      <td> Enter Password: </td><td> <input type = "text" name = "pswd" /></td>
    </tr>
    <tr>
      <td> <input type = "submit" value = "Submit" /> </td>
      <td> <input type = "reset" value = "Clear" /> </td>
    </tr>
  </table>
  </body>
  </html>
PAGE;
}

function inResults($u)
{
  $found = False;
  $file = fopen("./results.txt", "r");
  while (!feof($file))
  {
    $line = fgets($file);
    $lineArr = explode(":", $line);
    $user =trim( $lineArr[0]);
    if ($u == $user){
       $found = True;
       break;
        }
  }
  fclose($file);
  return($found);
}

function printResults($u)
{
  $file = fopen("./results.txt", "r");
  while (!feof($file))
  {
    $line = fgets($file);
    $lineArr = explode(":", $line);
    $user =trim($lineArr[0]);
    if ($u == $user){
      $r = trim($lineArr[1]);
      break; 
        }
  }
  fclose($file);
  print<<<PAGE
  <head>
  <title> $u results</title>
  </head>
  <body>
  <h3> Results for $u. </h3>
  <p> Your score is: $r of 60.</p>
  <p> Thanks for playing! </p> 
  </body>
PAGE;
}
?>
