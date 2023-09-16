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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
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
      $active = "actActivity";
      include_once "admin_left_div.php";
    ?>
    
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
      
    <!-- Slideshow container -->
    <div class="slideshow-container">

<!-- Full-width images with number and caption text -->

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="../user/requests/id_pics/Carlson_San Nicolas_Magtalasid_pic.jpg" style="width:100%">
  <div class="text">Birth Certificate</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="../user/requests/id_pics/Carlson_San Nicolas_Magtalasid_pic.jpg" style="width:100%">
  <div class="text">Barangay Certificate</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="../user/requests/id_pics/Carlson_San Nicolas_Magtalasid_pic.jpg" style="width:100%">
  <div class="text">Valid ID</div>
</div>

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
<span class="dot" onclick="currentSlide(1)"></span>
<span class="dot" onclick="currentSlide(2)"></span>
<span class="dot" onclick="currentSlide(3)"></span>
</div>

    </div>

    <div class="right-div-chart">
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
const xValues = ["Pulo", "Tabon", "Alua", "Malapit", "Sto Cristo"];
const yValues = [100, 80, 60, 40, 20, 0];
const attendants = [1000, 25, 43, 23, 500];
const barColors = "red";

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: attendants
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "World Wine Production 2018"
    }
  }
});
</script>
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