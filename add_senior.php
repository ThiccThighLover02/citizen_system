<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'vendor/phpmailer/phpMailer/src/Exception.php';
    require 'vendor/phpmailer/phpMailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpMailer/src/SMTP.php';
    include "db_connect.php";

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
   $password = date("Y") . "-" . uniqid();
   $date_created = date("Y-m-d");
   $time_created = date("H:i:s");
   $status = "Inactive";


   #this will generate the qr code for this account
    include('phpqrcode/qrlib.php');
    $tempDir = 'senior/senior_pics/qr_codes/';

    $codeContents = uniqid();

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
   
$birth_original = "user/requests/birth_certificate/" . $row['birth_certificate'];
$birth_new_path = "senior/senior_pics/birth_certificates/" . $row['birth_certificate'];
$id_original = "user/requests/id_pics/" . $row['id_pic'];
$id_new_path = "senior/senior_pics/id_pics/" . $row['id_pic'];

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
    unlink($id_new_path . $row['birth_certificate']);
    move_uploaded_file($id_original, $id_new_path);
}



$stmt = $conn->prepare("INSERT INTO `senior_system`.`senior_tbl` (`status`, `full_name`, `first_name`, `mid_name`, `last_name`, `extension`, `date_birth`, `birth_place`, `sex`, `civil_status`, `citizenship`, `cell_no`, `purok_id`, `barangay_id`, `municipality_id`, `province_id`, `senior_email`, `senior_password`, `qr_image`, `id_pic`, `birth_certificate`, `account_time`, `account_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"); 
$stmt->bind_param("sssssssssssiiiiisssssss", $status, $full_name, $first_name, $middle_name, $last_name, $extension, $birth_date, $birth_place, $sex, $civil_status, $citizenship, $cell_no, $purok, $barangay, $municipality, $province, $email, $password, $fileName, $row['id_pic'], $row['birth_certificate'], $time_created, $date_created);
$stmt->execute();

$stmt = $conn->prepare("DELETE FROM request_tbl WHERE request_id=?");
$stmt->bind_param("i", $_GET['request_id']);
$stmt->execute();



$subject = "Account Approval";
$message = "Hello " . $firstN . " " . $lastN . ", your account has been approved. <br> You may proceed to the senior login page and enter the following credentials:<br>

<h1>" . "Email: " . $email . "</h1> <br>
<h1>" . "Password: " . $senior_password . "</h1>" ;

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

      header("Location: emp_view_user.php?senior_added=true");

}

else {
    header("Location: admin/admin_requests.php?false=true");
}