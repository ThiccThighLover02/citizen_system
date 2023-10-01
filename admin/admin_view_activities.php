<?php
  include "../db_connect.php";
  include "../req_count.php";
  #get the request id from the url
  $activity_id = $_GET['event'];

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Home Page</title>
    <script src="admin_script.js"></script>
    <!-- this is for the bar chart -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
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
        $stmt = $conn->prepare("SELECT * FROM activity_tbl A INNER JOIN type_tbl T ON A.event_type_id = T.type_id WHERE post_id=?");
        $stmt->bind_param("i", $activity_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result);

        $timeFormat = new DateTime($row['post_time']);
        $new_time_format = $timeFormat->format("M-d-Y");

    ?>

    <div class="mid-div-requests" id="parent-div">
    <img src="../user/posts/post_pics/<?= $row['post_pic'] ?>" alt="Avatar" class="request-img">

        <div class="request-details">
            <div>
            <h3 class="detail-head">Event Type: </h3>
            <p class="request-info"><?= $row['type_name'] ?></p>
            </div>

            <div>
            <h3 class="detail-head">Event Address: </h3>
            <p class="request-info"><?= $row['post_loc'] ?></p>
            </div>

            <div>
            <h3 class="detail-head">Event Date and Time: </h3>
            <p class="request-info"><?= $new_time_format ?></p>
            </div>
            
        </div>

        <div class="calendar">
          <!-- bar chart starts here -->
      <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
      <script>
        <?php
          /*select all of the seniors from all of the barangays
          $sql_alua = mysqli_query($conn, "SELECT senior_attend FROM attend_tbl WHERE senior_barangay='1'");
          $sql_calaba = mysqli_query($conn, "SELECT senior_attend FROM attend_tbl WHERE senior_barangay='2'");
          $sql_malapit = mysqli_query($conn, "SELECT senior_attend FROM attend_tbl WHERE senior_barangay='3'");
          $sql_mangga = mysqli_query($conn, "SELECT senior_attend FROM attend_tbl WHERE senior_barangay='4'");
          $sql_poblacion = mysqli_query($conn, "SELECT senior_attend FROM attend_tbl WHERE senior_barangay='5'");
          $sql_pulo = mysqli_query($conn, "SELECT senior_attend FROM attend_tbl WHERE senior_barangay='6'");
          $sql_roque = mysqli_query($conn, "SELECT senior_attend FROM attend_tbl WHERE senior_barangay='7'");
          $sql_cristo = mysqli_query($conn, "SELECT senior_attend FROM attend_tbl WHERE senior_barangay='8'");
          $sql_tabon = mysqli_query($conn, "SELECT senior_attend FROM attend_tbl WHERE senior_barangay='9'");

          $alua_rows = mysqli_num_rows($sql_alua);
          $calaba_rows = mysqli_num_rows($sql_calaba);
          $malapit_rows = mysqli_num_rows($sql_malapit);
          $mangga_rows = mysqli_num_rows($sql_mangga);
          $poblacion_rows = mysqli_num_rows($sql_poblacion);
          $pulo_rows = mysqli_num_rows($sql_pulo);
          $roque_rows = mysqli_num_rows($sql_roque);
          $cristo_rows = mysqli_num_rows($sql_cristo);
          $tabon_rows = mysqli_num_rows($sql_tabon);
          */
          
        ?>
        //These are the barangays in the municipality of San Isidro
        var xValues = ["Alua", "Calaba", "Malapit", "Mangga", "Poblacion", "Pulo", "San Roque", "Santo Cristo", "Tabon"];
        var yValues = [<?= $alua_rows ?>, 1, <?= $malapit_rows ?>, <?= $mangga_rows ?>, <?= $poblacion_rows ?>, <?= $pulo_rows ?>, <?= $roque_rows ?>, <?= $cristo_rows ?>, <?= $tabon_rows ?>];
        var barColors = "red";

        console.log(<?= $alua_rows ?>)
        
        new Chart("myChart", {
          type: "bar",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            legend: {display: false},
            title: {
              display: true,
              text: "Attendance from different barangays"
            }
          }
        });

      </script>
        </div>
      

    </div>

    <div class="right-div">
       
      <a href="admin_senior_attend.php?act_id=<?= $activity_id ?>" class="link">
        <button class="right-div-buttons">
          <div class="right-div-button-div">
            <span class="material-symbols-outlined" id="right-button">
                how_to_reg
            </span>
          </div>
          <p class="right-p">Senior Attend</p>
        </button>
      </a>
      

      <a href="admin_activities.php" class="link">
        <button class="right-div-buttons">
          <div class="right-div-button-div">
            <span class="material-symbols-outlined" id="right-button">
                arrow_back
            </span>
          </div>
          <p class="right-p">Return to Activities</p>
        </button>
      </a>
    </div>

  </div>
  

  </body>

  <script>
    <?php
      if(isset($_GET['scan']) && $_GET['scan'] == 'fail'){
    ?>

    alert("Senior may not exist, or qr code is invalid");

    <?php
      }
      elseif(isset($_GET['scan']) && $_GET['scan'] == 'success'){
    ?>
    
      alert("Senior has successfully been scanned and recorded for this event");

    <?php
      }
    ?>

    function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=1600, height=900, toolbar=800, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
}


  </script>

</html>