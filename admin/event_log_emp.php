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
      if(isset($_GET['filter']) && $_GET['filter'] == 'Action'){
        $sql = mysqli_query($conn, "SELECT * FROM event_log A INNER JOIN emp_tbl E ON A.act_emp_id = E.emp_id INNER JOIN action_tbl AC ON A.action_id = AC.action_id WHERE act_emp_id IS NOT NULL ORDER BY action_done");
      }

      elseif(isset($_GET['filter']) && $_GET['filter'] == 'Name'){
        $sql = mysqli_query($conn, "SELECT * FROM event_log A INNER JOIN emp_tbl E ON A.act_emp_id = E.emp_id INNER JOIN action_tbl AC ON A.event_id = AC.action_id WHERE act_emp_id IS NOT NULL ORDER BY full_name");
      }

      elseif(isset($_GET['filter']) && $_GET['filter'] == 'DateAsc'){
        $sql = mysqli_query($conn, "SELECT * FROM event_log A INNER JOIN emp_tbl E ON A.act_emp_id = E.emp_id INNER JOIN action_tbl AC ON A.event_id = AC.action_id WHERE act_emp_id IS NOT NULL ORDER BY act_date ASC");
      }

      elseif(isset($_GET['filter']) && $_GET['filter'] == 'DateDes'){
        $sql = mysqli_query($conn, "SELECT * FROM event_log A INNER JOIN emp_tbl E ON A.act_emp_id = E.emp_id INNER JOIN action_tbl AC ON A.event_id = AC.action_id WHERE act_emp_id IS NOT NULL ORDER BY act_date DESC");
      }

      else {
        header("Location: event_log_emp.php?filter=Action");
      }

      #we will get the number of rows in the table
      $row_count = mysqli_num_rows($sql);
    
    ?>

    <div class="mid-div" id="orig-sen-tbl">
    <div class="log-header">
        <div class="emp-header" id="emp-header">
            <a href="event_log_emp.php">
            <button id="emp-button-active">Employee</button>
            </a>
        </div>
        <div class="senior-header" id="senior-header">
            <a href="event_log_senior.php">
            <button id="senior-button">Senior</button></a>
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
              
              $new_time = date("H:i:s A", strtotime($row['act_time']));
          
          ?>
          <tr class="body-row" id="body-row">
            <td><?= $row['first_name'] . " " . $row['last_name']?></td>
            <td><?= $row['action_done'] ?></td>
            <td><?= $row['act_date'] ?></td>
            <td><?= $new_time ?></td>
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

        <form action="" method="get">
          <select name="filter" id="">
              <option value="" hidden>Sort by</option>
              <option value="Action">Action</option>
              <option value="Name">Name</option>
              <option value="DateAsc">Date(asc)</option>
              <option value="DateDes">Date (desc)</option>

          </select>
          <input type="submit" value="Apply Filter">
        </form>


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