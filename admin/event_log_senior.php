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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
      $active = "actEvent";
      include_once "admin_left_div.php";
        
      #Select all of the data in the senior table
      $sql = mysqli_query($conn, "SELECT * FROM event_log A INNER JOIN senior_tbl S ON A.act_senior_id = S.senior_id INNER JOIN action_tbl AC ON A.event_id = AC.action_id WHERE act_senior_id IS NOT NULL");
  
      #we will get the number of rows in the table
      $row_count = mysqli_num_rows($sql);
    
    ?>

    <script>
        console.log("<?= $row[''] ?>");
    </script>

    <div class="mid-div" id="orig-sen-tbl">
    <div class="log-header">
        <div class="emp-header" id="emp-header">
            <a href="event_log_emp.php">
            <button id="emp-button">Employee</button>
            </a>
        </div>
        <div class="senior-header" id="senior-header">
            <a href="event_log_senior.php">
            <button id="senior-button-active">Senior</button></a>
        </div>
    </div>

    <table class="log-table" id="search-result">
    <?php
        if($row_count > 0){
        ?>
        <thead class="table-head">
          <tr class="head-row">
            <th>By</th>
            <th>Action</th>
            <th>Action Date</th>
            <th>Action Time</th>
          </tr>
        </thead>
        <tbody class="table-body">
          <?php

            while($row = mysqli_fetch_array($sql)){
          
          ?>
          <tr class="body-row" id="body-row">
            <td><?= $row['first_name'] . " " . $row['last_name']?></td>
            <td><?= $row['action_done'] ?></td>
            <td><?= $row['act_date'] ?></td>
            <td><?= $row['act_time'] ?></td>
          </tr>
          <?php
            }
        ?>
        </tbody>
        <?php
        }

        elseif($row_count == 0){
        ?>
        <h1>Nothing has happened yet</h1>
        <?php
        }
          ?>
      </table>

    </div>


    <div class="right-div-log">

        <select name="sort by" id="">
            <option value="" hidden>Sort by</option>
            <option value="action">Action</option>
            <option value="name">Name</option>
            <option value="date-asc">Date(asc)</option>
            <option value="date-desc">Date (desc)</option>

        </select>
        <button>Apply Filter</button>

    </div>

  </div>
  

  </body>

  <script>
    <?php
      if(isset($_GET['add_senior']) == "true"){
        echo "alert('The senior has been added successfully');";
      }
    ?>
  </script>

</html>