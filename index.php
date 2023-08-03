<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Login Page</title>
    <link rel="stylesheet" href ="style.css?v=<?php echo time(); ?>">
    <!-- bruh -->
  </head>
  <body>
    <div class="topnav" id="myTopnav">
      <div class="dropdown">
        <button class="dropbtn">Login
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="senior/senior_login.php">Senior Login</a>
          <a href="user_login.php">User Login</a>
          <a href="admin_login.php">Admin Login</a>
        </div>
      </div>
      <a href="#about">About</a>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div> 
  </body>

  <script>
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
} 
  </script>
</html>