<?php 

session_start(); //start the session so it will remember the delcared sessions below

include "../db_connect.php";

if (isset($_POST['email']) && isset($_POST['password'])){

    function validate($data){ #this validates the data

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $email = validate($_POST['email']); #get the username using the post method

    $pass = validate($_POST['password']); #get the password using the post method

    #We will be using prepared statement for more security
    $stmt = $conn->prepare("SELECT * FROM emp_tbl WHERE emp_email=? AND emp_password=?"); #select all from your table where the username is equal to $uname and password is equal to $pass
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $stmt->num_rows();




    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        date_default_timezone_set("Asia/Manila");

        $senior_id = $row['senior_id'];
        $full_name = $row['full_name'];
        $log_date = date("Y-m-d");
        $log_time = date("H:i:s");
        $session_no = random_int(100000, 999999);

        /*
        $stmt = $conn->prepare("INSERT INTO `emp_log` (`login_name`, `login_date`, `login_time`, `senior_id`, `session_no`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $full_name, $log_date, $log_time, $senior_id, $session_no);
        $stmt->execute();
        */

        if ($row['emp_email'] === $email && $row['emp_password'] === $pass) { //if the username and password is correct this code will run

            $_SESSION['emp_status'] = "Active";

            $_SESSION['emp_email'] = $row['emp_email']; //create a username session

            $_SESSION['emp_id'] = $row['emp_id'];   //create a id session

            #a prepared statement to update the status of the senior citizen to "Active"
            $active = "Active"; #we declared this variable because apparently we need a reference for a prepared statement -_-
            $stmt = $conn->prepare("UPDATE emp_tbl SET status= ? WHERE emp_id= ?");
            $stmt->bind_param("si", $active, $row['emp_id']);
            $stmt->execute();

            header("Location:user_home.php");

            exit();

        }
        
        else{

            
            header("Location: login_page.php?error='$pass'"); //if the password is incorrect this will run
            

            exit();

        }

    }
        
    else{

        $em = "<script> alert('Account does not exist'); </script>";
        header("Location: login_page.php?error='bruh'"); //if the password is incorrect this will run
        exit();

    }


}
?>