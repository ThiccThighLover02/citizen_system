<?php
  include("../db_connect.php");
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Login Page</title>
    <link rel="stylesheet" href ="../senior/create.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="bruh">
    
    <div class="login_form">
      <a href="user_view_senior.php">
        <span class="material-symbols-outlined">
          arrow_back
        </span>
      </a>

      <h2 class="login_header">Create Account</h2>

      <form action="add_senior.php?add_senior=true" method="post" class="login_info" enctype="multipart/form-data" id="create-form">

        <!-- Full Name -->
        <div>
            <label for="" class="label-email">Full Name:</label>
            <input type="text" class="input-fields" name="first_name" placeholder="First Name" required>
            <input type="text" class="input-fields" name="middle_name" placeholder="Middle Name(Leave blank if none)"> 
            <input type="text" class="input-fields" name="last_name" placeholder="Last Name" required> 
            <select name="extension" id="" class="input-fields">
              <option value="Extension" hidden>Extension</option>
              <option value="">None</option>
              <option value="Jr.">Jr.</option>
              <option value="I">I</option>
              <option value="II">II</option>
              <option value="III">II</option>
              <option value="IV">IV</option>
              <option value="V">V</option>
            </select> 
        </div>

        <!--Date of Birth and Place of birth-->
        <div>
            <label for="" class="label-email" >Date of Birth:</label>
            <input type="date" class="input-fields" name="date_birth" placeholder="" id="date-birth" required>
            <p class="age-error">You have to be 60 years and older to request for an account</p> 
        </div>

        <div>
            <label for="" class="label-email" >Place of birth:</label>
            <input type="text" class="input-fields" name="place_birth" placeholder="Place of Birth" required> 
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

            <input type="text" class="input-fields" name="citizenship" placeholder="Citizenship" required> 
            <input type="text" class="input-fields" name="email" placeholder="Email" required>
            <input type="text" class="input-fields" name="cell_no" placeholder="Cellphone Number" required> 
        </div>

        <div>
            <label for="" class="label-email">Permanent Address:</label>
            <select name="purok" id="" class="input-fields" required>
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
          <input type="file" class="input-fields-picture" name="id_pic" id="twobytwo" required> 
          <p id="pic-type-error" style="display:none;">This is not a jpeg file</p>  
        </div>

        <div>
          <label for="" class="label-email">Birth Certificate</label>
          <input type="file" class="input-fields-picture" name="birth_certificate" id="birth-certificate" required>
          <p id="birth-type-error" style="display:none;">This is not a jpeg file</p>
        </div>

        

        <input type="submit" value="Send Request" class="submit-button" id="submit">

      </form>

    </div>
    
  </body>

  <script>
    
    let file = document.getElementById("twobytwo");
    let file_error = document.getElementById("pic-type-error");
    let birth = document.getElementById("birth-certificate");
    let birth_error = document.getElementById("birth-type-error");
    const submit_butt = document.getElementById("create-form");

    submit_butt.addEventListener("submit", (e)=>{


      //first we have to get the date input to calculate the age
      const birth_input = document.getElementById("date-birth").value;
      const birth_val = new Date(birth_input);

      //well have to calculate the month difference first
      const month_diff = Date.now() - birth_val;

      // convert the calculated difference in date format
      const age_dt = new Date(month_diff);

      //extract year from date then calculate the age of the user
      const year = age_dt.getUTCFullYear();
      const age = Math.abs(year - 1970);
      console.log(age);

      if(confirm("Do you want to add this senior?") == true){
        if(age < 60){
        alert("You are less than 60 years old, you are not qualified to create an account");
        e.preventDefault();
        }

      }

      else{
        e.preventDefault();
      }

    });

    file.addEventListener("input", ()=> {
      if(file.files.length) {
        let file_extension = file.files[0].name.split(".").pop();
        console.log(file_extension);

        if(file_extension != "jpg" && file_extension != "jpeg"){
          file_error.style.display = "block";
          console.log("This is not packing jpeg");
        }

        else {
          file_error.style.display = "none";
        }
        
      }
    });

    birth.addEventListener("input", ()=>{
      if(birth.files.length) {
        let birth_extension = birth.files[0].name.split(".").pop();
        console.log(birth_extension);

        if(birth_extension != "jpg" && birth_extension != "jpeg"){
          birth_error.style.display = "block";
          console.log("This is not packing jpeg");
        }

        else {
          birth_error.style.display = "none";
        }
        
      }
    })
    
    

  </script>
</html>