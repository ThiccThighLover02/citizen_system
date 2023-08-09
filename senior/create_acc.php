<?php
  include("../db_connect.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Login Page</title>
    <link rel="stylesheet" href ="create.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="bruh">
    
    <div class="login_form">

      <a href="senior_login.php">
        <span class="material-symbols-outlined">
          arrow_back
        </span>
      </a>

      <h1 class="login_header">Create Account</h1>

      <form action="request_acc.php" method="post" class="login_info" enctype="multipart/form-data">

        <!-- Full Name -->
        <div>
            <label for="" class="label">Full Name:</label>
            <input type="text" class="input-fields" name="first_name" placeholder="First Name" required>
            <input type="text" class="input-fields" name="middle_name" placeholder="Middle Name(Leave blank if none)"> 
            <input type="text" class="input-fields" name="last_name" placeholder="Last Name" required> 
            <select name="extension" id="" class="input-fields">
              <option value="Extension" hidden>Extension</option>
              <option value="">None</option>
              <option value="I">I</option>
              <option value="II">II</option>
              <option value="III">II</option>
              <option value="IV">IV</option>
              <option value="V">V</option>
            </select> 
        </div>

        <!--Date of Birth and Place of birth-->
        <div>
            <label for="" class="label-email" required>Date of Birth:</label>
            <input type="date" class="input-fields" name="date_birth" placeholder="">
            <p class="age-error">You have to be 60 years and older to request for an account</p> 
        </div>

        <div>
            <label for="" class="label-email" required>Place of birth:</label>
            <input type="text" class="input-fields" name="place_birth" placeholder="Place of Birth"> 
        </div>

        <!--Other personal Information-->
        <div>
            <label for="" class="label-email">Other Personal Information:</label>
            <select name="sex" id="" class="input-fields" required>
              <option value="" hidden>Sex</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Rather not say">Rather not say</option>
            </select> 

            <select name="civil_status" id="" class="input-fields" required>
              <option value="Civil Status" hidden>Civil Status</option>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Divorced">Divorced</option>
              <option value="Married">Married</option>
            </select>

            <input type="text" class="input-fields" name="citizenship" placeholder="Citizenship"> 
            <input type="text" class="input-fields" name="email" placeholder="Email">
            <input type="text" class="input-fields" name="cell_no" placeholder="Cellphone Number"> 
        </div>

        <div>
            <label for="" class="label-email">Permanent Address:</label>
            <select name="purok" id="" class="input-fields">
              <option value="" hidden>Purok</option>

              <!-- this is for the purok select -->
              <?php
                $sql = mysqli_query($conn, "SELECT * FROM purok_tbl");
                while ($row = mysqli_fetch_array($sql)){

              ?>
              <option value="<?php echo $row['purok_id']?>"><?php echo $row['purok_no']?></option>
              <?php
                }
              ?>
            </select>

            <select name="barangay" id="" class="input-fields">
                <option value="" hidden>Barangay</option>
                <?php
                  $sql = mysqli_query($conn, "SELECT * FROM barangay_tbl");
                  while($row = mysqli_fetch_array($sql)) {
                ?>
                <option value="<?php echo $row['barangay_id'] ?>"><?php echo $row['barangay_name'] ?></option>
                <?php
                  }
                ?>
            </select>

            <select name="municipality" id="" class="input-fields" readonly>
              <option value="1" hidden>San Isidro</option>
            </select>
            
            <select name="province" id="" class="input-fields" readonly>
              <option value="1" hidden>Nueva Ecija</option>
            </select>
        </div>

        <div>
          <label for="" class="label-email">2x2 Picture</label>
          <input type="file" class="input-fields-picture" name="id_pic">   
        </div>

        <div>
          <label for="" class="label-email">Birth Certificate:</label>
          <input type="file" class="input-fields-picture" name="birth_certificate">
        </div>
        

        <input type="submit" value="Send Request" class="submit-button">

      </form>

    </div>
    
  </body>
</html>