<?php
  session_start();
  include "../db_connect.php";

  if(isset($_SESSION['emp_status']) && $_SESSION['emp_status'] == "Active"){
    $this_emp = $conn->prepare("SELECT id_pic FROM emp_tbl WHERE emp_id=?");
      $this_emp->bind_param("i", $_SESSION['emp_id']);
      $this_emp->execute();
      $emp_result = $this_emp->get_result();

      $emp_row = mysqli_fetch_assoc($emp_result);

      $senior_id = $_GET['id'];

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Login Page</title>
    <script src="user_script.js"></script>
    <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="background">
  <div class="top-nav">
    <h1>Senior Citizen System</h1>
  </div>

  <div class="main-div">

    <div class="left-div">
      <button class="left-button" style="border-top-left-radius: 15px; border-top-right-radius: 15px;"><img src="../admin/user_pics/<?= $emp_row['id_pic'] ?>" alt="" class="profile-pic">
        <p>Profile</p>
      </button>

      <button class="left-button" onclick=senior_function()>
        <span class="material-symbols-outlined">
          elderly
        </span>
        <p>Seniors</p>
      </button>

      <button class="left-button" onclick=request_function()>
        <span class="material-symbols-outlined">
          description
        </span>
        <p>Requests</p>
      </button>

      <button class="left-button" onclick=EventFunction()>
        <span class="material-symbols-outlined">
          event
        </span>
        <p>Events</p>
      </button>

      <button class="logout-button" onclick=logout_function()>
        <span class="material-symbols-outlined">
          logout
        </span>
        <p>Logout</p>
      </button>
    </div>
    
    <?php

        #create a prepared statement to get the request details using the id
        $stmt = $conn->prepare("SELECT * FROM senior_tbl S RIGHT JOIN purok_tbl P ON S.senior_purok_id = P.purok_id
        RIGHT JOIN barangay_tbl B ON S.senior_barangay_id = B.barangay_id RIGHT JOIN municipality_tbl M ON S.senior_municipality_id = M.municipality_id
        RIGHT JOIN  province_tbl PR ON S.senior_province_id = PR.province_id WHERE senior_id=?");
        $stmt->bind_param("i", $senior_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result);

    ?>

    <div class="mid-div-requests">
        <img src="../senior/senior_pics/id_pics/<?php echo $row['id_pic'] ?>" alt="" class="request-img">

        <div class="request-details">
            <div>
            <h3 class="detail-head">Name: </h3>
            <p class="request-info"><?php echo $row['first_name'] . " " . $row['mid_name'] . " " . $row['last_name'] . " " . $row['extension']; ?></p>
            </div>
            <div>
            <h3 class="detail-head">Address: </h3>
            <p class="request-info"><?php echo $row['purok_no'] . ", " . $row['barangay_name'] . ", " . $row['municipality_name'] . ", " . $row['province_name']; ?></p>
            </div>
            <div>
            <h3 class="detail-head">Birthdate: </h3>
            <p class="request-info"><?php echo $row['date_birth']?></p>
            </div>
            <div>
            <h3 class="detail-head">Age: </h3>
            <p class="request-info"><?php echo $row['age']?></p>
            </div>
            <div>
            <h3 class="detail-head">Citizenship: </h3>
            <p class="request-info"><?php echo $row['citizenship']?></p>
            </div>
            <div>
            <h3 class="detail-head">Civil Status: </h3>
            <p class="request-info"><?php echo $row['civil_status']?></p>
            </div>
            <div>
            <h3 class="detail-head">Sex: </h3>
            <p class="request-info"><?php echo $row['sex']?></p>
            </div>
            <div>
            <h3 class="detail-head">Contact No: </h3>
            <p class="request-info"><?php echo str_pad($row['cell_no'], 13, '+63', STR_PAD_LEFT);?></p>
            </div>
            
            <!-- this is the modal for the birth certificate -->
            <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
              <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Birth Certificate</h2>
              </div>
              <div class="modal-body">
                <img src="../user/birth_certificate/Lester_The_Catid_pic_04-25-08-03.jpg" alt="">
              </div>
            </div> 

            </div>
        </div>
      

    </div>

    <div class="right-div">
    <button class="right-div-buttons" onclick="printExternal('../id_layout.php?id=<?= $row['senior_id'] ?>')">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              print
          </span>
        </div>
        <p class="right-p">Print ID</p>
      </button>

    <button class="right-div-buttons" onclick="delete_senior()">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              delete
          </span>
        </div>
        <p class="right-p">Delete Senior</p>
      </button>

      

      <button class="right-div-buttons" onclick="senior_function()">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              arrow_back
          </span>
        </div>
        <p class="right-p">Return to table</p>
      </button>
    </div>

  </div>
  

  </body>
  <script>
        // Get the modal
    var modal = document.getElementById("postModal");

    // Get the button that opens the modal
    var btn = document.getElementById("create-button");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    function delete_senior(e) {
      if(confirm("Do you want to delete this senior?") == true){
        window.location.href="delete_senior.php?id=<?= $row['senior_id'] ?>";
      }

      else{
        e.preventDefault();
      }
  } 

  

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=1600, height=900, toolbar=800, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
}

    
  </script>
</html>

<?php
  }
  else{
    header("Location: user_login.php");
  }

?>