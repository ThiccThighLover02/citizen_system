<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../vendor/phpmailer/phpMailer/src/Exception.php';
    require '../vendor/phpmailer/phpMailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpMailer/src/SMTP.php';
    include "../db_connect.php";

    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){


    if(isset($_GET['request_id'])){

    $req_stmt = $conn->prepare("SELECT * FROM request_tbl WHERE request_id=?");
    $req_stmt->bind_param("i", $_GET['request_id']);
    $req_stmt->execute();
    $result = $req_stmt->get_result();
    $row = mysqli_fetch_array($result);

   #declare all of the variables that we will use

    date_default_timezone_set("Asia/Manila");
    
    $random = random_int(1000, 9999);
    
    $first_name = $row['first_name'];
    $middle_name = $row['middle_name'];
    $last_name = $row['last_name'];
    $extension = $row['extension'];
    $full_name = $first_name . " " . $middle_name . " " . $last_name;
    $birth_date = $row['birth_date'];
    $age = $row['age'];
    $birth_place = $row['place_birth'];
    $sex = $row['sex'];
    $civil_status = $row['civil_status'];
    $citizenship = $row['citizenship'];
    $cell_no = $row['cell_no'];
    $purok = $row['purok_id'];
    $barangay = $row['barangay_id'];
    $municipality = $row['municipality_id'];
    $province = $row['province_id'];
    $email = $row['senior_email'];
    $password = date("Y") . "-" . $random;
    $date_created = date("Y-m-d");
    $time_created = date("H:i:s");
    $status = "Inactive";
    
    
    #this will generate the qr code for this account
    include('../phpqrcode/qrlib.php');
    $tempDir = '../senior/senior_pics/qr_codes/';

    $codeContents = uniqid("senior", true);

    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = uniqid() .  date("Ymd") .'.png';

    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;

    // generating
    
    
    if (!file_exists($pngAbsoluteFilePath)) {
      QRcode::png($codeContents, $pngAbsoluteFilePath);
    } else {
        unlink($pngAbsoluteFilePath);
        QRcode::png($codeContents, $pngAbsoluteFilePath);
    }
    #the original path and the new path of the birth certificate
    $birth_original = "requests/birth_certificate/" . $row['birth_certificate'];
    $birth_new_path = "../senior/senior_pics/birth_certificates/" . $row['birth_certificate'];

    #the original path and the new path of the id picture
    $id_original = "requests/id_pics/" . $row['id_pic'];
    $id_new_path = "../senior/senior_pics/id_pics/" . $row['id_pic'];

    $bar_original = "requests/bar_certificate/" . $row['bar_certificate'];
    $bar_new_path = "../senior/senior_pics/bar_certificates/" . $row['bar_certificate'];

    $valid_original = "requests/valid_id/" / $row['valid_id'];
    $valid_new_path = "../senior/senior_pics/valid_id/" . $row['valid_id'];

    #we check if the image already exists in the folder
    if (!file_exists($birth_new_path . $row['birth_certificate'])) {
        rename($birth_original, $birth_new_path);
    } 
    else {
        unlink($birth_new_path . $row['birth_certificate']);
        rename($birth_original, $birth_new_path);
    }     

    if (!file_exists($id_new_path . $row['id_pic'])) {
        move_uploaded_file($id_original, $id_new_path);
    } 
    else {
        unlink($id_new_path . $row['id_pic']);
        move_uploaded_file($id_original, $id_new_path);
    }

    if (!file_exists($bar_new_path . $row['bar_certificate'])) {
        rename($bar_original, $bar_new_path);
    } 
    else {
        unlink($bar_new_path . $row['bar_certificate']);
        rename($bar_original, $bar_new_path);
    }     

    if (!file_exists($valid_new_path . $row['valid_pic'])) {
        move_uploaded_file($valid_original, $valid_new_path);
    } 
    else {
        unlink($valid_new_path . $row['valid_pic']);
        move_uploaded_file($valid_original, $valid_new_path);
    }

    

    



    $stmt = $conn->prepare("INSERT INTO `senior_system`.`senior_tbl` (`status`, `full_name`, `first_name`, `mid_name`, `last_name`, `extension`, `date_birth`, `birth_place`, `age`, `sex`, `civil_status`, `citizenship`, `cell_no`, `senior_purok_id`, `senior_barangay_id`, `senior_municipality_id`, `senior_province_id`, `senior_email`, `senior_password`, `qr_image`, `id_pic`, `birth_certificate`, `bar_certificate`, `valid_id`, `account_time`, `account_date`, `qr_contents`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"); 
    $stmt->bind_param("ssssssssssssiiiiissssssssss", $status, $full_name, $first_name, $middle_name, $last_name, $extension, $birth_date, $birth_place, $age, $sex, $civil_status, $citizenship, $cell_no, $purok, $barangay, $municipality, $province, $email, $password, $fileName, $row['id_pic'], $row['birth_certificate'], $row['bar_certificate'], $row['valid_id'], $time_created, $date_created, $codeContents);
    $stmt->execute();

    $remove = $conn->prepare("DELETE FROM request_tbl WHERE request_id=?");
    $remove->bind_param("i", $_GET['request_id']);
    $remove->execute();



    $subject = "Account Approval";
    $message = "Hello " . $first_name . " " . $last_name . ", your account has been approved. <br> You may proceed to the senior login page and enter the following credentials:<br>

    <h1>" . "Email: " . $email . "</h1> <br>
    <h1>" . "Password: " . $password . "</h1>" ;

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'seniorcitizensystem@gmail.com';
    $mail->Password = 'qkjtmhbkbuqnixdj';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('seniorcitizensystem@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    header("Location: admin_requests.php?add_senior='true'");

    }

    elseif(isset($_GET['add_senior']) == "true") {


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

    include('../phpqrcode/qrlib.php');
    $tempDir = '../senior/senior_pics/qr_codes/';

    $codeContents = uniqid("senior", true);

    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = uniqid() .  date("Ymd") .'.png';

    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;

    // generating
    
    
    if (!file_exists($pngAbsoluteFilePath)) {
      QRcode::png($codeContents, $pngAbsoluteFilePath);
    } else {
        unlink($pngAbsoluteFilePath);
        QRcode::png($codeContents, $pngAbsoluteFilePath);
    }
   


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
          $img_upload_path = '../senior/senior_pics/id_pics/' . $new_id_name;
          move_uploaded_file($id_tmp_name, $img_upload_path);
            
            
        }
        else{
         header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
        }
    }
}

#this is for the birthcertificate
$birth_cert = $_FILES['birth_certificate']['name'];
$birth_size = $_FILES['birth_certificate']['size'];
$birth_temp_name = $_FILES['birth_certificate']['tmp_name'];
$birth_error = $_FILES['birth_certificate']['error'];
if($birth_error === 0){
 if ($birth_size > 16777215){
  header("Location: create_acc.php?img_size=false"); #this will execute if the image size is too large
 }

 else {
     $img_ex = pathinfo($birth_cert, PATHINFO_EXTENSION);
     $img_ex_lc = strtolower($img_ex);

     $allowed_exs = array("jpg", "jpeg", "png");

     if(in_array($img_ex_lc, $allowed_exs)) {
       date_default_timezone_set("Asia/Manila");
       $new_birth_name =$first_name . "_" . $middle_name . "_" . $last_name . "birth_cert" . "." . $img_ex_lc;
       $img_upload_path = '../senior/senior_pics/birth_certificates/' . $new_birth_name;
       move_uploaded_file($birth_temp_name, $img_upload_path);
         
         
     }
     else{
         header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
     }
 }
}

#this is for the barangay certificate
$bar_cert = $_FILES['bar_certificate']['name'];
$bar_size = $_FILES['bar_certificate']['size'];
$bar_temp_name = $_FILES['bar_certificate']['tmp_name'];
$bar_error = $_FILES['bar_certificate']['error'];
if($bar_error === 0){
 if ($bar_size > 16777215){
  header("Location: create_acc.php?img_size=false"); #this will execute if the image size is too large
 }

 else {
     $img_ex = pathinfo($bar_cert, PATHINFO_EXTENSION);
     $img_ex_lc = strtolower($img_ex);

     $allowed_exs = array("jpg", "jpeg", "png");

     if(in_array($img_ex_lc, $allowed_exs)) {
       date_default_timezone_set("Asia/Manila");
       $new_bar_name =$firstN . "_" . $midN . "_" . $lastN . "bar_cert" . "." . $img_ex_lc;
       $img_upload_path = '../user/requests/bar_certificate/' . $new_birth_name;
       move_uploaded_file($bar_temp_name, $img_upload_path);
         
         
     }
     else{
         header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
     }
 }
}

#this is for the valid id
$valid_id = $_FILES['valid_id']['name'];
$valid_size = $_FILES['valid_id']['size'];
$valid_temp_name = $_FILES['valid_id']['tmp_name'];
$valid_error = $_FILES['valid_id']['error'];
if($valid_error === 0){
if ($valid_size > 16777215){
header("Location: create_acc.php?img_size=false"); #this will execute if the image size is too large
}

else {
   $img_ex = pathinfo($valid_id, PATHINFO_EXTENSION);
   $img_ex_lc = strtolower($img_ex);

   $allowed_exs = array("jpg", "jpeg", "png");

   if(in_array($img_ex_lc, $allowed_exs)) {
     date_default_timezone_set("Asia/Manila");
     $new_valid_name =$firstN . "_" . $midN . "_" . $lastN . "valid_id" . "." . $img_ex_lc;
     $img_upload_path = '../user/requests/birth_certificate/' . $new_birth_name;
     move_uploaded_file($valid_temp_name, $img_upload_path);
       
       
   }
   else{
       header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
   }
}
}



$stmt = $conn->prepare("INSERT INTO `senior_system`.`senior_tbl` (`status`, `full_name`, `first_name`, `mid_name`, `last_name`, `extension`, `date_birth`, `birth_place`, `age`, `sex`, `civil_status`, `citizenship`, `cell_no`, `senior_purok_id`, `senior_barangay_id`, `senior_municipality_id`, `senior_province_id`, `senior_email`, `senior_password`, `qr_image`, `id_pic`, `birth_certificate`, `bar_certificate`, `valid_id`, `account_time`, `account_date`, `qr_contents`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"); 
$stmt->bind_param("ssssssssssssiiiiissssssssss", $status, $full_name, $first_name, $middle_name, $last_name, $extension, $birth_date, $birth_place, $age, $sex, $civil_stat, $citizenship, $cell_no, $purok, $barangay, $municipality, $province, $email, $password, $fileName, $new_id_name, $new_birth_name, $new_bar_name, $new_valid_name, $account_time, $account_date, $codeContents);
$stmt->execute();

header("Location: admin_view_senior.php?add_senior='true'");

}


}
?>