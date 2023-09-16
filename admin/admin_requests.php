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
    <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="background">
  <div class="top-nav">
    <h1>Senior Citizen System</h1>
  </div>

  <div class="main-div">
    <!-- left div goes here -->

    <?php
      $active = "actRequest";
      include_once "admin_left_div.php";
    ?>
    
    <?php
      $sql = mysqli_query($conn, "SELECT * FROM request_tbl ORDER BY request_date DESC, request_time ASC");

    ?>

    <div class="mid-div-only">
      <div class="request-header">
        <h1>Requests</h1>
      </div>
      <?php
      while($row = mysqli_fetch_array($sql)){

        $date_format = new DateTime($row['request_date'] . $row['request_time']);

      ?>
      <div class="in-mid">
        <div>
          <a href="admin_view_requests.php?request_id=<?php echo $row['request_id']; ?>"><input type="button" value="View Request" class="view-button"></a>
        </div>
        <div>
          <h3 class="request-head"><?php echo $row['first_name'] . " " . $row['last_name'] . " is requesting for an account" ?></h3>
        </div>
        <div>
          <h3 class="request-head"><?= $date_format->format("M-d-Y / h:ia") ?></h3>
        </div>
      </div>

      <?php
      }
      ?>

    </div>

  </div>
  

  </body>
</html>