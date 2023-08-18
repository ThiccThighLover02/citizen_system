<?php
    session_start();
        
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../vendor/phpmailer/phpMailer/src/Exception.php';
    require '../vendor/phpmailer/phpMailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpMailer/src/SMTP.php';
    
    
    #declare the otp that is going to be sent to the user
    $_SESSION['otp'] = random_int(1000, 9999);
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
      <h1 class="login_header">Forgot Password</h1>

      <form action="senior.php" method="post" class="forgot-info">
        <label for="" class="label-email">Please enter your email address</label>
        <input type="email" class="email" name="email" placeholder="Email Address">
        <input type="submit" class="submit-button" value="Send OTP Code">

      </form>

    </div>
    
  </body>
  <script>

  </script>
</html>

<?php

    
    if (isset($_POST['submit'])) {
        $subject = "Change Password Request";
        $message = "We have received a request to retrieve your password, please enter this code to verify that it's you who requested this. " . $_SESSION['otp'];

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'seniorcitizensystem@gmail.com';
        $mail->Password = 'qkjtmhbkbuqnixdj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('seniorcitizensystem@gmail.com');
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();

        $_SESSION['senior_email'] = $_POST['email'];

        header("Location: user_forgot.php");
    }


    
?>