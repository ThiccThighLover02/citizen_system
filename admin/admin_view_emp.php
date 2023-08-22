<?php
  include "../db_connect.php";
  include "../req_count.php";


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View Emp</title>
    <script src="admin_script.js"></script>
    <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="background">
  <div class="top-nav">
    <h1>View Employees</h1>
  </div>

  <div class="main-div">

    <div class="left-div">
      

      <button class="left-button" onclick="home_function()">
        <span class="material-symbols-outlined">
          home
        </span>
        <p>Home</p>
      </button>

      <button class="left-button" id="Active" onclick="view_emp()" >
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

      <button class="logout-button" onclick="logout_function()">
        <span class="material-symbols-outlined">
          logout
        </span>
        <p>Logout</p>
      </button>
    </div>
    <?php 
      #Select all of the data in the emp table
      $sql = mysqli_query($conn, "SELECT * FROM emp_tbl");

      $row_count = mysqli_num_rows($sql);

      if($row_count == 0) {

    ?>
    <div class="mid-empty">
      <h1>There are no employees yet</h1>
    </div>
    <?php
      }
      elseif($row_count > 0) {

    ?>
    <div class="mid-div">
      <table class="senior-table" id="emp-tbl">
        <thead class="table-head">
          <tr>
            <th>Senior No.</th>
            <th>Status</th>
            <th>Name</th>
            <th>Users: <?= $row_count ?></th>
          </tr>
        </thead>
        <tbody class="table-body">
          <?php

            while($row = mysqli_fetch_array($sql)){
              $birthday = $row['birth_date'];
              $birthday = new DateTime($birthday);
              $interval = $birthday->diff(new DateTime);
              $age = $interval->y;
          
          ?>
          <tr>
            <td><?=str_pad($row['emp_id'], 6, '0', STR_PAD_LEFT); ?></td>
            <td class="stats"><div class="<?= $row['status'] ?>"></div><?= $row['status'] ?> </td>
            <td><?= $row['full_name'] ?></td>
            <td><a href="admin_view_emp_acc.php?id=<?= $row['emp_id'] ?>"><input type="button" value="View details" class="view-button"></a></td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>

    </div>
    <?php
      }
    ?>

    <div class="right-div">

    <a href="search_emp.php" class="link">
      <button class="right-div-buttons" onclick="search_empFunction()">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              search
          </span>
        </div>
        <p class="right-p">Search for user</p>
      </button>
      </a>

      <a href="create_emp.php" class="link">
      <button class="right-div-buttons" onclick="add_empFunction()">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              person_add
          </span>
        </div>
        <p class="right-p">Add user</p>
      </button>
      </a>

      <a href="create_emp.php" class="link">
      <button class="right-div-buttons" onclick="logs_function()">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              menu_book
          </span>
        </div>
        <p class="right-p">View logs</p>
      </button>
      </a>

      

    </div>

  </div>

  </body>

</html>