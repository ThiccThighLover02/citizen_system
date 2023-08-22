<?php
  session_start();
  include "../db_connect.php";

  if(isset($_SESSION['emp_status']) && $_SESSION['emp_status'] == "Active"){
    $this_emp = $conn->prepare("SELECT id_pic FROM emp_tbl WHERE emp_id=?");
      $this_emp->bind_param("i", $_SESSION['emp_id']);
      $this_emp->execute();
      $emp_result = $this_emp->get_result();

      $emp_row = mysqli_fetch_assoc($emp_result);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Login Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="user_script.js"></script>
    <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="background">
  <div class="top-nav">
    <h1>Senior Citizen System</h1>
  </div>

  <div class="main-div">

    <div class="left-div">
      <button class="left-button" style="border-top-left-radius: 15px; border-top-right-radius: 15px;"><img src="../admin/user_pics/<?= $emp_row['id_pic'] ?>" alt="" class="profile-pic">
        <p>Profile</p>
      </button>

      <button class="left-button" onclick=senior_function()>
        <span class="material-symbols-outlined">
          elderly
        </span>
        <p>Seniors</p>
      </button>

      <button class="left-button" onclick=request_function()>
        <span class="material-symbols-outlined">
          description
        </span>
        <p>Requests</p>
      </button>

      <button class="left-button" onclick=EventFunction()>
        <span class="material-symbols-outlined">
          event
        </span>
        <p>Events</p>
      </button>

      <button class="logout-button" onclick=logout_function()>
        <span class="material-symbols-outlined">
          logout
        </span>
        <p>Logout</p>
      </button>
    </div>
    
    <?php
    #Select all of the data in the senior table
    $sql = mysqli_query($conn, "SELECT * FROM senior_tbl");

    $row_sql = mysqli_query($conn, "SELECT * FROM senior_tbl");

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
            <th>Status</th>
            <th>Name</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="table-body">
          <?php

            while($row = mysqli_fetch_array($sql)){
              $birthday = $row['date_birth'];
              $birthday = new DateTime($birthday);
              $interval = $birthday->diff(new DateTime);
              $age = $interval->y;
          
          ?>
          <tr>
            <td><?=str_pad($row['senior_id'], 6, '0', STR_PAD_LEFT); ?></td>
            <td class="stats"><div class="<?= $row['status'] ?>"></div><?= $row['status'] ?> </td>
            <td><?= $row['full_name'] ?></td>
            <td><a href="user_senior_acc.php?id=<?= $row['senior_id'] ?>"><input type="button" value="View details" class="view-button"></a></td>
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
    <div class="right-search">
        <button>
            <span class="material-symbols-outlined" id="search-button">
              search
            </span>
        </button>

        <input type="text" placeholder="Search for senior" id="search">
    </div>

    <a href="user_view_senior.php" class="link">
      <button class="right-div-buttons" onclick="add_empFunction()">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              cancel
          </span>
        </div>
        <p class="right-p">Cancel Search</p>
      </button>
      </a>

      <a href="../create_senior.php?add_senior=true" class="link">
      <button class="right-div-buttons" onclick="add_empFunction()">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              person_add
          </span>
        </div>
        <p class="right-p">Add senior</p>
      </button>
      </a>

      <a href="excel.php" class="link">
      <button class="right-div-buttons" onclick="excel_function()">
          <span class="material-symbols-outlined" id="right-button">
              download
          </span>
        <p class="right-p">Save excel</p>
      </button>
      </a>

      <a href="create_emp.php" class="link">
      <button class="right-div-buttons" onclick="logs_function()">
        <div class="right-div-button-div">
          <span class="material-symbols-outlined" id="right-button">
              menu_book
          </span>
        </div>
        <p class="right-p">View Senior Logs</p>
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
        url:'../senior_jax.php',
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

<?php
  }
  else{
    header("Location: user_login.php");
  }

?>