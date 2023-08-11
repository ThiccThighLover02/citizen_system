<?php
    include('../db_connect.php');
   #declare all of the variables that we will use

  date_default_timezone_set("Asia/Manila");

   $firstN = $_POST['first_name'];
   $midN = $_POST['middle_name'];
   $lastN = $_POST['last_name'];
   $extension = $_POST['extension'];
   $full_name = $firstN . " " . $midN . " " . $lastN;
   $birth_date = $_POST['date_birth'];
   $birth_place = $_POST['place_birth'];
   $sex = $_POST['sex'];
   $civil_stat = $_POST['civil_status'];
   $citizen = $_POST['citizenship'];
   $cellno = $_POST['cell_no'];
   $purok = $_POST['purok'];
   $barangay = $_POST['barangay'];
   $municipality = $_POST['municipality'];
   $province = $_POST['province'];
   $email = $_POST['email'];
   $request_date = date("Y-m-d");
   $request_time = date("H:i:s");
   
  #this will compute the seniors age
  $birthday = $_POST['date_birth'];

  $birthday = new DateTime($birthday);
  $interval = $birthday->diff(new DateTime);
  $age = $interval->y;

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
          $new_birth_name =$firstN . "_" . $midN . "_" . $lastN . "birth_cert" . "." . $img_ex_lc;
          $img_upload_path = '../user/requests/birth_certificate/' . $new_birth_name;
          move_uploaded_file($birth_temp_name, $img_upload_path);
            
            
        }
        else{
            header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
        }
    }
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
          $new_id_name =$firstN . "_" . $midN . "_" . $lastN . "id_pic" . "." . $img_ex_lc;
          $img_upload_path = '../user/requests/id_pics/' . $new_id_name;
          move_uploaded_file($id_tmp_name, $img_upload_path);
            
            
        }
        else{
         header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
        }
    }
}
   

  if ($age < 60) {
    header("Location: create_acc.php?age=false");
  }

  elseif ($birth_size && $id_size > 16777215){
    header("Location: create_acc.php?img_size=false"); #this will execute if the image size is too large
   }

  elseif (in_array($img_ex_lc, $allowed_exs) == false) {
    header("Location: create_acc.php?img_ex=false"); #this will execute if the file is not a jpeg or png
  }

  else {
    $sql = mysqli_query($conn, "SELECT * FROM senior_tbl WHERE full_name='$full_name'");

    if(mysqli_num_rows($sql) > 0){
      header("Location: create_acc.php?exist=true");
    }

    else {
    
      $stmt_request = $conn->prepare("INSERT INTO  request_tbl(`first_name`, `middle_name`, `last_name`, `extension`, `birth_date`, `place_birth`, `sex`, `civil_status`, `citizenship`, `purok_id`, `barangay_id`, `municipality_id`, `province_id`, `birth_certificate`, `id_pic`, `cell_no`, `senior_email`, `age`, `request_date`, `request_time`) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt_request->bind_param("sssssssssssssssisiss", $firstN, $midN, $lastN, $extension, $birth_date, $birth_place, $sex, $civil_stat, $citizen, $purok, $barangay, $municipality, $province, $new_birth_name, $new_id_name, $cellno, $email, $age, $request_date, $request_time);
      $stmt_request->execute();

      $em = "sent";
      header("Location: senior_login.php?request=$em");
  }
}