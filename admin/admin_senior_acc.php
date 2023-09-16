<?php
  include "../db_connect.php";
  include "../req_count.php";
  #get the request id from the url
  $senior_id = $_GET['id'];

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

    <!-- left div goes here -->
    <?php
      $active = "actSenior";
      include_once "admin_left_div.php";
    ?>
    
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

    <button class="right-div-buttons">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              delete
          </span>
        </div>
        <p class="right-p">Delete Senior</p>
      </button>

      <button class="right-div-buttons" onclick="view_senior()">
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
    function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=1600, height=900, toolbar=800, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
}
  </script>

</html>