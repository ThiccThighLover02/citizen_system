<?php
  include "../db_connect.php";

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
      $sql = mysqli_query($conn, "SELECT * FROM request_tbl");

    ?>

    <div class="mid-div-only">
      <?php
      while($row = mysqli_fetch_array($sql)){

      ?>
      <div class="in-mid">
      <a href="admin_view_requests.php?request_id=<?php echo $row['request_id']; ?>"><input type="button" value="View Request" class="view-button"></a>
      <h3 class="request-head"><?php echo $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] . " is requesting for an account" ?></h3>
      <h3 class="request-head"><?php echo $row['request_date'] . "/" . $row['request_time']; ?></h3>
      </div>

      <?php
      }
      ?>

    </div>

  </div>
  

  </body>
</html>