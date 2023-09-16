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
    <h1>Senior Citizen System</h1>
  </div>

  <div class="main-div">

    <!-- left div goes here -->
    <?php
      $active = "actUser";
      include_once "admin_left_div.php";
 
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