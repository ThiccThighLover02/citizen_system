<?php
  include "../db_connect.php";
  session_start();
  
  if (isset($_SESSION['emp_status']) and $_SESSION['emp_status'] == "Active"){
    header("Location:senior_home.php");
  }
  else {
    
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Login Page</title>
    <link rel="stylesheet" href="../style.css">
    
  </head>
  <body class="bruh">
    
    <div class="login_form">

      <a href="../index.php">
        <span class="material-symbols-outlined">
          arrow_back
        </span>
      </a>

      <img src="../munisipyo.png" alt="" class="logo">
      <h1 class="login_header">Employee Login</h1>

      <form action="user_check.php" class="login_info" method="post">
        <!--<label for="" class="label-email">Email</label> -->
        <input type="email" class="email" placeholder="Email Address" name="email">

        <!-- <label for="" class="label-password">Password</label> -->
        <input type="password" class="email" placeholder="Password" name="password" id="pass_word">

        <div class="show-pass">
          <input type="checkbox" class="checkbox" id="check-box" onclick="show_pass()">
          <label for="">Show Password</label>
        </div>

        <input type="submit" value="Login" class="submit-button">

        <a href="" class="links">Forgot Password</a>

      </form>

    </div>
    
  </body>
  <script>
    function show_pass() {
      var x = document.getElementById("pass_word");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }

  </script>
</html>

<?php
  }
?>