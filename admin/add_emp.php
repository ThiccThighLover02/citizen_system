<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../vendor/phpmailer/phpMailer/src/Exception.php';
    require '../vendor/phpmailer/phpMailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpMailer/src/SMTP.php';
    include "../db_connect.php";
   #declare all of the variables that we will use

    date_default_timezone_set("Asia/Manila");
    
    $random = random_int(1000, 9999);
    
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $extension = $_POST['extension'];
    $full_name = $first_name . " " . $middle_name . " " . $last_name;
    $birth_date = $_POST['date_birth'];
    $birth_place = $_POST['place_birth'];
    $sex = $_POST['sex'];
    $civil_stat = $_POST['civil_status'];
    $citizenship = $_POST['citizenship'];
    $cell_no = $_POST['cell_no'];
    $purok = $_POST['purok'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $province = $_POST['province'];
    $email = $_POST['email'];
    $password = date("Y-") . random_int(1000, 9999);
    $account_date = date("Y-m-d");
    $account_time = date("H:i:s");
    $status = "Inactive";
   
  #this will compute the seniors age
  $birthday = $_POST['date_birth'];

  $birthday = new DateTime($birthday);
  $interval = $birthday->diff(new DateTime);
  $age = $interval->y;
   


   #this is for the with_id pic
   $id_name = $_FILES['id_pic']['name'];
   $id_size = $_FILES['id_pic']['size'];
   $id_tmp_name = $_FILES['id_pic']['tmp_name'];
   $id_error = $_FILES['id_pic']['error'];

   if($id_error === 0){
    if ($id_size > 16777215){
    header("Location: create_acc.php?img_size=false"); #this will execute if the file ist too large
    }

    else {
        $img_ex = pathinfo($id_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png");

        if(in_array($img_ex_lc, $allowed_exs)) {
          date_default_timezone_set("Asia/Manila");
          $new_id_name =$first_name . "_" . $middle_name . "_" . $last_name . "id_pic" . "." . $img_ex_lc;
          $img_upload_path = 'user_pics/' . $new_id_name;
          move_uploaded_file($id_tmp_name, $img_upload_path);
            
            
        }
        else{
         header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
        }
    }
}



    $stmt = $conn->prepare("INSERT INTO `senior_system`.`emp_tbl` (`status`, `first_name`, `middle_name`, `last_name`, `extension`, `full_name`, `birth_date`, `birth_place`, `age`, `sex`, `civil_status`, `citizenship`, `cell_no`, `purok_id`, `barangay_id`, `municipality_id`, `province_id`, `emp_email`, `emp_password`, `id_pic`, `account_time`, `account_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
    "); 
    $stmt->bind_param("ssssssssssssiiiiisssss", $status, $first_name, $middle_name, $last_name, $extension, $full_name, $birth_date, $birth_place, $age, $sex, $civil_stat, $citizenship, $cell_no, $purok, $barangay, $municipality, $province, $email, $password, $new_id_name, $account_time, $account_date);
    $stmt->execute();

    header("Location: admin_view_emp.php");
?>