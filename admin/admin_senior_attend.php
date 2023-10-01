<?php
  include "../db_connect.php";
  include "../req_count.php";

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
    <script src="../node_modules//html5-qrcode/html5-qrcode.min.js"></script> <!-- call the script that we will use to scan the qr code -->
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
    

    <div class="mid-div-requests">

        <div id="reader" style="width: 80%; height: 90%"></div>
        <div id="result"></div>

    </div>

    <div class="right-div">
      <!-- bar chart starts here
      <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
      <script>
        
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
       bar chart ends here -->
      <a href="admin_senior_attend.php" class="link">
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
  
    const scanner = new Html5QrcodeScanner('reader', {
    qrbox: {
      width:250,
      height: 250,
    },
    fps:20, 
    });

  scanner.render(success, error);

  function success(result) {
      scanner.clear();
      var scan_result = result;
      console.log(scan_result);
      window.location.href="senior_scan.php?scan=" + result + "&act_id=" + <?= $_GET['act_id'] ?>;
  }


  function error(err){
    console.error(err);
  }
  </script>


</html>