<?php
  include "../db_connect.php";
  session_start();
  
  if (isset($_SESSION['senior_status']) and $_SESSION['senior_status'] == "Active"){
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
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="bruh">
    
    <div class="login_form">

      <a href="../index.php">
        <span class="material-symbols-outlined">
          arrow_back
        </span>
      </a>

      <img src="../munisipyo.png" alt="" class="logo">
      <h1 class="login_header">Senior Citizen Login</h1>

      <form action="senior_check.php" method="post" class="login_info">
        <!--<label for="" class="label-email">Email</label> -->
        <input type="email" class="email" name="email" placeholder="Email Address">

        <!-- <label for="" class="label-password">Password</label> -->
        <input type="password" class="email" name="password" placeholder="Password">

        <input type="submit" value="Login" class="submit-button">

        <a href="" class="links">Forgot Password</a>
        <p class="links">Not registered? <a href="create_acc.php" class="links">Create Account</a></p>

      </form>

    </div>
    
  </body>
</html>

<?php
  }
?>