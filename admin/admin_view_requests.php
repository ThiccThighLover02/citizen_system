<?php
  include "../db_connect.php";

  #get the request id from the url
  $request_id = $_GET['request_id'];

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Home Page</title>
    <script src="admin_script.js"></script>
    <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="background">
  <div class="top-nav">
    <h1>Senior Citizen System</h1>
  </div>

  <div class="main-div">

    <div class="left-div">
    <button class="left-button" style="border-top-left-radius: 15px; border-top-right-radius: 15px;"><img src="id_pics/2x2 pic.jpg" alt="" class="profile-pic">
        <p>Profile</p>
      </button>

      <button class="left-button" onclick="home_function()">
        <span class="material-symbols-outlined">
          home
        </span>
        <p>Home</p>
      </button>

      <button class="left-button" onclick="view_emp()" >
        <span class="material-symbols-outlined">
          person
        </span>
        <p>Users</p>
      </button>

      <button class="left-button" onclick="view_senior()">
        <span class="material-symbols-outlined">
          elderly
        </span>
        <p>Seniors</p>
      </button>

      <button class="left-button" id="Active" onclick="view_requests()">
        <span class="material-symbols-outlined">
          description
        </span>
        <p>Requests</p>
      </button>

      <button class="left-button" onclick="scan_function()">
        <span class="material-symbols-outlined">
          qr_code
        </span>
        <p>Scan QR code</p>
      </button>

      <button class="logout-button" onclick="logout_function()">
        <span class="material-symbols-outlined">
          logout
        </span>
        <p>Logout</p>
      </button>
    </div>
    
    <?php

        #create a prepared statement to get the request details using the id
        $stmt = $conn->prepare("SELECT * FROM request_tbl R RIGHT JOIN purok_tbl P ON R.purok_id = P.purok_id
        RIGHT JOIN barangay_tbl B ON R.barangay_id = B.barangay_id RIGHT JOIN municipality_tbl M ON R.municipality_id = M.municipality_id
        RIGHT JOIN  province_tbl PR ON R.province_id = PR.province_id WHERE request_id=?");
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result);

    ?>

    <div class="mid-div-requests">
        <img src="../user/id_pics/<?php echo $row['id_pic'] ?>" alt="" class="request-img">

        <div class="request-details">
            <div>
            <h3 class="detail-head">Name: </h3>
            <p class="request-info"><?php echo $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] . " " . $row['extension']; ?></p>
            </div>
            <div>
            <h3 class="detail-head">Address: </h3>
            <p class="request-info"><?php echo $row['purok_no'] . ", " . $row['barangay_name'] . ", " . $row['municipality_name'] . ", " . $row['province_name']; ?></p>
            </div>
            <div>
            <h3 class="detail-head">Birthdate: </h3>
            <p class="request-info"><?php echo $row['birth_date']?></p>
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
      <div class="attachment" id="myBtn">
        <div class="attach-prev">
          <img src="../user/birth_certificate/Lester_The_Catid_pic_04-25-08-03.jpg" alt="" class="attach-image">
        </div>
        <div class="attach-foot">
          Preview Images
        </div>
      </div>
      <div>
      <a href="../add_senior.php?request_id=<?= $row['request_id']?>">
        <button class="right-div-buttons-req" id="accept" onclick="accept_function()">
          <p class="right-p">Accept Request</p>
        </button>
      </a>
      </div>
      <div>
      <button class="right-div-buttons-req" id="reject" onclick="reject_function()">
        <p class="right-p">Decline Request</p>
      </button>
      </div>
    </div>

  </div>
  

  </body>

  <script>
    // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

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

function add_function(){
  window.location.href="../add_senior.php?request_id=<?= $row['request_id'] ?>"
}
  </script>

</html>