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

      <form action="login_check.php" class="login_info">

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
            <input type="text" class="input-fields" name="cell_no" placeholder="Cellphone Number"> 
        </div>

        <div>
            <label for="" class="label-email">Permanent Address:</label>
            <select name="" id="" class="input-fields">
              <option value="" hidden>Purok</option>
            </select>
        </div>

        <div>
          <label for="" class="label-email">2x2 Picture</label>
          <input type="file" class="input-fields-picture" name="pic">   
        </div>

        <div>
          <label for="" class="label-email">Birth Certificate:</label>
          <input type="file" class="input-fields-picture" name="birth_certificate">bruh
        </div>
        

        <input type="submit" value="Create Account" class="submit-button">

      </form>

    </div>
    
  </body>
</html>