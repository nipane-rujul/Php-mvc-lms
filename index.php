<?php

session_start();

$_SESSION['user'] = "ruju;l";
var_dump($_SESSION);
echo "hi";
echo session_id();
setcookie("user", "John Doe", time() + 3600, "/");
?>

<!doctype html>

<html lang="en"> 

 <head> 

  <meta charset="UTF-8"> 

  <title>CodePen - Animated Login Form using Html &amp; CSS Only</title> 

  <!-- <link rel="stylesheet" href="./style.css">  -->

 </head> 

 <body> <!-- partial:index.partial.html --> 

  <section> 

   <div class="signin"> 

    <div class="content"> 

     <h2>Sign In</h2> 

     <div class="form"> 

      <div class="inputBox"> 

       <input type="text" required> <i>Username</i> 

      </div> 

      <div class="inputBox"> 

       <input type="password" required> <i>Password</i> 

      </div> 

      <div class="links"> <a href="#">Forgot Password</a> <a href="register.php">Signup</a> 

      </div> 

      <div class="inputBox"> 

       <input type="submit" value="Login"> 

      </div> 

     </div> 

    </div> 

   </div> 

  </section> <!-- partial --> 

 </body>

</html>