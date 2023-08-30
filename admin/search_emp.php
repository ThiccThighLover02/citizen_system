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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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

      <button class="left-button" onclick="event_logs()">
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
      #Select all of the data in the emp table
      $sql = mysqli_query($conn, "SELECT * FROM emp_tbl");

      $row_count = mysqli_num_rows($sql);

    ?>

    <div class="mid-div">
      <table class="senior-table" id="search-result">
        <thead class="table-head">
          <tr>
            <th>Emp No.</th>
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

    <div class="right-div">
        <div class="right-search">
            <button>
                <span class="material-symbols-outlined" id="search-button">
                  search
                </span>
            </button>

            <input type="text" placeholder="Search for senior" id="search">
        </div>

        <a href="admin_view_emp.php" class="link">
      <button class="right-div-buttons" onclick="search_empFunction()">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              cancel
          </span>
        </div>
        <p class="right-p">Cancel Search</p>
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

  <script>
    $(document).ready(function(){

    $("#search").keyup(function(){
      var search = $(this).val();

      $.ajax({
        url:'emp_jax.php',
        method:'post',
        data:{query:search},
        success:function(response){
        
          $("#search-result").html(response);

        }
      });
    });

    });
  </script>

</html>