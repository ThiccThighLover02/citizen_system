<?php
  include "../db_connect.php";
  include "../req_count.php";


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Seniors</title>
    <script src="admin_script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
    #Select all of the data in the senior table

    $row_sql = mysqli_query($conn, "SELECT * FROM senior_log LIMIT 8");

    $row_count = mysqli_num_rows($row_sql);
    ?>
    <?php
        if($row_count == 0){
          $disabled = "";
    ?>
    <div class="mid-div-empty">
      <div class="empty">
        <h1>There are no Seniors Here</h1>
      </div>
      <script>
        console.log(<?= $row_count ?>);
      </script>
    </div>
      <?php
        }
        elseif($row_count > 0){

      ?>
    <div class="mid-div" id="orig-sen-tbl">

    <table class="senior-table" id="search-result">
        <thead class="table-head">
          <tr>
            <th>Senior No.</th>
            <th>Name</th>
            <th>Login</th>
            <th>Logout</th>
          </tr>
        </thead>
        <tbody class="table-body">
          <?php

            while($row = mysqli_fetch_array($row_sql)){
              $date_in = new DateTime($row['login_date'] . $row['login_time']);
              $date_out = new DateTime($row['out_date'] . $row['out_time']);
          
          ?>
          <tr>
            <td><?=str_pad($row['senior_id'], 6, '0', STR_PAD_LEFT); ?></td>
            <td><?= $row['login_name'] ?></td>
            <td><?= $date_in->format("M d, Y . h:i:sa") ?></td>
            <td><?= $date_out->format("M d, Y . h:i:sa") ?></td>
          </tr>
          <?php
          $disabled = "admin_senior_search.php";
            }
          ?>
        </tbody>
      </table>

    </div>

    <?php
        }
    ?>

    <div class="right-div">

      <a href="admin_view_senior.php" class="link">
      <button class="right-div-buttons" onclick="logs_function()">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              arrow_back
          </span>
        </div>
        <p class="right-p">Return to Table</p>
      </button>
      </a>

    </div>

  </div>
  

  </body>

</html>