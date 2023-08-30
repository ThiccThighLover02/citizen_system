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

    <div class="left-div">

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

      <button class="left-button" onclick="view_requests()">
        <span class="material-symbols-outlined">
          description
        </span>
        <p>Requests</p>
        <?php
          if($row_count > 0){

        ?>
        <div id="req-notif">
          <?= $row_count ?>
        </div>
        <?php
          }
        ?>
      </button>

      <button class="left-button" onclick="event_logs()" id="Active">
        <span class="material-symbols-outlined">
          menu_book
        </span>
        <p>Event Logs</p>
      </button>

      <button class="logout-button" onclick="logout_function()">
        <span class="material-symbols-outlined">
          logout
        </span>
        <p>Logout</p>
      </button>
    </div>

    <?php
    #Select all of the data in the senior table
    $sql = mysqli_query($conn, "SELECT * FROM activity_tbl A INNER JOIN emp_tbl E ON A.act_emp_id = E.emp_id INNER JOIN action_tbl AC ON A.action_id = AC.action_id WHERE act_emp_id IS NOT NULL");

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