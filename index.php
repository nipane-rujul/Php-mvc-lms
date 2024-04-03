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


<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="login" method="post">
        <input type="text" name="username" id="username" placeholder="Enter your username">
        <input type="password" name="password" id="password" placeholder="Enter your password">
        <!-- <a href="#">Forgot password?</a> -->
        <input type="button" class="button" value="Login">
      </form>
      <div class="signup">
        <span class="signup">Don't have an account?
         <label for="check">Signup</label>
        </span>
      </div>
    </div>
    <div class="registration form">
      <header>Signup</header>
      <form action="#">
        <input type="text" placeholder="Enter your email">
        <input type="password" placeholder="Create a password">
        <input type="password" placeholder="Confirm your password">
        <input type="button" class="button" value="Signup">
      </form>
      <div class="signup">
        <span class="signup">Already have an account?
         <label for="check">Login</label>
        </span>
      </div>
    </div>
  </div>
</body>
</html>