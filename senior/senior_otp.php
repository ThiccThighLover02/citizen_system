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
    <script>
    </script>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Login Page</title>
    <script src="senior_script.js"></script>
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
      <h1 class="login_header">Enter OTP</h1>

      <form action="" method="post" class="forgot_info" id="forgot-form">
        <div class="otp-box">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
        </div>

        <button class="submit-button" type="submit">Submit OTP</button>

      </form>

    </div>
    
  </body>

  <script>
    /*
    const inputs = document.querySelectorAll("otp-box, input");

    //iterate over all inputs
    inputs.forEach((input, index) => {
        input.addEventListener("keyup", (e) => {
            const currentInput = input,
            nextInput= input.nextElementSibling,
            prevInput = input.previousElementSibling;
        
            if(currentInput.value.length > 1) {
                currentInput.value = "";
                return;
            }
maxlength="1"
            if(nextInput && nextInput.hasAmaxlength="1"ttribute(maxlength="1"") && currentInput.value !== "") {
                nextInput.removeAttribute(maxlength="1"");
                nextInput.focus();
            }

            if(e.key === "Backspace") {
                inputs.forEach((input,index1) => {
                    if(index <= index1 && pmaxlength="1"revInput) {
                        input.setAttribute(maxlength="1"", true);
                        currentInput.value = "";
                        prevInput.focus();
                    }
                });
            }
maxlength="1"
            if(!inputs[3]maxlength="1" && !inputs[3].value !== "") {
                button.classList.add("active");
                return;
            }
        });
    });
    
    
    //this will focus the first input on window load
    window.addEventListener("load", () => inputs[0].focus());
    */

    const inputs = document.querySelectorAll("otp-box, input");
    const sub_form = document.getElementById("forgot-form");

    inputs.forEach((input, index) => {
        input.dataset.index = index;
        input.addEventListener("paste", handleOtppaste);
        input.addEventListener("keyup", handleOtp);
    });

    function handleOtppaste(e) {
        const data = e.clipboardData.getData("text");
        const value = data.split("");
        if(value.length === inputs.length) {
            inputs.forEach((input, index) => (input.value = value[index]));
            submit();
        }
    }
    
    function handleOtp(e) {
        const input = e.target;
        let value = input.value;
        input.value = "";
        input.value = value ? value[0] : "";

        let fieldIndex = input.dataset.index;
        if(value.length > 0 && fieldIndex < inputs.length - 1) {
            input.nextElementSibling.focus();
        }

        if(e.key === "Backspace" && fieldIndex > 0) {
            input.previousElementSibling.focus();
        }

        if(fieldIndex == inputs.length - 1) {
            submit();
        }
    }

    function submit() {
        console.log("submitting...");
        let otp = "";
        inputs.forEach((input) => {
            otp += input.value;
        });
        console.log(otp);
        setCookie("otp", otp, 1);
        sub_form.submit();
    }

    function setCookie(name, value, minutesToLive) {
        const date = new Date();
        date.setTime(date.getTime() + (minutesToLive * 24 * 60 * 60 * 1000));
        let expires = "expires=" + date.toUTCString();
        document.cookie = `${name}=${value}; ${expires}; path=/`;
        console.log(expires);
    }

    function deleteCookie(name) {
        setCookie(name, null, null);
    }

    window.addEventListener("load", () => inputs[0].focus());

    <?php

        if(isset($_COOKIE['otp'])) {
    ?>

    console.log("<?= $_COOKIE['otp'] . "This is the cookie motherfuckersssss" ?>");
    deleteCookie("otp");

    <?php
        }

    ?>
  </script>

</html>

<?php

    
    if (isset($_COOKIE['otp'])) {

        /*
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
        */


    }


    
?>